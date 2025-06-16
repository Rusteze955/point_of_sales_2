<?php
if (isset($_GET['delete'])) {
    $id_user = $_GET['delete'];
    $queryDelete = mysqli_query($config, "DELETE FROM products WHERE id = '$id_user'");
    if ($queryDelete) {
        header("location:?page=product&hapus=berhasil");
    } else {
        header("location:?page=product&hapus=gagal");
    }
}

$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM products WHERE id = '$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['name'])) {
    // ada tidak parameter bernama edit, kalo ada jalankan perintah edit/update, kalo tidak ada tambah data baru/insert
    $name = $_POST['name'];
    $id_category = $_POST['id_category'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $description = $_POST['description'];

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO products (id_category, name, price, qty, description) VALUES('$id_category', '$name', '$price', '$qty', '$description')");
        header("location:?page=product&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE products SET id_category='$id_category', name='$name', price='$price', qty='$qty', description='$description' WHERE id = '$id_user'");

        header("location:?page=product&ubah=berhasil");
    }
}

$queryCategoryProduct = mysqli_query($config, "SELECT * FROM categories ORDER BY id DESC");
$rowCategoryProduct = mysqli_fetch_all($queryCategoryProduct, MYSQLI_ASSOC);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($id_user) ? 'Edit' : 'Add' ?> Product</h5>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Category Product *</label>
                        <select name="id_category" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowCategoryProduct as $rowCategory): ?>
                                <option <?php echo isset($rowEdit) ? ($rowCategory['id'] == $rowEdit['id_category']) ? 'selected' : '' : '' ?> value="<?php echo $rowCategory['id'] ?>"><?php echo $rowCategory['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Name Product</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your product name" required value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter your price" required value="<?php echo isset($rowEdit['price']) ? $rowEdit['price'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Quantity</label>
                        <input type="number" class="form-control" name="qty" placeholder="Enter your quality" required value="<?php echo isset($rowEdit['qty']) ? $rowEdit['qty'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" id="" class="form-control" <?php echo isset($rowEdit['description']) ? $rowEdit['description'] : ''; ?>></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>