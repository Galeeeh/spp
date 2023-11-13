<?php
if (empty($_SESSION['petugas']['level'] == 'admin')) {
?>
    <script>
        location.reload();
        alert('Akses dilarang.');
        window.history.back();
    </script>
<?php
}
?>

<h1 class="h3 mb-3">Daftar Petugas</h1>

<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-header">
                <button data-bs-toggle="modal" data-bs-target="#tambahpetugas" class="btn btn-primary"><i data-feather="user-plus"></i></button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-stripped table-hover cell-border" id="petugas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Petugas</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM petugas");
                        while ($data = mysqli_fetch_array($query)) {

                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data['nama_petugas']; ?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo $data['level']; ?></td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#editpetugas<?php echo $data['id_petugas']; ?>" class="btn btn-warning"><i data-feather="edit"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#hapuspetugas<?php echo $data['id_petugas']; ?>" class="btn btn-danger"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="editpetugas<?php echo $data['id_petugas']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Edit</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="control/petugas.php" method="post">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="hidden" name="id_petugas" value="<?= $data['id_petugas'] ?>">
                                                    <h6>Nama Petugas</h6>
                                                    <div>
                                                        <input type="text" name="nama_petugas" class="form-control mb-3" value="<?= $data['nama_petugas'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Username</h6>
                                                        <div>
                                                            <input type="text" name="username" class="form-control mb-3" value="<?= $data['username'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6>Password</h6>
                                                            <div>
                                                                <input type="password" name="password" class="form-control mb-3">
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>Level</h6>
                                                                <div>
                                                                    <select name="level" class="form-select mb-3" required>
                                                                        <option hidden><?= $data['level'] ?></option>
                                                                        <option>Admin</option>
                                                                        <option>Petugas</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                                                <button type="submit" class="btn btn-info" name="editpetugas"><i data-feather="save"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="hapuspetugas<?php echo $data['id_petugas']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Hapus</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="control/petugas.php" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_petugas" value="<?= $data['id_petugas'] ?>">
                                                <div class="text-center">
                                                    Yakin Ingin Menghapus Petugas ?<br>
                                                    <div class="text-danger">Nama Petugas - <?php echo $data['nama_petugas'] ?></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-sm-12">
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                                                        <button type="submit" class="btn btn-danger" name="hapuspetugas"><i data-feather="trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#petugas').DataTable();
    });
</script>

<div class="modal fade" id="tambahpetugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h4 class="modal-title" id="staticBackdropLabel">Tambah</h4>
                    </div>
                </div>
            </div>
            <form action="control/petugas.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <h6>Nama Petugas</h6>
                        <div>
                            <input type="text" name="nama_petugas" class="form-control mb-3" required>
                        </div>
                        <div class="mb-3">
                            <h6>Username</h6>
                            <div>
                                <input type="text" name="username" class="form-control mb-3" required>
                            </div>
                            <div class="mb-3">
                                <h6>Password</h6>
                                <div>
                                    <input type="password" name="password" class="form-control mb-3" required>
                                </div>
                                <div class="mb-3">
                                    <h6>Level</h6>
                                    <div>
                                        <select name="level" class="form-select mb-3" required>
                                            <option hidden></option>
                                            <option>Admin</option>
                                            <option>Petugas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                    <button type="submit" class="btn btn-info" name="tambahpetugas"><i data-feather="plus"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>