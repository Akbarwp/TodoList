<!DOCTYPE html>
<html lang="en">

<?php
include('head.php');
include('config.php');

if (isset($_POST['btn-add-new-list'])) {
    $kelas = $_POST['kelas'];
    $nid = $_POST['nid'];
    $kode = $_POST['kode'];
    $hari = $_POST['hari'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];

    $sql = mysqli_query($koneksi, "INSERT INTO mengajar (KELAS, NID, KODE_MK, HARI, JAM_MULAI, JAM_SELESAI) VALUES ('$kelas', '$nid', '$kode', '$hari', '$mulai', '$selesai')") or die(mysqli_error($koneksi));

    if ($sql) {
        header("Location: mengajar.php");
        exit();
    } else {
        echo "<script> alert('Gagal menambahkan data') </script>";
    }
}

if (isset($_POST['btn-update-list'])) {
    $kelas = $_POST['kelas'];
    $nid = $_POST['nid'];
    $kode = $_POST['kode'];
    $hari = $_POST['hari'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];

    $sql = mysqli_query($koneksi, "UPDATE mengajar SET KELAS='$kelas', NID = '$nid', KODE_MK = '$kode', HARI = '$hari', JAM_MULAI = '$mulai', JAM_SELESAI = '$selesai' WHERE KELAS = '$kelas' ") or die(mysqli_error($koneksi));

    if ($sql) {
        header("Location: mengajar.php");
        exit();
    } else {
        echo "<script> alert('Gagal memperbaharui data') </script>";
    }
}

if (isset($_POST['btn-delete-list'])) {
    $kelas = $_POST['kelas'];
    $nid = $_POST['nid'];
    $kode = $_POST['kode'];
    $hari = $_POST['hari'];
    $mulai = $_POST['mulai'];
    $selesai = $_POST['selesai'];

    $sql = mysqli_query($koneksi, "DELETE FROM mengajar WHERE KELAS = '$kelas'") or die(mysqli_error($koneksi));

    if ($sql) {
        header("Location: mengajar.php");
        exit();
    } else {
        echo "<script> alert('Gagal menghapus data') </script>";
    }
}
?>

