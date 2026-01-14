<?php

class Product extends Model
{
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


    public function findById($id)
    {
        $this->db->query("SELECT * FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function create($data)
    {
        $this->db->query("INSERT INTO products (category_id, name, slug, description, price, stock, image, rating, highlight, status, created_at) VALUES (:category_id, :name, :slug, :description, :price, :stock, :image, :rating, :highlight, :status, NOW())");
        $this->db->bind(':category_id', $data['category_id'] ?? null);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug'] ?? null);
        $this->db->bind(':description', $data['description'] ?? null);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock'] ?? 0);
        $this->db->bind(':image', $data['image'] ?? null);
        $this->db->bind(':rating', $data['rating'] ?? 0.0);
        $this->db->bind(':highlight', $data['highlight'] ?? 0);
        $this->db->bind(':status', $data['status'] ?? 'active');
        return $this->db->execute();
    }

    public function update($id, $data)
    {
        $this->db->query("UPDATE products SET category_id = :category_id, name = :name, slug = :slug, description = :description, price = :price, stock = :stock, image = :image, rating = :rating, highlight = :highlight, status = :status WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':category_id', $data['category_id'] ?? null);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':slug', $data['slug'] ?? null);
        $this->db->bind(':description', $data['description'] ?? null);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':stock', $data['stock'] ?? 0);
        $this->db->bind(':image', $data['image'] ?? null);
        $this->db->bind(':rating', $data['rating'] ?? 0.0);
        $this->db->bind(':highlight', $data['highlight'] ?? 0);
        $this->db->bind(':status', $data['status'] ?? 'active');
        return $this->db->execute();
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
