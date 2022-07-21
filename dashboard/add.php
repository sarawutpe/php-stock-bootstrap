<?php
  include "../layouts/admin/header.php";
  include "../layouts/admin/main.php";
  require_once "../services/product.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = new Product();
    $response->createProducts($_POST, $_FILES['image']);
  }

?>

            <div class="pt-3 pb-2 mb-3 border-bottom">
                  <h2>Add Product</h2>
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input id="formFile" type="file" name="image" class="form-control" accept="image/jpeg, image/png">
                </div>
                <div class="mb-3">
                    <img src="../assets/images/default-image.jpg" id="previewImg" class="img-thumbnail" width="220px" height="180px">
                </div>
                <button type="submit" name="create" class="btn btn-primary">Add</button>
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