<?php $path = basename($_SERVER['PHP_SELF']); ?>

    <div id="dashboard">
      <header
        class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"
      >
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href=""
          >Stock Admin</a
        >
        <button
          class="navbar-toggler position-absolute d-md-none collapsed"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#sidebarMenu"
          aria-controls="sidebarMenu"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <input
          class="form-control form-control-dark w-100 rounded-0 border-0"
          type="text"
          placeholder="Search"
          aria-label="Search"
        />
        <div class="navbar-nav">
          <div class="nav-item text-nowrap">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <a class="nav-link px-3" href="logout.php" name="logout">Logout</a>
            </form>
          </div>
        </div>
      </header>
      <div class="container-fluid">
        <div class="row">
          <nav
            id="sidebarMenu"
            class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
          >
            <div class="position-sticky">
              <ul class="nav flex-column">
                <li class="nav-item" >
                  <a class="nav-link " aria-current="page" href="../">
                    <span data-feather="globe" class="align-text-bottom "></span>
                    Home
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($path == "index.php") echo "active" ?>" aria-current="page" href="index.php">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($path == "user.php") echo "active" ?>" href="user.php">
                    <span data-feather="users" class="align-text-bottom"></span>
                    Users
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php if($path == "profile.php") echo "active" ?>" href="profile.php">
                    <span data-feather="settings" class="align-text-bottom"></span>
                    Profiles
                  </a>
                </li>
              </ul>
            </div>
          </nav>

          <!-- content -->
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            