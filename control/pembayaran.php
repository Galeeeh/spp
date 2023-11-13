<?php
include '../koneksi.php';
if (isset($_POST['tambahpembayaran'])) {
    $id_petugas = $_SESSION['petugas']['id_petugas'];
    $nisn = $_POST['nisn'];
    $tgl_bayar = $_POST['tgl_bayar'];
    $spp = $_POST['id_spp'];
    $jumlah_bayar = $_POST['jumlah_bayar'];

    $nominal = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp = '$spp'");
    $data = mysqli_fetch_array($nominal);

    $sisa = $jumlah_bayar - $data['nominal'];
    $total = $jumlah_bayar - $sisa;
    $kurang = $data['nominal'] - $jumlah_bayar;

    if ($jumlah_bayar > $data['nominal']) {
        $query = mysqli_query($koneksi, "INSERT INTO pembayaran (id_petugas,nisn,tgl_bayar,id_spp,jumlah_bayar) VALUES ('$id_petugas','$nisn','$tgl_bayar','$spp','$total') ");
        if ($query) {
            echo '<script>alert("SPP Terbayar || Saldo Anda Di Kembalikan Sebesar : Rp ' . number_format($sisa, 2, ',', '.') . '");location.href="../?page=laporan";</script>';
        }
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO pembayaran (id_petugas,nisn,tgl_bayar,id_spp,jumlah_bayar) VALUES ('$id_petugas','$nisn','$tgl_bayar','$spp','$jumlah_bayar') ");
        if ($query) {
            echo '<script>alert("SPP Terbayar || Kekkurangan Sebesar : Rp ' . number_format($kurang, 2, ',', '.') . '");location.href="../?page=laporan";</script>';
        }
    }
}

if (isset($_POST['lunasi'])) {
    $id_pembayaran = $_POST['id_pembayaran'];
    $kekurangan = $_POST['kekurangan'];
    $old_jumlah_bayar = $_POST['old_jumlah_bayar'];
    $jumlah_bayar = $_POST['jumlah_bayar'];
    $tanggal_bayar = $_POST['tanggal_bayar'];

    $total = $old_jumlah_bayar + $kekurangan;
    $total1 = $old_jumlah_bayar + $jumlah_bayar;
    $sisa = $jumlah_bayar - $kekurangan;
    $sisa1 = $kekurangan - $jumlah_bayar;
    $kurang = $kekurangan - $jumlah_bayar;

    if ($jumlah_bayar > $kekurangan) {
        $query = mysqli_query($koneksi, "UPDATE pembayaran SET jumlah_bayar='$total' WHERE id_pembayaran='$id_pembayaran'");
        if ($query) {
            echo '<script>alert("SPP Terbayar || Saldo Anda Di Kembalikan Sebesar : Rp ' . number_format($sisa, 2, ',', '.') . '");location.href="../?page=laporan";</script>';
        }
    } elseif ($jumlah_bayar < $kekurangan) {
        $query = mysqli_query($koneksi, "UPDATE pembayaran SET jumlah_bayar='$total1' WHERE id_pembayaran='$id_pembayaran'");
        if ($query) {
            echo '<script>alert("SPP Terbayar || Kekurangan Sebesar : Rp ' . number_format($kurang, 2, ',', '.') . '");location.href="../?page=laporan";</script>';
        }
    } else {
        $query = mysqli_query($koneksi, "UPDATE pembayaran SET jumlah_bayar='$total1' WHERE id_pembayaran='$id_pembayaran'");
        if ($query) {
            echo '<script>alert("SPP Terbayar || Saldo Anda Di Kembalikan Sebesar : Rp ' . number_format($sisa1, 2, ',', '.') . '");location.href="../?page=laporan";</script>';
        }
    }
}
