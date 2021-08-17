<!DOCTYPE html>
<html lang="en">

<?php
include('head.php');
include('config.php');

if (isset($_POST['btn-add-new-list'])) {
    $kode = $_POST['kode'];
    $mk = $_POST['mk'];
    $sks = $_POST['sks'];
    $smstr = $_POST['smstr'];
    $nilai = $_POST['nilai'];

    $sql = mysqli_query($koneksi, "INSERT INTO matakuliah (KODE_MK, NAMA_MK, SKS, SEMESTER, MIN_NILAI) VALUES ('$kode', '$mk', '$sks', '$smstr', '$nilai')") or die(mysqli_error($koneksi));

    if ($sql) {
        header("Location: matakuliah.php");
        exit();
    } else {
        echo "<script> alert('Gagal menambahkan data') </script>";
    }
}

if (isset($_POST['btn-update-list'])) {
    $kode = $_POST['kode'];
    $mk = $_POST['mk'];
    $sks = $_POST['sks'];
    $smstr = $_POST['smstr'];
    $nilai = $_POST['nilai'];

    $sql = mysqli_query($koneksi, "UPDATE matakuliah SET KODE_MK='$kode', NAMA_MK = '$mk', SKS = '$sks', SEMESTER = '$smstr', MIN_NILAI = '$nilai' WHERE KODE_MK = '$kode' ") or die(mysqli_error($koneksi));

    if ($sql) {
        header("Location: matakuliah.php");
        exit();
    } else {
        echo "<script> alert('Gagal memperbaharui data') </script>";
    }
}

if (isset($_POST['btn-delete-list'])) {
    $kode = $_POST['kode'];
    $mk = $_POST['mk'];
    $sks = $_POST['sks'];
    $smstr = $_POST['smstr'];
    $nilai = $_POST['nilai'];

    $sql = mysqli_query($koneksi, "DELETE FROM matakuliah WHERE KODE_MK = '$kode'") or die(mysqli_error($koneksi));

    if ($sql) {
        header("Location: matakuliah.php");
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
                <h3 style="float:left">Data Matakuliah</h3>

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
                            <th scope="col">Kode</th>
                            <th scope="col">Nama Matakuliah</th>
                            <th scope="col">SKS</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Min Nilai</th>
                            <th scope="col">Action</th>
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
                                <td>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal' . $data['KODE_MK'] . '">
                                    Edit Data
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal1' . $data['KODE_MK'] . '">
                                    Delete
                                </button>
                                </td>
                            </tr>
                            ';
                        ?>
                            <!-- Modal Update -->
                            <div class="modal fade" id="exampleModal<?= $data['KODE_MK'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <label>Kode</label>
                                                    <input type="hidden" name="kode" value="<?= $data['KODE_MK'] ?>">
                                                    <input type="text" name="kode" class="form-control" value="<?= $data['KODE_MK'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Nama Matakuliah</label>
                                                    <input type="text" name="mk" class="form-control" value="<?= $data['NAMA_MK'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>SKS</label>
                                                    <input type="number" name="sks" class="form-control" value="<?= $data['SKS'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Semester</label>
                                                    <input type="text" name="smstr" class="form-control" value="<?= $data['SEMESTER'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Min Nilai</label>
                                                    <input type="number" name="nilai" class="form-control" value="<?= $data['MIN_NILAI'] ?>" required>
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
                            <div class="modal fade" id="exampleModal1<?= $data['KODE_MK'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <label>Kode</label>
                                                    <div class="container border p-2 rounded"><?= $data['KODE_MK'] ?></div>
                                                    <input type="hidden" name="kode" class="form-control" value="<?= $data['KODE_MK'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Nama Matakuliah</label>
                                                    <div class="container border p-2 rounded"><?= $data['NAMA_MK'] ?></div>
                                                    <input type="hidden" name="nama" class="form-control" value="<?= $data['NAMA_MK'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Kode</label>
                                                    <div class="container border p-2 rounded"><?= $data['KODE_MK'] ?></div>
                                                    <input type="hidden" name="kode" class="form-control" value="<?= $data['KODE_MK'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>SKS</label>
                                                    <div class="container border p-2 rounded"><?= $data['SKS'] ?></div>
                                                    <input type="hidden" name="sks" class="form-control" value="<?= $data['SKS'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Semester</label>
                                                    <div class="container border p-2 rounded"><?= $data['SEMESTER'] ?></div>
                                                    <input type="hidden" name="semester" class="form-control" value="<?= $data['SEMESTER'] ?>" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Min Nilai</label>
                                                    <div class="container border p-2 rounded"><?= $data['MIN_NILAI'] ?></div>
                                                    <input type="hidden" name="nilai" class="form-control" value="<?= $data['MIN_NILAI'] ?>" required>
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
                                <label>Kode</label>
                                <input type="text" name="kode" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Nama Matakuliah</label>
                                <input type="text" name="mk" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>SKS</label>
                                <input type="number" name="sks" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Semester</label>
                                <input type="text" name="smstr" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Min Nilai</label>
                                <input type="number" name="nilai" class="form-control" required>
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
    </div>
</body>

</html>