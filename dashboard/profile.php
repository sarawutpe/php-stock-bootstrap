<?php
  include "../layouts/admin/header.php";
  include "../layouts/admin/main.php";
  require_once "../services/user.php";

  $result = array('status' => "", 'data' => []);
  $response = new User();
  // update user
  $updateResult = array('status' => "", 'data' => []);
  if(isset($_POST['update'])){
    $updateResult = $response->updateUser($_POST);
  }
  // get user by id   
  $id = $_SESSION['user']['id'];
  $getUserByIdResult = $response->getUserById($id);
  $row = $getUserByIdResult['data'];
?>

            <div class="pt-3 pb-2 mb-3 border-bottom">
              <h2>Profile</h2>
            </div>

            <!-- alert -->
            <?php
            if ($updateResult['status'] === 'ok'){
              echo '<div class="alert alert-success" role="alert">';
              echo $updateResult['data'];
              echo '</div>';
            }else if($updateResult['status'] === 'error'){
              echo '<div class="alert alert-danger" role="alert"><ul>';
              foreach ($updateResult['data'] as $error) {
              echo "<li>$error</li>";
              }
              echo '</ul></div>';
            }
            ?>

            <?php if($getUserByIdResult['status'] == 'ok'): ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" value="">
                </div>
     
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
            <?php else: ?>
              <label>Error data</label>
            <?php endif; ?>

<?php include "../layouts/admin/footer.php";