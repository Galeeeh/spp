<?php
date_default_timezone_set('Asia/Jakarta');
$nama_hari = array(
    'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
);
$nama_bulan = array(
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
);

$index_hari = date('w');
$index_bulan = date('n') - 1;
?>

<center>
    <h1 class="h3 mb-3"><strong>Home</strong></h1>
</center>

<div class="row">
    <div class="w-100">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Hi,
                            <?php
                            if (!empty($_SESSION['petugas']['level'])) {
                                echo $_SESSION['petugas']['nama_petugas'];
                            } else {
                                echo $_SESSION['petugas']['nama'];
                            }
                            ?><br>
                            Selamat Datang di Aplikasi Pembayaran SPP
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td width="12%">Nama</td>
                                <td width="1">:</td>
                                <td>
                                    <?php
                                    if (!empty($_SESSION['petugas']['level'])) {
                                        echo $_SESSION['petugas']['nama_petugas'];
                                    } else {
                                        echo $_SESSION['petugas']['nama'];
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            if (!empty($_SESSION['petugas']['level'])) {
                            ?>
                                <tr>
                                    <td width="12%">Level</td>
                                    <td width="1">:</td>
                                    <td><?php echo $_SESSION['petugas']['level'] ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td width="12%">Tanggal Login</td>
                                <td width="1">:</td>
                                <td><?php echo $nama_hari[$index_hari] . ', ' . date('d') . ' ' . $nama_bulan[$index_bulan] . ' ' . date('Y') . ', ' . date('H:i:s', $_SESSION['waktu_login']) . ' WIB' ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (!empty($_SESSION['petugas']['level'])) {
?>
    <div class="row">
        <div class="col-12">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Jumlah Petugas</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM petugas");
                                    $data = mysqli_fetch_array($query);
                                    echo $data['total'];

                                    ?>
                                </h1>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Jumlah Kelas</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="monitor"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kelas");
                                    $data = mysqli_fetch_array($query);
                                    echo $data['total'];

                                    ?>
                                </h1>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Jumlah Siswa</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="users"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM siswa");
                                    $data = mysqli_fetch_array($query);
                                    echo $data['total'];

                                    ?>
                                </h1>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Jumlah Pembayaran</h5>
                                    </div>


                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="credit-card"></i>
                                        </div>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total FROM pembayaran");
                                    $data = mysqli_fetch_array($query);
                                    ?>
                                    Rp<?php echo  number_format($data['total'], 2, ',', '.') ?>
                                </h1>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
?>
    <div class="row">
        <div class="col-12">
            <div class="card flex-fill">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nisn = $_SESSION['petugas']['nisn'];
                            $no = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp WHERE pembayaran.nisn='$nisn'");
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
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>