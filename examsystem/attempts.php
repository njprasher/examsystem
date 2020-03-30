<?php
require('database.php');
session_start();
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
else {
    // get the data from the db
    $uid = $_SESSION['email'];

    $querygetattempts = 'SELECT * FROM attempts WHERE uid = :uid';
    $statement = $db->prepare($querygetattempts);
    $statement->bindValue(':uid', $uid);
    $statement->execute();
    $attempts = $statement->fetchAll();

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
            <a href="./landingpage.php"><span>&#x1F3E0;</span> Home</a>
        </button>
        <button class = "stylebutton"> 
            <a href="./userprofile.php">Profile</a>
        </button>
        <button class = "stylebutton"> 
            <a href="./attempts.php">See Your Previous Attempts</a>
        </button>
        <form action="./index.php" method="post">
        <button type="submit" class = "stylebutton" name="logout"> 
            Logout
            <?php
            if (isset($_POST['logout'])) {
                unset($_SESSION['email']);
                $_SESSION = array();
                session_destroy();
                header('location:index.php');
            }
            ?>
        </button>

        <h1> <?php
        echo $_SESSION['First_name'];
        ?>, These are your previous attempts :</h1>
        <table>
            <tr>
                <th>Quiz Name</th>
                <th>Quiz Category</th>
                <th>Date</th>
                <th class="right">Score</th>
            </tr>

            <?php foreach ($attempts as $attempt) : 
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
                <td><?php echo $quiznamefromattempt['quizname']; ?></td>
                <td><?php echo $categorynamefromattempt['categoryname']; ?></td>
                <td><?php echo $attempt['date']; ?></td>
                <td class="right"><?php echo $attempt['score']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

    </main>
</body>
</html>
<?php
}
?>