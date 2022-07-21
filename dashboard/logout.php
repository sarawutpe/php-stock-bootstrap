<?php 
  require_once "../services/auth.php";
  $response = new Auth();
  $response->logout($_POST);
?>