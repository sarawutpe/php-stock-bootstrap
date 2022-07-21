<?php 
  session_start();
  require_once "../services/auth.php";
  $response = new Auth();
  $response->withAuth();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta
      name="author"
      content="Mark Otto, Jacob Thornton, and Bootstrap contributors"
    />
    <meta name="generator" content="Hugo 0.98.0" />
    <title>Stock Admin</title>
    <link rel="stylesheet" href="../assets/dist/css/bootstrap.min.css"  />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="../assets/css/admin.css"  />
  </head>
  <body>