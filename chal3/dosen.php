<!DOCTYPE html>
<html lang="en">

<?php
include('head.php');
include('config.php');

if (isset($_POST['btn-add-new-list'])) {
  $nid = $_POST['nid'];
  $nmdepan = $_POST['nmdepan'];
  $nmblkg = $_POST['nmblkg'];
  $gelar = $_POST['gelar'];
  $email = $_POST['email'];

  $sql = mysqli_query($koneksi, "INSERT INTO dosen (NID, NAMA_DEPAN_DSN, NAMA_BLKG_DSN, GELAR_AKHIR, EMAIL_DOSEN) VALUES ('$nid', '$nmdepan', '$nmblkg', '$gelar', '$email')") or die(mysqli_error($koneksi));

  if ($sql) {
    header("Location: dosen.php");
    exit();
  } else {
    echo "<script> alert('Gagal menambahkan data') </script>";
  }
}

if (isset($_POST['btn-update-list'])) {
  $nid = $_POST['nid'];
  $nmdepan = $_POST['nmdepan'];
  $nmblkg = $_POST['nmblkg'];
  $gelar = $_POST['gelar'];
  $email = $_POST['email'];

  $sql = mysqli_query($koneksi, "UPDATE dosen SET NID='$nid', NAMA_DEPAN_DSN = '$nmdepan', NAMA_BLKG_DSN = '$nmblkg', GELAR_AKHIR = '$gelar', EMAIL_DOSEN = '$email' WHERE NID = '$nid' ") or die(mysqli_error($koneksi));

  if ($sql) {
    header("Location: dosen.php");
    exit();
  } else {
    echo "<script> alert('Gagal memperbaharui data') </script>";
  }
}

if (isset($_POST['btn-delete-list'])) {
  $nid = $_POST['nid'];
  $nmdepan = $_POST['nmdepan'];
  $nmblkg = $_POST['nmblkg'];
  $gelar = $_POST['gelar'];
  $email = $_POST['email'];

  $sql = mysqli_query($koneksi, "DELETE FROM dosen WHERE NID = '$nid'") or die(mysqli_error($koneksi));

  if ($sql) {
    header("Location: dosen.php");
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
        <h3 style="float:left">Data Dosen</h3>

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
              <th scope="col">NID</th>
              <th scope="col">Nama Depan</th>
              <th scope="col">Nama Belakang</th>
              <th scope="col">Gelar</th>
              <th scope="col">Email</th>
              <th scope="col">Action</th>
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
                <td>
                  <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal' . $data['NID'] . '">
                    Edit Data
                  </button>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal1' . $data['NID'] . '">
                    Delete
                  </button>
                </td>
              </tr>
              ';
            ?>

              <!-- Modal Update -->
              <div class="modal fade" id="exampleModal<?= $data['NID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <label>NID</label>
                          <input type="hidden" name="nid" value="<?= $data['NID'] ?>">
                          <input type="text" name="nid" class="form-control" value="<?= $data['NID'] ?>" required>
                        </div>

                        <div class="form-group">
                          <label>Nama Depan</label>
                          <input type="text" name="nmdepan" class="form-control" value="<?= $data['NAMA_DEPAN_DSN'] ?>" required>
                        </div>

                        <div class="form-group">
                          <label>Nama Belakang</label>
                          <input type="text" name="nmblkg" class="form-control" value="<?= $data['NAMA_BLKG_DSN'] ?>" required>
                        </div>

                        <div class="form-group">
                          <label>Gelar</label>
                          <input type="text" name="gelar" class="form-control" value="<?= $data['GELAR_AKHIR'] ?>" required>
                        </div>

                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email" class="form-control" value="<?= $data['EMAIL_DOSEN'] ?>" required>
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
              <div class="modal fade" id="exampleModal1<?= $data['NID'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <label>NID</label>
                          <div class="container border p-2 rounded"><?= $data['NID'] ?></div>
                          <input type="hidden" name="nid" class="form-control" value="<?= $data['NID'] ?>" required>
                        </div>

                        <div class="form-group">
                          <label>Nama Depan</label>
                          <div class="container border p-2 rounded"><?= $data['NAMA_DEPAN_DSN'] ?></div>
                          <input type="hidden" name="nmdepan" class="form-control" value="<?= $data['NAMA_DEPAN_DSN'] ?>" required>
                        </div>

                        <div class="form-group">
                          <label>Nama Belakang</label>
                          <div class="container border p-2 rounded"><?= $data['NAMA_BLKG_DSN'] ?></div>
                          <input type="hidden" name="nmblkg" class="form-control" value="<?= $data['NAMA_BLKG_DSN'] ?>" required>
                        </div>

                        <div class="form-group">
                          <label>Gelar</label>
                          <div class="container border p-2 rounded"><?= $data['GELAR_AKHIR'] ?></div>
                          <input type="hidden" name="gelar" class="form-control" value="<?= $data['GELAR_AKHIR'] ?>" required>
                        </div>

                        <div class="form-group">
                          <label>Email</label>
                          <div class="container border p-2 rounded"><?= $data['EMAIL_DOSEN'] ?></div>
                          <input type="hidden" name="email" class="form-control" value="<?= $data['EMAIL_DOSEN'] ?>" required>
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
                <label>NID</label>
                <input type="text" name="nid" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Nama Depan</label>
                <input type="text" name="nmdepan" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Nama Belakang</label>
                <input type="text" name="nmblkg" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Gelar</label>
                <input type="text" name="gelar" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
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