<?php
class Barang
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($nama_barang, $harga, $stok, $gambar)
    {
        try {
            $query = "INSERT INTO barang (nama_barang, harga, stok, gambar) VALUES (:nama_barang, :harga, :stok, :gambar)";
            $stmt = $this->conn->prepare($query);
            // Sanitize inputs
            $stmt->bindParam(":nama_barang", htmlspecialchars(strip_tags($nama_barang)));
            $stmt->bindParam(":harga", htmlspecialchars(strip_tags($harga)));
            $stmt->bindParam(":stok", htmlspecialchars(strip_tags($stok)));
            $stmt->bindParam(":gambar", htmlspecialchars(strip_tags($gambar)));

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Create error: " . $e->getMessage();
            return false;
        }
    }

    public function read()
    {
        try {
            $query = "SELECT * FROM barang";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "Read error: " . $e->getMessage();
            return null;
        }
    }

    public function update($id, $nama_barang, $harga, $stok, $gambar)
    {
        try {
            if ($gambar) {
                // Update with new image path
                $query = "UPDATE barang SET nama_barang = :nama_barang, harga = :harga, stok = :stok, gambar = :gambar WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                // Sanitize inputs
                $stmt->bindParam(":gambar", htmlspecialchars(strip_tags($gambar)));
            } else {
                // Update without changing the image
                $query = "UPDATE barang SET nama_barang = :nama_barang, harga = :harga, stok = :stok WHERE id = :id";
                $stmt = $this->conn->prepare($query);
            }

            // Common parameters
            $stmt->bindParam(":nama_barang", htmlspecialchars(strip_tags($nama_barang)));
            $stmt->bindParam(":harga", htmlspecialchars(strip_tags($harga)));
            $stmt->bindParam(":stok", htmlspecialchars(strip_tags($stok)));
            $stmt->bindParam(":id", htmlspecialchars(strip_tags($id)));

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Update error: " . $e->getMessage();
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $query = "DELETE FROM barang WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            // Sanitize input
            $stmt->bindParam(":id", htmlspecialchars(strip_tags($id)));

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Delete error: " . $e->getMessage();
            return false;
        }
    }
}
