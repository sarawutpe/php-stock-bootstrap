<?php
  include "../layouts/admin/header.php";
  include "../layouts/admin/main.php";
  require_once "../services/user.php";

  $result = array('status' => "", 'data' => []);
  $response = new User();
  $result = $response->getUser();
?>
            <div class="pt-3 pb-2 mb-3 border-bottom">
              <h2>Users</h2>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                  </tr>
                </thead>
                <tbody>
                <?php if($result['status'] == 'ok'): ?>
                <?php $i=1; ?>
                  <?php foreach ($result['data'] as $row): ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                  </tr>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td class="text-center" colspan="3">Users is empty</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

<?php include "../layouts/admin/footer.php";