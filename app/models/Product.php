<?php

class Product extends Model
{
    // Ambil produk yang di-highlight (featured)
    public function getHighlighted()
    {
        $this->db->query("
            SELECT * FROM products 
            WHERE highlight = 1 
            AND status = 'active'
            ORDER BY created_at DESC
        ");
        return $this->db->resultSet();
    }

    // Ambil semua produk, bisa pilih hanya yang aktif
    public function getAll($onlyActive = false)
    {
        if ($onlyActive) {
            $this->db->query("
                SELECT * FROM products 
                WHERE status = 'active' 
                ORDER BY created_at DESC
            ");
        } else {
            $this->db->query("
                SELECT * FROM products 
                ORDER BY created_at DESC
            ");
        }
        return $this->db->resultSet();
    }

    // Cari produk berdasarkan ID
    public function findById($id)
    {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Tambah produk (tanpa price/stock, gambar di varian)
    public function create($data)
    {
        $this->db->query("
            INSERT INTO products 
            (category_id, name, slug, description, rating, highlight, status, created_at) 
            VALUES 
            (:category_id, :name, :slug, :description, :rating, :highlight, :status, NOW())
        ");
        $this->db->bind(':category_id', $data['category_id'] ?? null);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug'] ?? null);
        $this->db->bind(':description', $data['description'] ?? null);
        $this->db->bind(':rating', $data['rating'] ?? 0.0);
        $this->db->bind(':highlight', $data['highlight'] ?? 0);
        $this->db->bind(':status', $data['status'] ?? 'active');

        return $this->db->execute();
    }

    // Update produk
    public function update($id, $data)
    {
        $this->db->query("
            UPDATE products SET 
            category_id = :category_id, 
            name = :name, 
            slug = :slug, 
            description = :description, 
            rating = :rating, 
            highlight = :highlight, 
            status = :status
            WHERE id = :id
        ");
        $this->db->bind(':id', $id);
        $this->db->bind(':category_id', $data['category_id'] ?? null);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug'] ?? null);
        $this->db->bind(':description', $data['description'] ?? null);
        $this->db->bind(':rating', $data['rating'] ?? 0.0);
        $this->db->bind(':highlight', $data['highlight'] ?? 0);
        $this->db->bind(':status', $data['status'] ?? 'active');

        return $this->db->execute();
    }

    // Hapus produk
    public function delete($id)
    {
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // Ambil semua produk beserta varian-nya
public function getAllWithVariants()
{
    $products = $this->getAll(); // pakai method yang sudah ada, ambil semua produk

    foreach ($products as &$product) {
        $this->db->query("SELECT id, variant_name, price, stock, image 
                          FROM product_variants 
                          WHERE product_id = :pid");
        $this->db->bind(':pid', $product['id']);
        $product['variants'] = $this->db->resultSet();
    }

    return $products;
}
public function getVariants($productId)
{
    $this->db->query("
        SELECT 
            id,
            variant_name,
            price,
            stock,
            status,
            image
        FROM product_variants
        WHERE product_id = :product_id
        ORDER BY id DESC
    ");

    $this->db->bind(':product_id', $productId);

    return $this->db->resultSet();
}
public function getAllWithCategory() {
    $this->db->query("
        SELECT 
            p.*,
            c.name AS category_name
        FROM products p
        LEFT JOIN categories c ON c.id = p.category_id
        ORDER BY p.created_at DESC
    ");

    return $this->db->resultSet();
}



}
