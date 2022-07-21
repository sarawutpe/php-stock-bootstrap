<?php
  include "../layouts/admin/header.php";
  include "../layouts/admin/main.php";
  require_once "../services/product.php";

  $result = array('status' => "", 'data' => []);
  $response = new Product();
  $id = $_GET['id'];
  $result = $response->getProductsById($id);
  $row = $result['data'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response->updateProducts($_POST, $_FILES['image']);
  }

?>

            <div class="pt-3 pb-2 mb-3 border-bottom">
                  <h2>Edit Product</h2>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="<?php echo $row['price']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" value="<?php echo $row['stock']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="hidden" name="original_image" value="<?php echo $row['image']; ?>">
                    <input id="formFile" type="file" name="image" class="form-control" value="<?php echo $row['image']; ?>"  accept="image/jpeg, image/png">
                </div>
                <div class="mb-3">
                    <img src="<?php echo "../uploads/".$row['image']; ?>" id="previewImg" class="img-thumbnail" width="220px" height="180px">
                </div>
                <button type="submit" name="create" class="btn btn-primary">Edit</button>
            </form>

<script>
    const formFile = document.getElementById('formFile');
    const previewImg = document.getElementById('previewImg');
    formFile.addEventListener("change", (event) => {
        if (event.target.files.length) {
            previewImg.src = URL.createObjectURL(event.target.files[0]);
        }
    })
</script>

<?php include "../layouts/admin/footer.php";