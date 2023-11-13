<?php
include '../koneksi.php';
if (isset($_POST['editspp'])) {
    $id_spp = $_POST['id_spp'];
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];

    $query = mysqli_query($koneksi, "UPDATE spp SET tahun = '$tahun', nominal = '$nominal' WHERE id_spp =$id_spp");
    if ($query) {
        echo '<script>alert("Data Berhasil Di Ubah");location.href="../?page=spp";</script>';
    }
}

if (isset($_POST['tambahspp'])) {
    $id_spp = $_POST['id_spp'];
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];

    $query = mysqli_query($koneksi, "INSERT INTO spp (tahun,nominal) VALUES ('$tahun','$nominal') ");
    if ($query) {
        echo '<script>alert("Data Berhasil Di Tambah");location.href="../?page=spp";</script>';
    }
}

if (isset($_POST['hapusspp'])) {
    $id_spp = $_POST['id_spp'];

    $query = mysqli_query($koneksi, "DELETE FROM spp WHERE id_spp = '$id_spp'");
    if ($query) {
        echo '<script>alert("Data Berhasil Di Hapus");location.href="../?page=spp";</script>';
    }
}
