<?php 
    include "./layouts/header.php";
    include "./layouts/main.php";
    require_once "./services/auth.php";

    // if user logged in then redirect to admin page
    if(isset($_SESSION['user']['isLoggedIn'])){
      header("location: dashboard");
    }
    // initial result
    $result = array('status' => "", 'data' => []);
    // check request
    if(isset($_POST['login'])){
      $response = new Auth();
      $result = $response->login($_POST);
    }
?>

    <main class="px-3">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <img class="mb-4" src="./assets/images/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please Login</h1>
            
            <!-- alert -->
            <?php
            if ($result['status'] === 'ok'){
              echo '<div class="alert alert-success" role="alert">';
              echo $result['data'];
              echo '</div>';
            }else if($result['status'] === 'error'){
              echo '<div class="alert alert-danger" role="alert"><ul>';
              foreach ($result['data'] as $error) {
              echo "<li>$error</li>";
              }
              echo '</ul></div>';
            }
            ?>

            <div class="form-auth">
              <div class="form-floating">
                <input type="email" name="email" class="form-control" value="admin@gmail.com" placeholder="Email address">
                <label class="text-muted">Email address</label>
              </div>
              <div class="form-floating">
                <input type="password" name="password" class="form-control" value="1234" placeholder="Password">
                <label class="text-muted">Password</label>
              </div>
            </div>
            <button type="submit" name="login" class="w-100 btn btn-lg btn-primary">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
          </form>
    </main>
    
<?php include "./layouts/footer.php" ?>