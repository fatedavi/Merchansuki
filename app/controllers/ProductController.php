<?php
class ProductController extends Controller {

public function index() {
    $productModel = $this->model('Product');
    $categoryModel = $this->model('Category');

    // DATA LAMA (JANGAN DIUBAH)
    $products = $productModel->getAllWithVariants();

    // DATA TAMBAHAN
    $productsWithCategory = $productModel->getAllWithCategory();
    $categories = $categoryModel->getAll();

    // 🔥 INJECT category_name ke $products
    $categoryMap = [];
    foreach ($productsWithCategory as $pwc) {
        $categoryMap[$pwc['id']] = $pwc['category_name'];
    }

    foreach ($products as &$product) {
        $product['category_name'] = $categoryMap[$product['id']] ?? '-';
    }
    unset($product); // safety reference

    $this->view('product.index', [
        'products' => $products,
        'categories' => $categories
    ]);
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
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode([
            'success' => false,
            'message' => 'Method not allowed'
        ]);
        exit;
    }

    // VALIDASI MINIMAL
    if (empty($_POST['name']) || empty($_POST['category_id'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Nama produk & kategori wajib diisi'
        ]);
        exit;
    }

    $data = [
        'category_id' => (int) $_POST['category_id'],
        'name'        => trim($_POST['name']),
        'description' => trim($_POST['description'] ?? ''),
        'highlight'   => isset($_POST['highlight']) ? 1 : 0,
        'status'      => $_POST['status'] ?? 'active'
    ];

    try {
        $productModel = $this->model('Product');

        // SIMPAN PRODUCT
        $productId = $productModel->create($data);

        echo json_encode([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'product_id' => $productId
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }

    exit;
}


    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            exit;
        }

        header('Content-Type: application/json');

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
        ];

        try {
            $productModel = $this->model('Product');
            $productModel->update($id, $data);
            
            echo json_encode(['success' => true, 'message' => 'Produk berhasil diupdate']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }
    public function delete($id) {
        $productModel = $this->model('Product');
        $productModel->delete($id);
        header('Location: /admin/products');
        exit;
    }
public function variants($productId)
{
    header('Content-Type: application/json');

    $productModel = $this->model('Product');
    echo json_encode(
        $productModel->getVariants($productId)
    );
}
public function deleteVariant($id)
{
    header('Content-Type: application/json');

    try {
        $variantModel = $this->model('ProductVariant');
        $variantModel->delete($id);

        echo json_encode([
            'success' => true,
            'message' => 'Variant berhasil dihapus'
        ]);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
    exit;
}




}