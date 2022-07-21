<?php $path = basename($_SERVER['PHP_SELF']); ?>

<!-- main -->
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <header class="mb-5">
        <div>
          <h3 class="float-md-start mb-0">Stock</h3>
          <nav class="nav nav-masthead justify-content-center float-md-end">
            <a
              class="nav-link fw-bold py-1 px-0 <?php if($path == "index.php") echo "active" ?>"
              aria-current="page"
              href="index.php"
              >Home</a
            >
            <?php if(isset($_SESSION['user']['isLoggedIn'])): ?>
            <a class="nav-link fw-bold py-1 px-0 <?php if($path == "dashboard/index.php") echo "active" ?>" href="dashboard/index.php">Admin Panel</a>
            <?php else: ?>
            <a class="nav-link fw-bold py-1 px-0 <?php if($path == "login.php") echo "active" ?>" href="login.php">Login</a>
            <a class="nav-link fw-bold py-1 px-0 <?php if($path == "register.php") echo "active" ?>" href="register.php">Register</a>
            <?php endif; ?>
          </nav>
        </div>
      </header>