<body>
    <div class="container">
        <?php include('navbar.php') ?>

        <div class="card mt-3 shadow-sm bg-body rounded" data-aos="fade-down" data-aos-duration="1300">
            <div class="card-header">
                <h3 style="float:left">Data Mengajar</h3>

                <!-- Button trigger modal add new list -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="float:right">
                    + Tambah Data
                </button>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">NID</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Jam Mulai</th>
                            <th scope="col">Jam Selesai</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM mengajar") or die(mysqli_error($koneksi));
                        while ($data = mysqli_fetch_assoc($sql)) {
                            echo '
                            <tr>
                                <td>' . $no++ . '</td>
                                <td>' . $data['KELAS'] . '</td>
                                <td>' . $data['NID'] . '</td>
                                <td>' . $data['KODE_MK'] . '</td>
                                <td>' . $data['HARI'] . '</td>
                                <td>' . $data['JAM_MULAI'] . '</td>
                                <td>' . $data['JAM_SELESAI'] . '</td>
                                <td>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal' . $data['KELAS'] . '">
                                    Edit Data
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal1' . $data['KELAS'] . '">
                                    Delete
                                </button>
                                </td>
                            </tr>
                            ';
                        ?>
                            <!-- Modal Update -->
                            <div class="modal fade" id="exampleModal<?= $data['KELAS'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Kelas</label>
                                                    <input type="hidden" name="kelas" value="<?= $data['KELAS'] ?>">
                                                    <input type="text" name="kelas" class="form-control" value="<?= $data['KELAS'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>NID</label>
                                                    <input type="text" name="nid" class="form-control" value="<?= $data['NID'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Kode</label>
                                                    <input type="text" name="kode" class="form-control" value="<?= $data['KODE_MK'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Hari</label>
                                                    <input type="text" name="hari" class="form-control" value="<?= $data['HARI'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Jam Mulai</label>
                                                    <input type="text" name="mulai" class="form-control" value="<?= $data['JAM_MULAI'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Jam Selesai</label>
                                                    <input type="text" name="selesai" class="form-control" value="<?= $data['JAM_SELESAI'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" name="btn-update-list" class="btn btn-primary">Update Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Update -->

                            <!-- Modal Delete -->
                            <div class="modal fade" id="exampleModal1<?= $data['KELAS'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Kelas</label>
                                                    <div class="container border p-2 rounded"><?= $data['KELAS'] ?></div>
                                                    <input type="hidden" name="kelas" class="form-control" value="<?= $data['KELAS'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>NID</label>
                                                    <div class="container border p-2 rounded"><?= $data['NID'] ?></div>
                                                    <input type="hidden" name="nid" class="form-control" value="<?= $data['NID'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Kode</label>
                                                    <div class="container border p-2 rounded"><?= $data['KODE_MK'] ?></div>
                                                    <input type="hidden" name="kode" class="form-control" value="<?= $data['KODE_MK'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Hari</label>
                                                    <div class="container border p-2 rounded"><?= $data['HARI'] ?></div>
                                                    <input type="hidden" name="hari" class="form-control" value="<?= $data['HARI'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Jam Mulai</label>
                                                    <div class="container border p-2 rounded"><?= $data['JAM_MULAI'] ?></div>
                                                    <input type="hidden" name="mulai" class="form-control" value="<?= $data['JAM_MULAI'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Jam Selesai</label>
                                                    <div class="container border p-2 rounded"><?= $data['JAM_SELESAI'] ?></div>
                                                    <input type="hidden" name="selesai" class="form-control" value="<?= $data['JAM_SELESAI'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" name="btn-delete-list" class="btn btn-primary">Delete Data</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Delete -->

                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" name="kelas" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>NID</label>
                                <input type="text" name="nid" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="kode" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Hari</label>
                                <input type="text" name="hari" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Jam Mulai</label>
                                <input type="text" name="mulai" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Jam Selesai</label>
                                <input type="text" name="selesai" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="btn-add-new-list" class="btn btn-primary">Add New Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card mt-3" data-aos="fade-down" data-aos-duration="1500">
            <div class="card-header">
                <h3 style="float:left">Data Dosen</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NID</th>
                            <th scope="col">Nama Depan</th>
                            <th scope="col">Nama Belakang</th>
                            <th scope="col">Gelar</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM dosen") or die(mysqli_error($koneksi));
                        while ($data = mysqli_fetch_assoc($sql)) {
                            echo '
                            <tr>
                                <td>' . $no++ . '</td>
                                <td>' . $data['NID'] . '</td>
                                <td>' . $data['NAMA_DEPAN_DSN'] . '</td>
                                <td>' . $data['NAMA_BLKG_DSN'] . '</td>
                                <td>' . $data['GELAR_AKHIR'] . '</td>
                                <td>' . $data['EMAIL_DOSEN'] . '</td>
                            </tr>
                            ';
                        ?>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-3" data-aos="fade-down" data-aos-duration="1700">
            <div class="card-header">
                <h3 style="float:left">Data Matakuliah</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Matakuliah</th>
                            <th scope="col">SKS</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Min Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($koneksi, "SELECT * FROM matakuliah") or die(mysqli_error($koneksi));
                        while ($data = mysqli_fetch_assoc($sql)) {
                            echo '
                            <tr>
                                <td>' . $no++ . '</td>
                                <td>' . $data['KODE_MK'] . '</td>
                                <td>' . $data['NAMA_MK'] . '</td>
                                <td>' . $data['SKS'] . '</td>
                                <td>' . $data['SEMESTER'] . '</td>
                                <td>' . $data['MIN_NILAI'] . '</td>
                            </tr>
                            ';
                        ?>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>