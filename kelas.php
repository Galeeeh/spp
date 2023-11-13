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

<h1 class="h3 mb-3"><strong></strong>Kelas</h1>
<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-header">
                <button data-bs-toggle="modal" data-bs-target="#tambahkelas" class="btn btn-primary"><i data-feather="user-plus"></i></button>
            </div>
            <div class="card-body">
                <table class=" table table-bordered table-striped table-hover cell-border" id="kelas">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?> </td>
                                <td><?php echo $data['nama_kelas'] ?></td>
                                <td><?php echo $data['kompetensi_keahlian'] ?></td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#editkelas<?php echo $data['id_kelas']; ?>" class="btn btn-warning"><i data-feather="edit"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#hapuskelas<?php echo $data['id_kelas']; ?>" class="btn btn-danger"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="editkelas<?php echo $data['id_kelas']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Edit</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="control/kelas.php" method="post">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="hidden" name="id_kelas" value="<?= $data['id_kelas'] ?>">
                                                    <h6>Nama Kelas</h6>
                                                    <div>
                                                        <input type="text" name="nama_kelas" class="form-control mb-3" value="<?= $data['nama_kelas'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Kompetensi Keahlian</h6>
                                                        <div>
                                                            <input type="text" name="kompetensi_keahlian" class="form-control mb-3" value="<?= $data['kompetensi_keahlian'] ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                                                <button type="submit" class="btn btn-info" name="editkelas"><i data-feather="save"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="hapuskelas<?php echo $data['id_kelas']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Hapus</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="control/kelas.php" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_kelas" value="<?= $data['id_kelas'] ?>">
                                                <div class="text-center">
                                                    Yakin Ingin Menghapus Kelas ?<br>
                                                    <div class="text-danger">Nama Kelas- <?php echo $data['nama_kelas'] ?></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-sm-12">
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                                                        <button type="submit" class="btn btn-danger" name="hapuskelas"><i data-feather="trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php
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
        $('#kelas').DataTable();
    });
</script>

<div class="modal fade" id="tambahkelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h4 class="modal-title" id="staticBackdropLabel">Tambah</h4>
                    </div>
                </div>
            </div>
            <form action="control/kelas.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="id_kelas">
                        <h6>Nama Kelas</h6>
                        <div>
                            <input type="text" name="nama_kelas" class="form-control mb-3" required>
                        </div>
                        <div class="mb-3">
                            <h6>Kompetensi Keahlian</h6>
                            <div>
                                <input type="text" name="kompetensi_keahlian" class="form-control mb-3" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                    <button type="submit" class="btn btn-info" name="tambahkelas"><i data-feather="plus"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>