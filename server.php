<?php
    session_start();

    $user = 'root';
    $pass = '';
    $db = 'testdb';

    $name = "";
    $age = "";
    $id = 0;
    $edit_state = false;

    //connect to database
    $db = new mysqli('192.168.64.2', $user, $pass, $db);

    //Exit if connection to database fails
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // if save button is clicked
    if (isset($_POST['save'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];

        $query = "INSERT INTO user (name, age) VALUES ('$name', '$age')";
        mysqli_query($db, $query);
        $_SESSION['msg'] = "User saved"; //display notification
        header('location: index.php'); //redirect to index page after insertion
    }

    //update records
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $id = $_POST['id'];

        mysqli_query($db, "UPDATE user SET name='$name', age='$age' WHERE id='$id'");
        $_SESSION['msg'] = 'User updated';
        header('location: index.php');
    }

    //delete record
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM user WHERE id='$id'");
        $_SESSION['msg'] = 'User deleted';
        header('location: index.php');
    }

    //retrieve records
    $results = mysqli_query($db, "SELECT * FROM user");


?>