<?php
require('database.php');
session_start();

    //getting quiz name
    $querygetquizname = 'SELECT * FROM quizs WHERE quizid = :quizid';
    $statement = $db->prepare($querygetquizname);
    $statement->bindValue(':quizid', $_SESSION['currentQuiz']);
    $statement->execute();
    $thisquizname = $statement->fetch();

    $statement->closeCursor();

    $categoryidfromcertificate = $thisquizname['categoryid'];
    $querygetcategoryidfromcertificate = 'SELECT * FROM categories WHERE categoryid = :categoryidfromcertificate';
    $statement = $db->prepare($querygetcategoryidfromcertificate);
    $statement->bindValue(':categoryidfromcertificate', $categoryidfromcertificate);
    $statement->execute();
    $categorynamefromcertificate = $statement->fetch();


// creating a certificate
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
else {
    //save attemt to database
    // print_r($_SESSION);

    $uid = $_SESSION['email'];
    $quizid =$_SESSION['currentQuiz'];
    $score = $_SESSION['marks'];
    // echo $uid;
    // echo $quizid;
    // echo $score;
    $querysaveattempt = 'INSERT INTO attempts (uid, quizid, score) VALUES(:uid, :quizid, :score);';
  
    $statement = $db->prepare($querysaveattempt);
    $statement->bindValue(':uid', $uid);
    $statement->bindValue(':quizid', $quizid);
    $statement->bindValue(':score', $score);
    
    $statement->execute();
    
    $statement->closeCursor();
    
    if ($score<=7) {
        ?>
        <link rel="stylesheet" href="main.css">
        <center>
        <br><br><br><br><br><br><br><br><br><br>
        <span style="font-size:72px"><i>Unfortunately you did not pass the test. Please try again later!</i></span><br><br><br><br><br><br><br><br><br>
        <button class = "stylebutton"> 
            <a href="./landingpage.php"><span>&#x1F3E0;</span> Home</a>
        </button>
        </center>
        
        <?php
    } else {

    ?>


<html>
<center>
<div style="width:800px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
<div style="width:750px; height:550px; padding:20px; text-align:center; border: 5px solid #787878">
       <span style="font-size:50px; font-weight:bold">Certificate of Completion</span>
       <br><br>
       <span style="font-size:25px"><i>This is to certify that</i></span>
       <br><br>
       <span style="font-size:30px"><b>
           <?php 
           echo $_SESSION['First_name'];
           ?> 
           <?php 
           echo $_SESSION['Last_name'];
           ?>
        </b></span><br/><br/>
       <span style="font-size:25px"><i>has completed the quiz in</i></span> <br/><br/>
       <span style="font-size:30px">
       <?php 

           echo $thisquizname['quizname'];
           ?> 
    </span> 
    <br/><br/>
       <span style="font-size:20px">which is topic from <b>
       <?php echo $categorynamefromcertificate['categoryname'];
            ?>
        </b></span>
        <br/>
       <span style="font-size:20px">with score of <b>
       <?php 
            echo $score;
            ?>/10
        </b></span> <br/><br/><br/><br/>
</div>
</div>
</center>
</html>

    <?php
      }
}
?>