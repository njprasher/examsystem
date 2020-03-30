<?php
require('database.php');
session_start();
//if user exists there then log in
if (isset($_SESSION['email'])) {
    header('location:landingpage.php');
} else {
    if (isset($_SESSION['adminemail'])) {
        header('location:admindashboard.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="main.css">
  <title>Login</title>
</head>
<body>
<main>
        <!-- display a table of students -->
        <h1>Login to Quiz</h1>
        <form action="" method="post">

            <div id="data">
                <label>Please Enter Your Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" name="email"><br>

                <label>Please Enter Your Password</label>
                <input type="password" name="password"><br>

            </div>
            <br>

            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" name="Login" value="Login" class="stylebutton"><br>
            </div>
        </form>
        <br>
        <hr>
        
        <h1>Register for Quiz</h1>

        <form action="" method="post">

            <div id="data">
                <label>Please Enter Your Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" name="regemail"><br>

                <label>Please Enter Your First Name</label>
                <input type="text" name="firstName"><br>

                <label>Please Enter Your Last Name</label>
                <input type="text" name="lastName"><br>

                <label>Please Enter Your Mobile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="number" name="mobile"><br>

                <label>Please Enter Your Address&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" name="address"><br>

                <label>Please Enter Your Password&nbsp;</label>
                <input type="password" name="regpassword"><br>

                <!-- <label>Please Confirm Your Password</label>
                <input type="password" name="regpasswordconfirm"><br> -->

            </div>
            <br>

            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" name="Register" value="Register" class="stylebutton"><br>
            </div>
        </form>
        <?php
            if(isset($_POST['Login'])) {
                // check if user exists
                $email = $_POST['email'];
                $password = $_POST['password'];

                        //database stuff
                       
                        $queryGetAllUsers = 'SELECT * FROM registration';
                        $statement = $db->prepare($queryGetAllUsers);
                        
                        $statement->execute();
                        $users = $statement->fetchAll();
                        $statement->closeCursor();
                        
                        foreach ($users as $user) {
                          if ($user['Email']==$email&&$user['Password']==$password) {
                              echo "logged in";
                              $_SESSION['email'] = $email;

                              //getting all details of user
                            $querygetalldetails = 'SELECT * FROM registration WHERE email = :email';
                            $statement = $db->prepare($querygetalldetails);
                            $statement->bindValue(':email', $email);
                            $statement->execute();
                            $alldetailsofuser = $statement->fetch();
                            

                            $_SESSION['First_name'] = $alldetailsofuser['First_name'];
                            $_SESSION['Last_name'] = $alldetailsofuser['Last_name'];
                            $_SESSION['Mobile'] = $alldetailsofuser['Mobile'];
                            $_SESSION['Address'] = $alldetailsofuser['Address'];

                            print_r($_SESSION);
                            $statement->closeCursor();

                            header("location: ./landingpage.php");
                          }else{
                              echo "Some error occurred while logging in";
                            //header("location: ./index.php");
                          }
                        }
                    }
                if (isset($_POST['Register'])) {
                   // check if user exists
                $regemail = $_POST['regemail'];
                $regpassword = $_POST['regpassword'];

                        //database stuff
                       
                        // $queryGetAllUsers = 'SELECT * FROM registration';
                        // $statement = $db->prepare($queryGetAllUsers);
                        
                        // $statement->execute();
                        // $users = $statement->fetchAll();
                        // $statement->closeCursor();
                        
                        // foreach ($users as $user) {
                        //       //check if password matches;
                        //       $regpasswordconfirm = $_POST['regpasswordconfirm'];
                        //       if ($regpassword!=$regpasswordconfirm) {
                        //          echo "Password not matching";
                        //       }else {
                                  $firstName = $_POST['firstName'];
                                  $lastName = $_POST['lastName'];
                                  $mobile = $_POST['mobile'];
                                  $address = $_POST['address'];
                                  //save user details into db
                            $queryUsers = 'INSERT INTO registration (First_name, Last_name, Mobile, Email, Address, Password)
                            VALUES (:firstName, :lastName, :mobile, :regemail, :address, :regpassword);';
                            $statement = $db->prepare($queryUsers);
                            $statement->bindValue(':firstName', $firstName);
                            $statement->bindValue(':lastName', $lastName);
                            $statement->bindValue(':mobile', $mobile);
                            $statement->bindValue(':regemail', $regemail);
                            $statement->bindValue(':address', $address);
                            $statement->bindValue(':regpassword', $regpassword);
                            $statement->execute();
                            $statement->closeCursor();
                            echo 'Successfully Registered';
                            //header("location: ./index.php");
                              }
                             
                //           }
                        
                // }
        ?>

<br>
<hr>
        <h1>Admin login</h1>

        <form action="" method="post">

            <div id="data">
                <label>Please Enter Your Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" name="adminemail"><br>

                <label>Please Enter Your Password</label>
                <input type="password" name="adminpassword"><br>

            </div>
            <br>

            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" name="AdminLogin" value="Admin Login" class="stylebutton"><br>
            </div>
        </form>
        <?php
        if(isset($_POST['AdminLogin'])) {
            // check if user exists
            $adminemail = $_POST['adminemail'];
            $adminpassword = $_POST['adminpassword'];

                    //database stuff
                   
                    $queryGetAllAdmins = 'SELECT * FROM admin';
                    $statement = $db->prepare($queryGetAllAdmins);
                    
                    $statement->execute();
                    $admins = $statement->fetchAll();
                    $statement->closeCursor();
                    
                    foreach ($admins as $admin) {
                      if ($admin['email']==$adminemail&&$admin['password']==$adminpassword) {
                          echo "logged in";
                          $_SESSION['adminemail'] = $adminemail;

                          //getting all details of admin
                        $querygetalladmindetails = 'SELECT * FROM admin WHERE email = :email';
                        $statement = $db->prepare($querygetalladmindetails);
                        $statement->bindValue(':email', $adminemail);
                        $statement->execute();
                        $alldetailsofadmin = $statement->fetch();
                        

                        $_SESSION['First_name'] = $alldetailsofadmin['firstname'];
                        $_SESSION['Last_name'] = $alldetailsofadmin['lastname'];

                        print_r($_SESSION);
                        $statement->closeCursor();

                        header("location: ./admindashboard.php");
                      }else{
                          echo "Some error occurred while logging in";
                        //header("location: ./index.php");
                      }
                    }
                }
        
        ?>
        <p style="color:darkgray">Developed by Code Black</p>
    </main>
</body>
</html>