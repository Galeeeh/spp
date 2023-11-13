<?php
include 'koneksi.php';
if (empty($_SESSION['petugas'])) {
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>SPP -
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'Dashboard';
        $cek = preg_replace('/-/', ' ', $page);
        $title = ucwords($cek);
        echo $title;
        ?>
    </title>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <link href="css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.php">
                    <span class="align-middle">Admin</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Halaman
                    </li>
                    <?php
                    if (!empty($_SESSION['petugas']['level']) && !empty($_SESSION['petugas']['level'] == 'admin')) {
                    ?>
                        <li class="sidebar-item 
					<?php
                        if (empty($_GET['page'])) {
                            echo 'active';
                        }
                    ?>
					">
                            <a class="sidebar-link" href="index.php">
                                <i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
                            </a>
                        </li>

                        <li class="sidebar-item 
                    <?php
                        if ($page == 'petugas') {
                            echo 'active';
                        }
                    ?>

					">
                            <a class="sidebar-link" href="?page=petugas">
                                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Petugas</span>
                            </a>
                        </li>

                        <li class="sidebar-item
					<?php
                        if ($page == 'kelas') {
                            echo 'active';
                        }
                    ?>
					
					">
                            <a class="sidebar-link" href="?page=kelas">
                                <i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Kelas</span>
                            </a>
                        </li>

                        <li class="sidebar-item
					<?php
                        if ($page == 'siswa') {
                            echo 'active';
                        }
                    ?>
					">
                            <a class="sidebar-link" href="?page=siswa">
                                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Siswa</span>
                            </a>
                        </li>

                        <li class="sidebar-item
					<?php
                        if ($page == 'spp') {
                            echo 'active';
                        }
                    ?>
					">
                            <a class="sidebar-link" href="?page=spp">
                                <i class="align-middle" data-feather="credit-card"></i> <span class="align-middle">Spp</span>
                            </a>
                        </li>

                        <li class="sidebar-item
					<?php
                        if ($page == 'laporan') {
                            echo 'active';
                        }
                    ?>
					">
                            <a class="sidebar-link" href="?page=laporan">
                                <i class="align-middle" data-feather="folder"></i> <span class="align-middle">Laporan</span>
                            </a>
                        </li>
                        <div class="sidebar-cta">
                            <div class="sidebar-cta-content">
                                <div class="d-grid">
                                    <button data-bs-toggle="modal" data-bs-target="#tambahpembayaran" class="btn btn-success"><i data-feather="shopping-cart"></i></button>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        if (!empty($_SESSION['petugas']['level']) && !empty($_SESSION['petugas']['level'] == 'petugas')) {
                        ?>
                            <li class="sidebar-item 
                        <?php
                            if (empty($_GET['page'])) {
                                echo 'active';
                            }
                        ?>
                        ">
                                <a class="sidebar-link" href="index.php">
                                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
                                </a>
                            </li>

                            <li class="sidebar-item
                        <?php
                            if ($page == 'siswa') {
                                echo 'active';
                            }
                        ?>
                        ">
                                <a class="sidebar-link" href="?page=siswa">
                                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Siswa</span>
                                </a>
                            </li>

                            <li class="sidebar-item
                        <?php
                            if ($page == 'laporan') {
                                echo 'active';
                            }
                        ?>
                        ">
                                <a class="sidebar-link" href="?page=laporan">
                                    <i class="align-middle" data-feather="folder"></i> <span class="align-middle">Laporan</span>
                                </a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="sidebar-item 
                        <?php
                            if (empty($_GET['page'])) {
                                echo 'active';
                            }
                        ?>
                        ">
                                <a class="sidebar-link" href="index.php">
                                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>

                </ul>

            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark">
                                    <?php
                                    if (!empty($_SESSION['petugas']['level'])) {
                                        echo $_SESSION['petugas']['nama_petugas'];
                                    } else {
                                        echo $_SESSION['petugas']['nama'];
                                    }
                                    ?>
                                </span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="logout.php"><i class="align-middle me-1" data-feather="log-out"></i>Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
                    include $page . '.php';
                    ?>


                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://instagram.com/galiiihngrh?igshid=MzRlODBiNWFIZA==/" target="_blank"><strong><i class="align-middle me-1" data-feather="instagram"></i>galiiihngrh</strong></a> -
                                <a class="text-muted" href="https://x.com/galiiih__?t=EaGXuDOsYyGg45TSId6dJA&s=09/" target="_blank"><strong><i class="align-middle me-1" data-feather="twitter"></i>@Galiiih__</strong></a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="js/app.js"></script>

    <div class="modal fade" id="tambahpembayaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-12">
                        <div class="text-center">
                            <h4 class="modal-title" id="staticBackdropLabel">Tambah Pembayaran</h4>
                        </div>
                    </div>
                </div>
                <form action="control/pembayaran.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <select name="nisn" class="form-select">
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM siswa");
                                while ($data = mysqli_fetch_array($query)) {
                                ?>
                                    <option value="<?php echo $data['nisn'] ?>"><?php echo $data['nama'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <h6>Tanggal Pembayaran</h6>
                            <div>
                                <input type="date" name="tgl_bayar" class="form-control mb-3">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tahun & Nominal</label>
                                <select name="id_spp" class="form-select">
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM spp");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $data['id_spp'] ?>"><?php echo $data['tahun'] ?> - Rp <?php echo number_format($data['nominal'], 2, ',', '.') ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <h6>Jumlah Bayar</h6>
                                <div>
                                    <input type="text" name="jumlah_bayar" class="form-control mb-3">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal"><i data-feather="x"></i></button>
                        <button type="submit" class="btn btn-info" name="tambahpembayaran"><i data-feather="plus"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>