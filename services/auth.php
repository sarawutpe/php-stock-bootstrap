<?php
require_once "db.php";

class Auth extends DB {

    public function register($payload){
        $errors = [];
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
        if(empty($password) || empty($confirmPassword)){
            array_push($errors, "Required password");
        } else if($password != $confirmPassword) {
            array_push($errors, "Password not match!");
        }

        if(empty($errors)){
            // check email already exists
            $sql = "SELECT email FROM users WHERE email=:email LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $emailExists = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($emailExists){
                array_push($errors, "Email already exists!");
                $res = array('status' => 'error', 'data' => $errors);
            } else{
                $sql = "INSERT INTO users(email,name,password) VALUES (:email,:name,:password)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":password", $password_hash);
                $result = $stmt->execute();
                $res = array('status' => 'ok', 'data' => "Register successfully");
            }
        } else {
            $res = array('status' => 'error', 'data' => $errors);
        }
        return $res;
    }

    public function login($payload){
        $errors = [];
        $email = $payload['email'];
        $password = $payload['password'];
        $password_hash = hash('sha256', $password);
        
        // form validate
        if(empty($email)){
            array_push($errors, "Required email");
        }
        if(empty($password)){
            array_push($errors, "Required password");
        }

        if(empty($errors)) {
            // find username and password
            $sql = "SELECT id, email, password FROM users WHERE email=:email AND password=:password LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password_hash);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // if everything is good then set session user login
            if($result){
                $_SESSION["user"]['isLoggedIn'] = true;
                $_SESSION["user"]['id'] = $result['id'];
                $res = array('status' => 'ok', 'data' => "Successfully logged in");
                header("refresh:1; url=dashboard");
            } else{
                array_push($errors, "Incorrect username or password");
                $res = array('status' => 'error', 'data' => $errors);
            }
         
        } else {
            $res = array('status' => 'error', 'data' => $errors);
        }
        return $res;
    }

    public function withAuth(){
       if(!isset($_SESSION['user'])){
            header("location: ../");
        }
    }

    public function logout(){
        session_start();
        unset($_SESSION['user']);
        header('location: ../');
    }
}
?>