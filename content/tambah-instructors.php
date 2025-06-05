<?php
if (isset($_GET['delete'])) {
    $id_user = $_GET['delete'];
    $queryDelete = mysqli_query($config, "DELETE FROM instructors WHERE id = '$id_user'");
    if ($queryDelete) {
        header("location:?page=instructors&hapus=berhasil");
    } else {
        header("location:?page=instructors&hapus=gagal");
    }
}

$id_user = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($config, "SELECT * FROM instructors WHERE id = '$id_user'");
$rowEdit = mysqli_fetch_assoc($queryEdit);

if (isset($_POST['name'])) {
    // ada tidak parameter bernama edit, kalo ada jalankan perintah edit/update, kalo tidak ada tambah data baru/insert
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $education = $_POST['education'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = isset($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];

    if (!isset($_GET['edit'])) {
        $insert = mysqli_query($config, "INSERT INTO instructors (name, gender, education, phone, email, password, address) VALUES('$name', '$gender', '$education', '$phone', '$email', '$password', '$address')");
        header("location:?page=instructors&tambah=berhasil");
    } else {
        $update = mysqli_query($config, "UPDATE instructors SET name='$name', gender='$gender', education='$education', phone='$phone', email='$email', password='$password', address='$address' WHERE id = '$id_user'");
        header("location:?page=instructors&ubah=berhasil");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo isset($id_user) ? 'Edit' : 'Add' ?> Intructors</h5>

                <form action="" method="post">
                    <div class="mb-3">
                        <label for="">Fullname</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" required value="<?php echo isset($rowEdit['name']) ? $rowEdit['name'] : ''; ?>">
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="laki" value="1" required checked>
                        <label class="form-check-label" for="laki">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="perempuan" value="0" required>
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                    <div class="mb-3">
                        <label for="">Education</label>
                        <input type="text" class="form-control" name="education" placeholder="Enter education name" required value="<?php echo isset($rowEdit['education']) ? $rowEdit['education'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="Enter phone name" required value="<?php echo isset($rowEdit['phone']) ? $rowEdit['phone'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter your email" required value="<?php echo isset($rowEdit['email']) ? $rowEdit['email'] : ''; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password" <?php echo empty($_GET['edit']) ? 'required' : '' ?>>
                        <small>
                            )* If you want to change the password, please enter the new password *
                        </small>
                    </div>
                    <div class="mb-3">
                        <label for="">Address</label>
                        <textarea name="address" id="" class="form-control" <?php echo isset($rowEdit['address']) ? $rowEdit['address'] : ''; ?>></textarea>
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" name="save" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>