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
  <title>Profile</title>
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

        </form>
        <h1> <?php
        echo $_SESSION['First_name'];
        ?>, Welcome to your profile</h1>
        </form>
        <?php
        $email = $_SESSION['email'];

        $querygetthisuser = 'SELECT * FROM registration WHERE email = :email';
        $statement = $db->prepare($querygetthisuser);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $thisuser = $statement->fetch();
        ?>
        <h3>Current profile</h3>
            <p><span>First Name :</span>
                <span>
                    <b>
                    <?php echo $thisuser['First_name']; ?>
                    </b>
                </span>
            </p>
            <p><span>Last Name :</span>
                <span>
                    <b>
                    <?php echo $thisuser['Last_name']; ?>
                    </b>
                </span>
            </p>
            <p><span>Mobile :</span>
                <span>
                    <b>
                    <?php echo $thisuser['Mobile']; ?>
                    </b>
                </span>
            </p>
            <p><span>Email :</span>
                <span>
                    <b>
                    <?php echo $thisuser['Email']; ?>
                    </b>
                </span>
            </p>
            <p><span>Address :</span>
                <span>
                    <b>
                    <?php echo $thisuser['Address']; ?>
                    </b>
                </span>
            </p>
            <h3>Update profile</h3>
            <form action="./userprofile.php" method="post">
            <p><span>First Name :</span>
                <input type="text" name="updatefirstname" placeholder="<?php echo $thisuser['First_name']; ?>">
            </p>
            <p><span>Last Name :</span>
                <input type="text" name="updatelastname" placeholder="<?php echo $thisuser['Last_name']; ?>">
            </p>
            <p><span>Mobile :</span>
                <input type="text" name="updatemobile" placeholder="<?php echo $thisuser['Mobile']; ?>">
            </p>
            <p><span>Email :</span>
                <input type="text" name="updateemail" placeholder="<?php echo $thisuser['Email']; ?>">
            </p>
            <p><span>Address :</span>
                <input type="text" name="updateaddress" placeholder="<?php echo $thisuser['Address']; ?>">
            </p>
            <p><span>Old Password :</span>
                <input type="password" name="oldpassword" placeholder="Enter Old Password">
            </p>
            <p><span>New Password :</span>
                <input type="password" name="newpassword" placeholder="Enter New Password">
            </p>
                <input type="submit" name="changeprofile" value="Change Profile">
            </form>
                <?php
                if (isset($_POST['changeprofile'])) {
                    $oldpassword = $thisuser['Password'];
                    $email = $thisuser['Email'];
                    $updatefirstname = $_POST['updatefirstname'];
                    $updatelastname = $_POST['updatelastname'];
                    $updatemobile = $_POST['updatemobile'];
                    $updateemail = $_POST['updateemail'];
                    $updateaddress = $_POST['updateaddress'];
                    $newpassword = $_POST['newpassword'];
                    $queryupdateprofile = 'UPDATE registration SET First_name = :updatefirstname, Last_name = :updatelastname, Mobile = :updatemobile, Email = :updateemail, Address = :updateaddress, Password = :newpassword WHERE Email = :email AND Password = :oldpassword';
                    //update from attempts
                    $queryupdateattempt = 'UPDATE attempts SET uid = :updateemail WHERE uid = :email';
                    $statementattempt = $db->prepare($queryupdateattempt);
                    $statementattempt->bindValue(':email', $email);
                    $statementattempt->execute();

                    $statement = $db->prepare($queryupdateprofile);
                    $statement->bindValue(':updatefirstname', $updatefirstname);
                    $statement->bindValue(':updatelastname', $updatelastname);
                    $statement->bindValue(':updatemobile', $updatemobile);
                    $statement->bindValue(':updateemail', $updateemail);
                    $statement->bindValue(':updateaddress', $updateaddress);
                    $statement->bindValue(':newpassword', $newpassword);
                    $statement->bindValue(':email', $email);
                    $statement->bindValue(':oldpassword', $oldpassword);
                    $statement->execute();
                    $_SESSION['email'] = $updateemail;
                    $_SESSION['First_name'] = $updatefirstname;
                    $_SESSION['Last_name'] = $updatelastname;
                    $_SESSION['Mobile'] = $updatemobile;
                    $_SESSION['Address'] = $updateaddress;
                    header('Location: '.$_SERVER['PHP_SELF']);
                    //$categorynamefromcertificate = $statement->fetch();
                }
                ?>
    </main>
</body>
</html>
<?php
}
?>