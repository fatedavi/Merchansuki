<?php
class ProductController extends Controller {
    public function index() {
        $productModel = $this->model('Product');
        $products = $productModel->getAll();
        $this->view('product.index', ['products' => $products]);
    }

    public function detail($id){
        $productModel = $this->model('Product');
        $product = $productModel->findById($id);
        if (!$product) {
            $this->view('errors.404');
            return;
        }
        $this->view('product.detail', ['product' => $product]);
    }

    public function create() {
        $this->view('product.create');
    }

   public function store()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /admin/products');
        exit;
    }

    $data = [
        'category_id' => $_POST['category_id'] ?? null,
        'name'        => trim($_POST['name'] ?? ''),
        'slug'        => trim($_POST['slug'] ?? ''),
        'description' => trim($_POST['description'] ?? ''),
        'price'       => (float) ($_POST['price'] ?? 0),
        'stock'       => (int) ($_POST['stock'] ?? 0),
        'rating'      => (float) ($_POST['rating'] ?? 0),
        'highlight'   => isset($_POST['highlight']) ? 1 : 0,
        'status'      => $_POST['status'] ?? 'active',
        'image'       => null
    ];

    /**
     * =============================
     * UPLOAD IMAGE
     * =============================
     */
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt)) {
            $_SESSION['error'] = 'Format gambar tidak valid.';
            header('Location: /admin/products/create');
            exit;
        }

        if ($_FILES['image']['size'] > 2 * 1024 * 1024) { // 2MB
            $_SESSION['error'] = 'Ukuran gambar maksimal 2MB.';
            header('Location: /admin/products/create');
            exit;
        }

        $targetDir = __DIR__ . '/../../public/assets/images/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $filename = time() . '_' . uniqid() . '.' . $ext;
        $target   = $targetDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            // SIMPAN KE DATABASE: NAMA FILE SAJA
            $data['image'] = $filename;
        }
    }

    /**
     * =============================
     * SAVE DATA
     * =============================
     */
    $productModel = $this->model('Product');
    $productModel->create($data);

    $_SESSION['success'] = 'Produk berhasil ditambahkan';
    header('Location: /admin/products');
    exit;
}


    public function edit($id) {
        $productModel = $this->model('Product');
        $product = $productModel->findById($id);
        if (!$product) {
            $this->view('errors.404');
            return;
        }
        $this->view('product.edit', ['product' => $product]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'category_id' => $_POST['category_id'] ?? null,
                'name' => $_POST['name'] ?? '',
                'slug' => $_POST['slug'] ?? null,
                'description' => $_POST['description'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'stock' => $_POST['stock'] ?? 0,
                'rating' => $_POST['rating'] ?? 0.0,
                'highlight' => isset($_POST['highlight']) ? 1 : 0,
                'status' => $_POST['status'] ?? 'active',
            ];
            // Proses upload gambar
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $targetDir = 'public/assets/images/';
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $filename = time() . '_' . basename($_FILES['image']['name']);
                $target = $targetDir . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $data['image'] = '/' . $target;
                }
            }
            $productModel = $this->model('Product');
            $productModel->update($id, $data);
            header('Location: /admin/products');
            exit;
        }
    }

    public function delete($id) {
        $productModel = $this->model('Product');
        $productModel->delete($id);
        header('Location: /admin/products');
        exit;
    }
}