<?php
include '../koneksi.php';
if (isset($_POST['editpetugas'])) {
    $id_petugas = $_POST['id_petugas'];
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    if ($_POST['password'] == '') {
        $query = mysqli_query($koneksi, "UPDATE petugas SET nama_petugas = '$nama_petugas', username = '$username', level = '$level' WHERE id_petugas = $id_petugas");
        if ($query) {
            echo '<script>alert("Data Berhasil di Update");location.href="../?page=petugas";</script>';
        }
    } else {
        $query = mysqli_query($koneksi, "UPDATE petugas SET nama_petugas = '$nama_petugas', password = '$password', username = '$username', level = '$level' WHERE id_petugas = $id_petugas");
        if ($query) {
            echo '<script>alert("Data Berhasil di Update");location.href="../?page=petugas";</script>';
        }
    }
}

if (isset($_POST['tambahpetugas'])) {
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    $query = mysqli_query($koneksi, "INSERT INTO petugas (nama_petugas,username,password,level) VALUES ('$nama_petugas','$username','$password','$level') ");
    if ($query) {
        echo '<script>alert("Data Berhasil Di Tambah");location.href="../?page=petugas";</script>';
    }
}

if (isset($_POST['hapuspetugas'])) {
    $id_petugas = $_POST['id_petugas'];

    $query = mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas='$id_petugas'");
    if ($query) {
        echo '<script>alert("Data Berhasil Di Haous");location.href="../?page=petugas";</script>';
    }
}
