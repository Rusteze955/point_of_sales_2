<?php
if (isset($_GET['delete'])) {
    $id_user = $_GET['delete'];
    $queryDelete = mysqli_query($config, "DELETE FROM menus WHERE id = '$id_user'");
    if ($queryDelete) {
        header("location:?page=menu&hapus=berhasil");
    } else {
        header("location:?page=menu&hapus=gagal");
    }
}

$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM menus WHERE id = '$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['name'])) {
    // ada tidak parameter bernama edit, kalo ada jalankan perintah edit/update, kalo tidak ada tambah data baru/insert
    $name = $_POST['name'];
    $icon = $_POST['icon'];
    $urutan = $_POST['urutan'];
    $url = $_POST['url'];
    $parent_id = $_POST['parent_id'];

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO menus (name, icon, urutan, url, parent_id) VALUES('$name', '$icon', '$urutan', '$url', '$parent_id')");
        header("location:?page=menu&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE menus SET name='$name', icon='$icon', urutan='$urutan', url='$url', parent_id='$parentId' WHERE id='$id_user'");
        header("location:?page=menu&ubah=berhasil");
    }
}

$queryParentId = mysqli_query($config, "SELECT * FROM menus WHERE parent_id = 0 OR parent_id = ''");
$rowParentId = mysqli_fetch_all($queryParentId, MYSQLI_ASSOC);

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($id_user) ? 'Edit' : 'Add' ?> Role</h5>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Name *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name menu" required value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : ''; ?>">
                    </div>
                    <div class="mn-3">
                        <label for="">Parent Id</label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="">Select One</option>
                            <?php foreach ($rowParentId as $parentId): ?>
                                <option value="<?php echo $parentId['id'] ?>"><?php echo $parentId['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Icon *</label>
                        <input type="text" class="form-control" name="icon" placeholder="Enter icon menu" required value="<?php echo isset($rowEdit['icon']) ? $rowEdit['icon'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Url </label>
                        <input type="text" class="form-control" name="url" placeholder="Enter url menu" value="<?php echo isset($rowEdit['url']) ? $rowEdit['url'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Order *</label>
                        <input type="number" class="form-control" name="urutan" placeholder="Enter order menu" required value="<?php echo isset($rowEdit['urutan']) ? $rowEdit['urutan'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>