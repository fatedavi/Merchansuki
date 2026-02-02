<?php

class CheckoutController extends Controller
{
    /**
     * Halaman checkout: tampilkan form alamat, metode bayar, dan ringkasan cart
     */
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $cart = $this->model('Cart')->get();
        if (empty($cart['items'])) {
            header('Location: /cart');
            exit;
        }

        $profile = $this->model('Profile')
                        ->findByUserId($_SESSION['user']['id']);

        require_once __DIR__ . '/../helpers/ShippingHelper.php';

        // Hitung ongkir default berdasarkan profile user
        $distance = ShippingHelper::distanceFromSurabaya($profile['city'] ?? '');
        $ongkir   = ShippingHelper::calculateOngkir($distance);

        $this->view('checkout/index', [
            'cart'        => $cart,
            'profile'     => $profile,
            'distance'    => $distance,
            'ongkir'      => $ongkir,
            'grand_total' => $cart['total_price'] + $ongkir
        ]);
    }

    /**
     * Proses checkout: simpan order + redirect ke halaman pembayaran Midtrans
     */
    public function process()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $cart = $this->model('Cart')->get();
        if (empty($cart['items'])) {
            header('Location: /cart');
            exit;
        }

        // Ambil alamat & payment method dari form POST
        $address     = trim($_POST['address'] ?? '');
        $city        = trim($_POST['city'] ?? '');
        $province    = trim($_POST['province'] ?? '');
        $postal_code = trim($_POST['postal_code'] ?? '');
        $payment     = trim($_POST['payment_method'] ?? '');

        // VALIDASI SERVER SIDE
        if (!$address || !$city || !$province || !$postal_code || !$payment) {
            $_SESSION['error'] = 'Lengkapi semua field alamat dan pembayaran';
            header('Location: /checkout');
            exit;
        }

        require_once __DIR__ . '/../helpers/ShippingHelper.php';

        // Hitung ongkir berdasarkan kota input user
        $distance = ShippingHelper::estimateDistance($city);
        $shippingCost = ShippingHelper::calculateOngkir($distance);

        $grandTotal = $cart['total_price'] + $shippingCost;

        // Siapkan data alamat untuk model
        $alamat = [
            'address'     => $address,
            'city'        => $city,
            'province'    => $province,
            'postal_code' => $postal_code,
            'payment'     => $payment
        ];

        // Simpan order ke database
        $orderId = $this->model('Order')->createFromCart(
            $cart,
            $_SESSION['user']['id'],
            $shippingCost,
            $grandTotal,
            $alamat
        );

        // Kosongkan cart
        $this->model('Cart')->clear();

        // Redirect ke halaman PAYMENT, bukan detail
        header('Location: /checkout/payment/' . $orderId);
        exit;
    }

    /**
     * Halaman detail order
     */
    public function detail($id)
    {
        $order = $this->model('Order')->findWithItems((int)$id);

        if (!$order) {
            http_response_code(404);
            echo 'Order tidak ditemukan';
            return;
        }

        $this->view('checkout/detail', [
            'order' => $order
        ]);
    }

    /**
     * Halaman pembayaran Midtrans
     */
public function payment($orderId)
{
    $order = $this->model('Order')->findWithItems((int)$orderId);

    if (!$order) {
        http_response_code(404);
        echo "Order tidak ditemukan";
        return;
    }

    require_once __DIR__ . '/../helpers/MidtransHelper.php';

    $itemDetails  = [];
    $grossAmount = 0;

    foreach ($order['items'] as $item) {

        // ✅ AMAN dari undefined key
        $productName = $item['name']
            ?? $item['product_name']
            ?? $item['title']
            ?? 'Produk';

        $itemDetails[] = [
            'id'       => 'PROD-' . $item['product_id'],
            'price'    => (int) $item['price'],
            'quantity' => (int) $item['qty'],
            'name'     => $productName
                . (!empty($item['variant_name']) ? ' - ' . $item['variant_name'] : ''),
        ];

        $grossAmount += (int)$item['price'] * (int)$item['qty'];
    }

    // ✅ ONGKIR sebagai ITEM
    if (!empty($order['shipping_cost'])) {
        $itemDetails[] = [
            'id'       => 'SHIPPING',
            'price'    => (int) $order['shipping_cost'],
            'quantity' => 1,
            'name'     => 'Ongkos Kirim',
        ];

        $grossAmount += (int) $order['shipping_cost'];
    }

    // ✅ CREATE TRANSACTION
    $snapToken = MidtransHelper::createTransaction([
        'order_id'     => 'ORDER-' . $order['id'], // wajib unik
        'gross_amount' => $grossAmount,
        'items'        => $itemDetails,
        'customer'     => [
            'name'        => $_SESSION['user']['name'] ?? 'Guest',
            'email'       => $_SESSION['user']['email'] ?? 'guest@example.com',
            'phone'       => $_SESSION['user']['phone'] ?? '08123456789',
            'address'     => $order['address'] ?? '',
            'city'        => $order['city'] ?? '',
            'postal_code' => $order['postal_code'] ?? '',
        ],
    ]);

    $this->view('checkout/payment', [
        'order'      => $order,
        'snap_token' => $snapToken,
    ]);
}


}
