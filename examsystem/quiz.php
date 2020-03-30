<?php
require('database.php');
session_start();
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
        
        <h1>Answer Every Question Carefully</h1>
        <form action="./quiz.php" method="post">
        <?php

            $queryGetAllQuestions = 'SELECT * FROM questions WHERE quizid = :quizid';
            $statement = $db->prepare($queryGetAllQuestions);
            $currentQuiz = $_SESSION['currentQuiz'];
            $statement->bindValue(':quizid', $currentQuiz);
            $statement->execute();
            $questions = $statement->fetchAll();
            $startquestionindex = $_SESSION['startquestionindex'];
            $statement->closeCursor();

            //get 10 random questions
            shuffle($questions);
            
            foreach ($questions as $eachquestion) {
               $questionid[] = $eachquestion['questionid'];
               $question[] = $eachquestion['question'];
               $option1[] = $eachquestion['option1'];
               $option2[] = $eachquestion['option2'];
               $option3[] = $eachquestion['option3'];
               $option4[] = $eachquestion['option4'];
               $answer[] = $eachquestion['answer'];
            }
                ?>
                <form action="./quiz.php" method="post">
                

                <div id="<?php echo $questionid[$startquestionindex]?>" class="question">
                <!-- $startquestionindex -->
            
                <?php echo htmlspecialchars($question[$startquestionindex])?> <br>
                    <ol>
                        
                        <li>
                        <label for="option1">
                            <?php echo htmlspecialchars($option1[$startquestionindex])?>
                        </label>
                        <input type="radio" name="question" id="option1" value="option1">
                        </li>
                        <li>
                        <label for="option2">
                            <?php echo htmlspecialchars($option2[$startquestionindex])?>
                        </label>
                        <input type="radio" name="question" id="option2" value="option2">
                        </li>
                        <li>
                        <label for="option3">
                            <?php echo htmlspecialchars($option3[$startquestionindex])?>
                        </label>
                        <input type="radio" name="question" id="option3" value="option3">
                        </li>
                        <li>
                        <label for="option4">
                            <?php echo htmlspecialchars($option4[$startquestionindex])?>
                        </label>
                        <input type="radio" name="question" id="option4" value="option4">
                        </li>
                    </ol>

                </div>
                <br>
                <br>
                <button class="stylebutton" name="questionid" value="<?php echo $currentQuiz?>">
                Next Question
                </form>

                
                <?php
            if(isset($_POST['questionid'])) {
                if (!isset($_POST['question'])) {
                    $_POST['question'] = "option5";
                }
                //calculate marks
                $answerbyuser = $_POST['question'];
                $actualanswer = $answer[$startquestionindex];
                if ($answerbyuser==$actualanswer) {
                   $_SESSION['marks'] = $_SESSION['marks'] + 1;
                }

            
                if ($startquestionindex>=9) {
                    header('location:certificate.php');
                }
                else {
                    $_SESSION['startquestionindex'] = $_SESSION['startquestionindex'] + 1;
                }
                
            }
        ?>
        </form>
    </main>
</body>
</html>
<?php
}
?>