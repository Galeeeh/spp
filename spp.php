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

<h1 class="h3 mb-3"><strong></strong>Spp</h1>
<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-header">
                <button data-bs-toggle="modal" data-bs-target="#tambahspp" class="btn btn-primary"><i data-feather="user-plus"></i></button>
            </div>
            <div class="card-body">
                <table class=" table table-bordered table-striped table-hover cell-border" id="spp">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM spp");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?> </td>
                                <td><?php echo $data['tahun'] ?></td>
                                <td>Rp <?php echo number_format($data['nominal'], 2, ',', '.') ?></td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#editspp<?php echo $data['id_spp']; ?>" class="btn btn-warning"><i data-feather="edit"></i></button>
                                    <button data-bs-toggle="modal" data-bs-target="#hapusspp<?php echo $data['id_spp']; ?>" class="btn btn-danger"><i data-feather="trash-2"></i></button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="editspp<?php echo $data['id_spp']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Edit</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="control/spp.php" method="post">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="hidden" name="id_spp" value="<?= $data['id_spp'] ?>">
                                                    <h6>Tahun</h6>
                                                    <div>
                                                        <input type="text" name="tahun" class="form-control mb-3" value="<?= $data['tahun'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Nominal</h6>
                                                        <div>
                                                            <input type="text" name="nominal" class="form-control mb-3" value="<?= $data['nominal'] ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                                                <button type="submit" class="btn btn-info" name="editspp"><i data-feather="save"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="hapusspp<?php echo $data['id_spp']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Hapus</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="control/spp.php" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id_spp" value="<?= $data['id_spp'] ?>">
                                                <div class="text-center">
                                                    Yakin Ingin Menghapus Spp ?<br>
                                                    <div class="text-danger">
                                                        Tahun- <?php echo $data['tahun'] ?><br>
                                                        Nominal- <?php echo $data['nominal'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-sm-12">
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                                                        <button type="submit" class="btn btn-danger" name="hapusspp"><i data-feather="trash"></i></button>
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
        $('#spp').DataTable();
    });
</script>

<div class="modal fade" id="tambahspp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h4 class="modal-title" id="staticBackdropLabel">Tambah</h4>
                    </div>
                </div>
            </div>
            <form action="control/spp.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" name="id_spp">
                        <h6>Tahun</h6>
                        <div>
                            <input type="text" name="tahun" class="form-control mb-3" required>
                        </div>
                        <div class="mb-3">
                            <h6>Nominal</h6>
                            <div>
                                <input type="text" name="nominal" class="form-control mb-3" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                    <button type="submit" class="btn btn-info" name="tambahspp"><i data-feather="plus"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>