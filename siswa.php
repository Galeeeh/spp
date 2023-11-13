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

<h1 class="h3 mb-3">Daftar Siswa</h1>

<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-header">
                <?php
                if (!empty($_SESSION['petugas']['level'] == 'admin')) {
                ?>
                    <button data-bs-toggle="modal" data-bs-target="#tambahsiswa" class="btn btn-primary"><i data-feather="user-plus"></i></button>
                <?php
                }
                ?>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-stripped table-hover cell-border" id="siswa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nisn</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas");
                        while ($data = mysqli_fetch_array($query)) {

                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data['nisn']; ?></td>
                                <td><?php echo $data['nis']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['nama_kelas']; ?></td>
                                <td><?php echo $data['kompetensi_keahlian']; ?></td>
                                <td><?php echo $data['jenis_kelamin']; ?></td>
                                <td><?php echo $data['alamat']; ?></td>
                                <td><?php echo $data['no_telp']; ?></td>
                                <td>
                                    <?php
                                    if (!empty($_SESSION['petugas']['level'] == 'admin')) {
                                    ?>
                                        <button data-bs-toggle="modal" data-bs-target="#editsiswa<?php echo $data['nisn']; ?>" class="btn btn-warning"><i data-feather="edit"></i></button>
                                        <button data-bs-toggle="modal" data-bs-target="#hapussiswa<?php echo $data['nisn']; ?>" class="btn btn-danger"><i data-feather="trash-2"></i></button>
                                        <a href="?page=history&nisn=<?php echo $data['nisn'] ?>" class="btn btn-secondary"><i data-feather="clock"></i></a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="?page=history&nisn=<?php echo $data['nisn'] ?>" class="btn btn-secondary"><i data-feather="clock"></i></a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <!-- Modal -->

                            <div class="modal fade" id="editsiswa<?php echo $data['nisn'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Edit</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="control/siswa.php" method="post">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="hidden" name="oldnisn" value="<?= $data['nisn'] ?>">
                                                    <h6>Nisn</h6>
                                                    <div>
                                                        <input type="text" name="nisn" class="form-control mb-3" value="<?= $data['nisn'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <h6>Nis</h6>
                                                        <div>
                                                            <input type="text" name="nis" class="form-control mb-3" value="<?= $data['nis'] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <h6>Nama</h6>
                                                            <div>
                                                                <input type="text" name="nama" class="form-control mb-3" value="<?= $data['nama'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <h6>Password</h6>
                                                                <div>
                                                                    <input type="password" name="password" class="form-control mb-3">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Kelas & Kompetensi Keahlian</label>
                                                                    <select name="id_kelas" class="form-select" required>
                                                                        <?php
                                                                        $query1 = mysqli_query($koneksi, "SELECT * FROM kelas");
                                                                        while ($kelas = mysqli_fetch_array($query1)) {
                                                                        ?>
                                                                            <option value="<?php echo $kelas['id_kelas'] ?>" <?php echo ($data['id_kelas'] == $kelas['id_kelas'] ? 'selected' : '') ?>>
                                                                                <?php echo $kelas['nama_kelas'] ?> - <?php echo $kelas['kompetensi_keahlian'] ?>
                                                                            </option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <h6>Jenis Kelamin</h6>
                                                                    <div>
                                                                        <select name="jenis_kelamin" class="form-select mb-3" required>
                                                                            <option hidden><?= $data['jenis_kelamin'] ?></option>
                                                                            <option>Laki-Laki</option>
                                                                            <option>Perempuan</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <h6>Alamat</h6>
                                                                        <div>
                                                                            <input type="text" name="alamat" class="form-control mb-3" value="<?= $data['alamat'] ?>" required>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <h6>No Telepon</h6>
                                                                            <div>
                                                                                <input type="text" name="no_telp" class="form-control mb-3" value="<?= $data['no_telp'] ?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                                                <button type="submit" class="btn btn-info" name="editsiswa"><i data-feather="save"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="hapussiswa<?php echo $data['nisn']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <h4 class="modal-title" id="staticBackdropLabel">Hapus</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="control/siswa.php" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="nisn" value="<?= $data['nisn'] ?>">
                                                <div class="text-center">
                                                    Yakin Ingin Menghapus Siswa ?<br>
                                                    <div class="text-danger">Nama Siswa - <?php echo $data['nama'] ?></div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="col-sm-12">
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                                                        <button type="submit" class="btn btn-danger" name="hapussiswa"><i data-feather="trash"></i></button>
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
        $('#siswa').DataTable();
    });
</script>

<div class="modal fade" id="tambahsiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-sm-12">
                    <div class="text-center">
                        <h4 class="modal-title" id="staticBackdropLabel">Tambah</h4>
                    </div>
                </div>
            </div>
            <form action="control/siswa.php" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <h6>Nisn</h6>
                        <div>
                            <input type="text" name="nisn" class="form-control mb-3" required>
                        </div>
                        <div class="mb-3">
                            <h6>Nis</h6>
                            <div>
                                <input type="text" name="nis" class="form-control mb-3" required>
                            </div>
                            <div class="mb-3">
                                <h6>Nama</h6>
                                <div>
                                    <input type="text" name="nama" class="form-control mb-3" required>
                                </div>
                                <div class="mb-3">
                                    <h6>Password</h6>
                                    <div>
                                        <input type="password" name="password" class="form-control mb-3" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kelas & Kompetensi Keahlian</label>
                                        <select name="id_kelas" class="form-select" required>
                                            <?php
                                            $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                                            while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                                <option value="<?php echo $data['id_kelas'] ?>"><?php echo $data['nama_kelas'] ?> - <?php echo $data['kompetensi_keahlian'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <h6>Jenis Kelamin</h6>
                                        <div>
                                            <select name="jenis_kelamin" class="form-select mb-3" required>
                                                <option hidden></option>
                                                <option>Laki-Laki</option>
                                                <option>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <h6>Alamat</h6>
                                            <div>
                                                <input type="text" name="alamat" class="form-control mb-3" required>
                                            </div>
                                            <div class="mb-3">
                                                <h6>No Telepon</h6>
                                                <div>
                                                    <input type="text" name="no_telp" class="form-control mb-3" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                    <button type="submit" class="btn btn-info" name="tambahsiswa"><i data-feather="plus"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>