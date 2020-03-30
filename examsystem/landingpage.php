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

        <form action="" method="post">
        <button type="submit" class = "stylebutton" name="logout"> 
            Logout
        </button>

        </form>
        <?php
            if (isset($_POST['logout'])) {
                unset($_SESSION['email']);
                $_SESSION = array();
                session_destroy();
                header('location:index.php');
            }
            ?>
        <h1> <?php
        echo $_SESSION['First_name'];
        ?>, Welcome to the Quiz Competetion</h1>
        
        <h1>You Got These Categories to choose from:</h1>
        <form action="./eachCategory.php" method="post">
        <?php

            $queryGetAllCategories = 'SELECT * FROM categories';
            $statement = $db->prepare($queryGetAllCategories);

            $statement->execute();
            $categories = $statement->fetchAll();
            $statement->closeCursor();
            
            foreach ($categories as $category) {
                $categoryname = $category['categoryname'];
                $categoryid = $category['categoryid'];
                ?>

                <button class="no-style" name="category" value="<?php echo $categoryid?>">

                <div id="<?php echo $categoryid?>" class="category">
                <?php echo $categoryname?>
                
                </div>

                </button>
                
                <?php
            }
            if(isset($_POST['category'])) {
            echo $_POST['category'];
            $_SESSION['categoryid'] = $_POST['category'];

            }
        ?>
        </form>
    </main>
</body>
</html>
<?php
}
?>