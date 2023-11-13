<?php
include '../koneksi.php';
if (isset($_POST['tambahsiswa'])) {
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $password = md5($_POST['password']);
    $id_kelas = $_POST['id_kelas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    $cek_nisn = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
    $cek_nis = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");

    if (mysqli_num_rows($cek_nisn) > 0 && mysqli_num_rows($cek_nis) > 0) {
        echo '<script>alert("NISN & NIS Sudah Digunakan.");location.href="../?page=siswa";</script>';
    } elseif (mysqli_num_rows($cek_nisn) > 0) {
        echo '<script>alert("NISN Sudah Digunakan.");location.href="../?page=siswa";</script>';
    } elseif (mysqli_num_rows($cek_nis) > 0) {
        echo '<script>alert("NIS Sudah Digunakan.");location.href="../?page=siswa";</script>';
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO siswa (nisn,nis,nama,password,id_kelas,jenis_kelamin,alamat,no_telp) VALUES ('$nisn','$nis','$nama','$password','$id_kelas','$jenis_kelamin','$alamat','$no_telp') ");
        if ($query) {
            echo '<script>alert("Data Berhasil Di Tambah");location.href="../?page=siswa";</script>';
        }
    }
}

if (isset($_POST['editsiswa'])) {
    $oldnisn = $_POST['oldnisn'];
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $password = md5($_POST['password']);
    $id_kelas = $_POST['id_kelas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    $cek_nisn = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn' AND nisn!= '$oldnisn'");
    $cek_nis = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis' AND nisn!= '$oldnisn'");

    if (mysqli_num_rows($cek_nisn) > 0 && mysqli_num_rows($cek_nis) > 0) {
        echo '<script>alert("NISN & NIS Sudah Digunakan.");location.href="../?page=siswa";</script>';
    } elseif (mysqli_num_rows($cek_nisn) > 0) {
        echo '<script>alert("NISN Sudah Digunakan.");location.href="../?page=siswa";</script>';
    } elseif (mysqli_num_rows($cek_nis) > 0) {
        echo '<script>alert("NIS Sudah Digunakan.");location.href="../?page=siswa";</script>';
    } else {
        if ($_POST['password'] == '') {
            $query = mysqli_query($koneksi, "UPDATE siswa SET nisn = '$nisn', nis = '$nis', nama = '$nama', id_kelas = '$id_kelas', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', no_telp = '$no_telp' WHERE nisn = $oldnisn");
            if ($query) {
                echo '<script>alert("Data Berhasil di Update");location.href="../?page=siswa";</script>';
            }
        } else {
            $query = mysqli_query($koneksi, "UPDATE siswa SET nisn = '$nisn', nis = '$nis', nama = '$nama', password = '$password', id_kelas = '$id_kelas', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', no_telp = '$no_telp' WHERE nisn = $oldnisn");
            if ($query) {
                echo '<script>alert("Data Berhasil di Update");location.href="../?page=siswa";</script>';
            }
        }
    }
}

if (isset($_POST['hapussiswa'])) {
    $nisn = $_POST['nisn'];

    $query = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisn = '$nisn'");
    if ($query) {
        echo '<script>alert("Data Berhasil Di Hapus");location.href="../?page=siswa";</script>';
    }
}
