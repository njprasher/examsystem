<?php
require('database.php');
session_start();

$_SESSION['startquestionindex'] = 0;
$_SESSION['marks'] = 0;
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
else {
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="main.css">
  <title>Quiz Selection</title>
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
        <form action="" method="post">
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

        </form>
        <h1> <?php
        echo $_SESSION['First_name'];
        ?>, Welcome to the Quiz Competetion</h1>
        
        
        <form action="" method="post">
        <?php

            $queryGetAllQuiz = 'SELECT * FROM quizs WHERE categoryid = :categoryid';
            $queryGetCategoryName = 'SELECT * FROM categories WHERE categoryid = :categoryid';

            $statement = $db->prepare($queryGetAllQuiz);
            $statementname = $db->prepare($queryGetCategoryName);

            $currentCategory = $_POST['category'];
            $statement->bindValue(':categoryid', $currentCategory);
            $statementname->bindValue(':categoryid', $currentCategory);
            
            $statement->execute();
            $statementname->execute();

            $quizs = $statement->fetchAll();
            $category = $statementname->fetch();

            $_SESSION['categoryname'] = $category['categoryname'];

            $statement->closeCursor();
            $statementname->closeCursor();
            ?>
            <h1>Please choose a quiz from 
                <?php 
                echo $category['categoryname'];
             ?>
             </h1>
            <?php
            foreach ($quizs as $quiz) {
                $quizname = $quiz['quizname'];
                $quizid = $quiz['quizid'];
                $categoryid = $quiz['categoryid'];

                ?>
                
                <button class="no-style" name="quizid" value="<?php echo $quizid?>">

                <div id="<?php echo $quizid?>" class="category">
                <?php echo $quizname?>
                
                </div>

                </button>
                
                <?php

            }
        ?>
        </form>
        <?php
        if(isset($_POST['quizid'])) {
            $_SESSION['currentQuiz'] = $_POST['quizid'];
            // $_SESSION['currentQuizname'] = $_POST['quizid'];
            header('location:./quiz.php');
            }
        ?>
    </main>
</body>
</html>
<?php
}
?>