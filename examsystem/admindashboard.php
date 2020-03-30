<?php
require('database.php');
session_start();
if (!isset($_SESSION['adminemail'])) {
    header('location:index.php');
}

//todo get the available tables for admin

//show the options which can be done on tables
//can see all the rows of a table
//can update by button in row
//can add a new record in table
//can delete by button in row

else {
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="main.css">
  <title>Categories</title>
</head>
<body>
<main>
        <!-- display a table of students -->
        <button class = "stylebutton"> 
            <a href="./admindashboard.php"><span>&#x1F3E0;</span> Home</a>
        </button>
        
        <form action="" method="post">
        <button type="submit" class = "stylebutton" name="logout"> 
            Logout
            <?php
            if (isset($_POST['logout'])) {
                unset($_SESSION['adminemail']);
                $_SESSION = array();
                session_destroy();
                header('location:index.php');
            }
            ?>
        </button>

        </form>
        <h1> Hi <?php
        echo $_SESSION['First_name'];
        ?>, Welcome to the Admin Dashboard</h1>

        <button class = "stylebutton"> 
            <a href="./attemptbyall.php">See Attempts by All Users</a>
        </button>
        <br><br>
        <button class = "stylebutton"> 
            <a href="./listofusers.php">List All Users</a>
        </button>
    </main>
</body>
</html>
<?php
}
?>