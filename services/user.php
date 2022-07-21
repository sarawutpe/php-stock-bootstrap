<?php
require_once "db.php";

class User extends DB {

    public function getUser(){
        $errors = [];
        $sql = "SELECT id, email, name FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            $res = array('status' => 'ok', 'data' => $result);
        }else{
            array_push($errors, "Error");
            $res = array('status' => 'error', 'data' => $errors);
        }
        return $res;
    }

    public function getUserById($payload){
        $errors = [];
        $id = $payload;
        $sql = "SELECT id, email, name FROM users WHERE id=:id LIMIT 1";
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

    public function updateUser($payload){
        $errors = [];
        $res = [];

        $id = $payload['id'];
        $email = $payload['email'];
        $name = $payload['name'];
        $password = $payload['password'];
        $confirmPassword = $payload['confirm_password'];
        $password_hash = hash('sha256', $password);

        // form validate
        if(empty($email)){
            array_push($errors, "Required email");
        }
        if(empty($name)){
            array_push($errors, "Required name");
        }
       if($password && $password != $confirmPassword) {
            array_push($errors, "Password not match!");
        }

        if(empty($errors)){
            // check email already exists
            $sql = "SELECT email FROM users WHERE email = :email AND id != :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $emailExists = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($emailExists){
                array_push($errors, "Email already exists!");
                $res = array('status' => 'error', 'data' => $errors);
            }else{
                if($password){
                    $sql = "UPDATE users SET email=:email, name=:name, password=:password WHERE id=:id";
                }else{
                    $sql = "UPDATE users SET email=:email, name=:name WHERE id=:id";
                }
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":name", $name);
                if($password){
                    $stmt->bindParam(":password", $password_hash);
                }
                $result = $stmt->execute();
                $res = array('status' => 'ok', 'data' => "Profile has been updated");
            }
        } else {
            $res = array('status' => 'error', 'data' => $errors);
        }
        return $res;
    }
}
?>