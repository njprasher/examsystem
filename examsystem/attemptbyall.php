<?php
require('database.php');
session_start();
if (!isset($_SESSION['adminemail'])) {
    header('location:index.php');
}
else {
    // get the data from the db
    $querygetallattempts = 'SELECT * FROM attempts';
    $statement = $db->prepare($querygetallattempts);
    //$statement->bindValue(':uid', $uid);
    $statement->execute();
    $allattempts = $statement->fetchAll();

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
        ?>, These are all users attempts :</h1>
        <form action="./attemptbyall.php" method="post">
        <table>
            <tr>
                <th>User ID</th>
                <th>Quiz Name</th>
                <th>Quiz Category</th>
                <th>Date</th>
                <th>Score</th>
                <th class="right">Delete</th>
            </tr>

            <?php foreach ($allattempts as $attempt) : 
                $quizidofattempt = $attempt['quizid'];

                $querygetquiznamefromattempt = 'SELECT * FROM quizs WHERE quizid = :quizidofattempt';
                $statement = $db->prepare($querygetquiznamefromattempt);
                $statement->bindValue(':quizidofattempt', $quizidofattempt);
                $statement->execute();
                $quiznamefromattempt = $statement->fetch();

                $statement->closeCursor();

                $categoryidfromattempt = $quiznamefromattempt['categoryid'];

                $querygetcategoryidfromattempt = 'SELECT * FROM categories WHERE categoryid = :categoryidfromattempt';
                $statement = $db->prepare($querygetcategoryidfromattempt);
                $statement->bindValue(':categoryidfromattempt', $categoryidfromattempt);
                $statement->execute();
                $categorynamefromattempt = $statement->fetch();


                ?>
            <tr>
                <td><?php echo $attempt['uid']; ?></td>
                <td><?php echo $quiznamefromattempt['quizname']; ?></td>
                <td><?php echo $categorynamefromattempt['categoryname']; ?></td>
                <td><?php echo $attempt['date']; ?></td>
                <td><?php echo $attempt['score']; ?></td>
                <td class="right">
                    <button name="delete" value="<?php echo $attempt['attemptid'];?>" class="stylebutton deletebutton">
                    Delete
                    </button>
                <!-- <input type="button" name="delete" value="<?php echo $attempt['attemptid'];?>"> -->
                </td>
            </tr>
            <?php endforeach; 
            ?>
        </table>
        </form>
        <?php
        if (isset($_POST['delete'])) {
                $attemptid = $_POST['delete'];
                $querydeletebyattemptid = 'DELETE FROM attempts WHERE attemptid = :attemptid';
                $statement = $db->prepare($querydeletebyattemptid);
                $statement->bindValue(':attemptid',$attemptid);
                $statement->execute();
                $seeattempt = $statement->fetchAll();
                header('Location: '.$_SERVER['PHP_SELF']);
                // header('./attemptbyall.php');
        }
        ?>

    </main>
</body>
</html>
<?php
}
?>