<?php
  include "../layouts/admin/header.php";
  include "../layouts/admin/main.php";
  require_once "../services/product.php";

  $result = array('status' => "", 'data' => []);
  $response = new Product();

  // get all products
  $result = $response->getProducts();

  // delete products by id
  if(isset($_GET['del'])) {
    $id = $_GET['del'];
    $response->deleteProducts($id);
  }
?>

            <div class="pt-3 pb-2 mb-3 border-bottom">
              <div class="row row-cols-auto">
                <div class="col">
                  <h2>Products</h2>
                </div>
                <div class="col">
                  <a href="add.php">
                    <button type="button" class="btn btn-success">Create Product</button>
                  </a>
                </div>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; ?>
                  <?php if($result['status'] == 'ok'): ?>
                  <?php foreach ($result['data'] as $row): ?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                      <img class="img-thumbnail" src="<?php echo "../uploads/".$row['image']; ?>" width="220px" height="180px">
                    </td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                          <i data-feather="edit"></i>
                        </a>
                        <button onclick="handelDelete(event,<?php echo $row['id']; ?>,'<?php echo $row['name']; ?>')" type="button" class="btn btn-danger">
                          <i data-feather="trash"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td class="text-center" colspan="6">Products is empty</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    function handelDelete(event, id, name){
      // event.preventDefault();
      swal({
      title: `Are you sure delete ${name}?`,
      text: "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((isConfirm) => {
      if (isConfirm) {
        $.ajax({
          url: 'index.php',
          type: 'GET',
          data: 'del='+id,
        })
      .done(function() {
        document.location.reload();
      });
      }
    });
  }
  </script>

<?php include "../layouts/admin/footer.php";