<?php
$query = mysqli_query($config, "SELECT * FROM instructors ORDER BY id DESC");
// 12345, 54321
$rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Instructors</h5>
                <div class="mb-3" align="right">
                    <a href="?page=tambah-instructors" class="btn btn-primary">Add Instructors</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gender</th>
                                <th>Education</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $index => $row): ?>
                                <tr>
                                    <td><?php echo $index += 1; ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['gender'] == 1 ? 'Laki-laki' : 'Perempuan' ?></td>
                                    <td><?php echo $row['education'] ?></td>
                                    <td><?php echo $row['phone'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['address'] ?></td>
                                    <td>
                                        <a href="?page=tambah-instructors&edit=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                                        <a onclick="return confirm('Are you sure wanna delete this data??')" href="?page=tambah-instructors&delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
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