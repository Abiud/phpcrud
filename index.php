<?php include('server.php'); 

    //fetch the record to be updated
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit_state = true;
        $rec = mysqli_query($db, "SELECT * FROM user WHERE id='$id'");
        $record = mysqli_fetch_array($rec);
        $name = $record['name'];
        $age = $record['age'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>php, mysql CRUD</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

    <div class="container table-margin">

        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                <?php 
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['age'] ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <a href="server.php?del=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="card w-50 mx-auto card-margin">
            <div class="card-body">
                <form method="post" action="server.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" value="<?php echo $name; ?>">
                    </div>
                    <div class="form-group">
                        <label>Age</label>
                        <input class="form-control" type="number" name="age" value="<?php echo $age; ?>">
                    </div>
                    <div class="input-group btn-submit">
                        <?php if ($edit_state == false): ?>
                            <button class="btn btn-success" name="save" type="submit">Save</button>
                        <?php else: ?>
                            <button class="btn btn-success" name="update" type="submit">Update</button>
                        <?php endif ?>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>