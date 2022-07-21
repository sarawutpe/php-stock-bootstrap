<?php
require_once "db.php";

class Product extends DB {

    public function uploadFile($file){
        try {
            if ($file['size'] > 0) {
                $extension = explode('-', $file['name']);
                $fileActExit = strtolower(end($extension));
                $fileNew = rand(). "." .$fileActExit;
                $filePath = '../uploads/'.$fileNew;
                move_uploaded_file($file['tmp_name'], $filePath);
                return $fileNew;
            }
            return "";
        } catch (Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
    }

    public function deleteFile($path){
        $target = "../uploads/".$path;
        if(unlink($target)){
            return true;
        }else{
            return false;
        }
    }

    public function createProducts($payload, $file){
        $errors = [];
        $name = $payload['name'];
        $price = $payload['price'];
        $upload = $this->uploadFile($file);
        $stock = $payload['stock'];

        $sql = "INSERT INTO products(name, image, price, stock) VALUES(:name, :image, :price, :stock)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":image", $upload);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":stock", $stock);
        $result = $stmt->execute();

        if($result){
            header('location: index.php');
            $res = array('status' => 'ok', 'data' => "");
        }else{
            array_push($errors, "Error");
            $res = array('status' => 'error', 'data' => $errors);
        }
        return $res;
    }

    public function getProducts(){
        $errors = [];
        // find products
        $sql = "SELECT id, name, image, price, stock FROM products ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            $res = array('status' => 'ok', 'data' => $result);
        }else{
            // array_push($errors, "Error");
            $res = array('status' => 'error', 'data' => $errors);
        }
        return $res;
    }

    public function getProductsById($payload){
        $errors = [];
        $id = $payload;
        $sql = "SELECT id, name, image, price, stock FROM products WHERE id=:id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            $res = array('status' => 'ok', 'data' => $result);
        }else{
            array_push($errors, "Error");
            $res = array('status' => 'error', 'data' => $errors);
        }
        return $res;
    }

    public function updateProducts($payload, $file){
        $errors = [];
        $id = $payload['id'];
        $name = $payload['name'];
        $price = $payload['price'];
        $originalImage = $payload['original_image'];
        $upload = $this->uploadFile($file);
        $stock = $payload['stock'];

        if($upload) {
            $sql = "UPDATE products SET name=:name, image=:image, price=:price, stock=:stock WHERE id=:id";
        } else {
            $sql = "UPDATE products SET name=:name, price=:price, stock=:stock WHERE id=:id";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        if($upload){
            // delete original image when update new image
            if($originalImage){
                $this->deleteFile($originalImage);
            }
            $stmt->bindParam(":image", $upload);
        }
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":stock", $stock);
        $result = $stmt->execute();

        if($result){
            header('location: index.php');
            $res = array('status' => 'ok', 'data' => "");
        }else{
            array_push($errors, "Error");
            $res = array('status' => 'error', 'data' => $errors);
        }
        return $res;
    }

    public function deleteProducts($payload){
        $errors = [];
        $id = $payload;
        // find original
        $sql = "SELECT image FROM products WHERE id=:id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $findOriginal = $stmt->fetch(PDO::FETCH_ASSOC);
        // delete by id
        $sql = "DELETE FROM products WHERE id=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id", $id);
        $result = $stmt->execute();
       
        if($result){
            $this->deleteFile($findOriginal['image']);
            $res = array('status' => 'ok', 'data' => "");
        }else{
            array_push($errors, "Error");
            $res = array('status' => 'error', 'data' => $errors);
        }
        return $res;
    }

}
?>