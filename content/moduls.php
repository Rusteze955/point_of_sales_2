<?php
$id_user = isset($_SESSION['ID_USER']) ? $_SESSION['ID_USER'] : '';
$id_role = isset($_SESSION['ID_ROLE']) ? $_SESSION['ID_ROLE'] : '';

// 
$rowStudent = mysqli_fetch_assoc(mysqli_query($config, "SELECT * FROM students WHERE id = '$id_user'"));
$id_major = $rowStudent['id_major'];
if ($id_role == 2) {
    $where = "WHERE moduls.id_major='$id_major'";
} elseif ($id_role == 1) {
    $where = "WHERE moduls.id_instructor='$id_user'";
}
$query = mysqli_query($config, "SELECT majors.name as majors_name, instructors.name as instructors_name, moduls.* FROM moduls LEFT JOIN majors ON majors.id = moduls.id_major LEFT JOIN instructors ON instructors.id = moduls.id_instructor $where ORDER BY moduls.id DESC");
// 12345, 54321
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data moduls</h5>
                <?php if ($_SESSION['ID_ROLE'] == 1): ?>
                    <div class="mb-3" align="right">
                        <a href="?page=tambah-moduls" class="btn btn-primary">Add Moduls</a>
                    </div>
                <?php endif ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Instructor</th>
                                <th>Major</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $index => $row): ?>
                                <tr>
                                    <td><?php echo $index += 1; ?></td>
                                    <td><a href="?page=tambah-moduls&detail=<?php echo $row['id'] ?>">
                                            <i class="bi bi-link"></i>
                                            <?php echo $row['name'] ?>
                                        </a>
                                    </td>
                                    <td><?php echo $row['instructors_name'] ?></td>
                                    <td><?php echo $row['majors_name'] ?></td>
                                    <td>
                                        <a onclick="return confirm('Are you sure wanna delete this data??')" href="?page=tambah-moduls&delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>