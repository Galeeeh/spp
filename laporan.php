<?php
if (empty($_SESSION['petugas']['level'])) {
?>
    <script>
        location.reload();
        alert('Akses dilarang.');
        window.history.back();
    </script>
<?php
}
?>
<h1 class="h3 mb-3"><strong></strong>Laporan</h1>
<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-header">
                <?php
                if (!empty($_SESSION['petugas']['level'] && !empty($_SESSION['petugas']['level'] == 'admin'))) {
                ?>
                    <a href="cetak_laporan.php" target="_blank" class="btn btn-info"><i data-feather="printer"></i></a>
                <?php
                }
                ?>
            </div>
            <div class="card-body">
                <table class=" table table-bordered table-striped table-hover cell-border">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Petugas</th>
                            <th>Nama Siswa</th>
                            <th>Tanggal Bayar</th>
                            <th>Spp</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp");
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?> </td>
                                <td><?php echo $data['nama_petugas'] ?></td>
                                <td><?php echo $data['nama'] ?></td>
                                <td><?php echo $data['tgl_bayar'] ?></td>
                                <td><?php echo $data['tahun'] ?> - Rp <?php echo number_format($data['nominal'], 2, ',', '.') ?></td>
                                <td>Rp <?php echo number_format($data['jumlah_bayar'], 2, ',', '.') ?></td>
                                <td>
                                    <?php
                                    if ($data['jumlah_bayar'] < $data['nominal']) {
                                        echo 'Kurang';
                                    } else {
                                        echo 'Lunas';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($data['jumlah_bayar'] == $data['nominal']) {
                                    ?>
                                        <button class="btn btn-success btn-sm">Lunas</button>
                                    <?php
                                    } else {
                                    ?>
                                        <button data-bs-toggle="modal" data-bs-target="#lunasi<?php echo $data['id_pembayaran']; ?>" class="btn btn-warning btn-sm">Lunasi</button>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="lunasi<?php echo $data['id_pembayaran']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Lunasi Pembayaran</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="control/pembayaran.php" method="post">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="hidden" name="id_pembayaran" value="<?= $data['id_pembayaran'] ?>">
                                                    <h6>Nama Petugas</h6>
                                                    <div>
                                                        <input type="text" name="nama_petugas" class="form-control mb-3" value="<?= $data['nama_petugas'] ?>" disabled>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Nama Siswa</h6>
                                                        <div>
                                                            <input type="text" name="nama" class="form-control mb-3" value="<?= $data['nama'] ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Tanggal Bayar</h6>
                                                        <div>
                                                            <input type="date" name="old_tgl_bayar" class="form-control mb-3" value="<?= $data['tgl_bayar'] ?>" disabled>
                                                            <input type="hidden" class="form-control mb-3" name="tgl_bayar" value="<?php echo date('Y-m-d') ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Spp</h6>
                                                        <div>
                                                            <input type="text" name="id_spp" class="form-control mb-3" value="<?php echo $data['tahun'] ?> - Rp <?php echo number_format($data['nominal'], 2, ',', '.') ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Kekurangan</h6>
                                                        <div>
                                                            <input type="text" name="kekurangan" class="form-control mb-3" value="<?php echo $data['nominal'] - $data['jumlah_bayar'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Jumlah Pembayaran</h6>
                                                        <div>
                                                            <input type="hidden" name="old_jumlah_bayar" class="form-control mb-3" value="<?= $data['jumlah_bayar'] ?>">
                                                            <input type="text" name="jumlah_bayar" class="form-control mb-3">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                                                <button type="submit" class="btn btn-info" name="lunasi"><i data-feather="save"></i></button>
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