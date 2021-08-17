<!DOCTYPE html>
<html lang="en">

<?php
include('head.php');
include('config.php');

if (isset($_POST['btn-add-new-list'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $time = $_POST['time'];

  $sql = mysqli_query($koneksi, "INSERT INTO list (title, description, time) VALUES ('$title', '$description', '$time')") or die(mysqli_error($koneksi));

  if ($sql) {
    header("Location: list.php");
    exit();
  } else {
    echo "<script> alert('Gagal menambahkan list') </script>";
  }
}

if (isset($_POST['btn-update-list'])) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $time = $_POST['time'];
  $time_before = $_POST['time_before'];

  if ($time == "") {
    $time = $time_before;
  }

  $sql = mysqli_query($koneksi, "UPDATE list SET title='$title', description = '$description', time = '$time' WHERE id = '$id' ") or die(mysqli_error($koneksi));

  if ($sql) {
    header("Location: list.php");
    exit();
  } else {
    echo "<script> alert('Gagal memperbaharui list') </script>";
  }
}

if (isset($_GET['listid'])) {
  $id = $_GET['listid'];

  $sql = mysqli_query($koneksi, "DELETE FROM list WHERE id = '$id'") or die(mysqli_error($koneksi));

  if ($sql) {
    header("Location: list.php");
    exit();
  } else {
    echo "<script> alert('Gagal menghapus list') </script>";
  }
}
?>

<body>
  <div class="container">
    <?php include('navbar.php') ?>

    <div class="card mt-3">
      <div class="card-header">
        <h3 style="float:left">My List</h3>

        <!-- Button trigger modal add new list -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal" style="float:right">
          + Tambah List
        </button>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Time</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $sql = mysqli_query($koneksi, "SELECT * FROM list") or die(mysqli_error($koneksi));
            while ($data = mysqli_fetch_assoc($sql)) {
              echo '
              <tr>
                <td>' . $no++ . '</td>
                <td>' . $data['title'] . '</td>
                <td>' . $data['description'] . '</td>
                <td>' . $data['time'] . '</td>
                <td>
                  <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModal' . $data['id'] . '" style="float:right">
                    + Edit List
                  </button>
                  <a href="?listid=' . $data['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                </td>
              </tr>
              ';
            ?>

            <div class="modal fade" id="exampleModal<?= $data['id'] ?>" tabindex="-1"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="POST">
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <input type="text" name="title" class="form-control" value="<?= $data['title'] ?>" required>
                      </div>

                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" value="<?= $data['description'] ?>"
                          required>
                      </div>

                      <div class="form-group">
                        <label>Time</label>
                        <input type="hidden" name="time_before" value="<?= $data['time'] ?>">
                        <input type="datetime-local" name="time" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="btn-update-list" class="btn btn-primary">Update List</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

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
            <h5 class="modal-title" id="exampleModalLabel">New List</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST">
            <div class="modal-body">
              <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Time</label>
                <input type="datetime-local" name="time" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="btn-add-new-list" class="btn btn-primary">Add New List</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>