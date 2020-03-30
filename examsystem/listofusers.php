<?php
require('database.php');
session_start();
if (!isset($_SESSION['adminemail'])) {
    header('location:index.php');
}
else {
    // get the data from the db
    $querygetallusers = 'SELECT * FROM registration';
    $statement = $db->prepare($querygetallusers);
    //$statement->bindValue(':uid', $uid);
    $statement->execute();
    $allusers = $statement->fetchAll();

    $statement->closeCursor();
   
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
        <button class = "stylebutton"> 
            <a href="./attemptbyall.php">See Attempts by Users</a>
        </button>
        <button class = "stylebutton"> 
            <a href="./listofusers.php">List All Users</a>
        </button>
        <form action="./index.php" method="post">
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


        <h1> <?php
        echo $_SESSION['First_name'];
        ?>, These are all users currently on the database :</h1>
        <form action="./listofusers.php" method="post">
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th class="right">Delete</th>
            </tr>

            <?php foreach ($allusers as $user) : 

                // $querygetquiznamefromattempt = 'SELECT * FROM quizs WHERE uid = :quizidofattempt';
                // $statement = $db->prepare($querygetquiznamefromattempt);
                // $statement->bindValue(':quizidofattempt', $quizidofattempt);
                // $statement->execute();
                // $quiznamefromattempt = $statement->fetch();

                // $statement->closeCursor();
                

                ?>
            <tr>
                <td><?php echo $user['First_name']; ?></td>
                <td><?php echo $user['Last_name']; ?></td>
                <td><?php echo $user['Mobile']; ?></td>
                <td><?php echo $user['Email']; ?></td>
                <td><?php echo $user['Address']; ?></td>
                <td class="right">
                    <button name="deleteuser" value="<?php echo $user['Email'];?>" class="stylebutton deletebutton">
                    Delete
                    </button>
                </td>
            </tr>
            <?php endforeach; 
            ?>
        </table>
        </form>
        <?php
        if (isset($_POST['deleteuser'])) {
                $Email = $_POST['deleteuser'];
                $querydeleteuserbyemail = 'DELETE FROM registration WHERE Email = :Email';
                $statement = $db->prepare($querydeleteuserbyemail);
                $statement->bindValue(':Email',$Email);
                $statement->execute();
                $seeattempt = $statement->fetchAll();
                header('Location: '.$_SERVER['PHP_SELF']);
        }
        ?>

    </main>
</body>
</html>
<?php
}
?>