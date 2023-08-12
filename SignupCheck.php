<?php
// Annisya Riyan Wulandini
// 2440086041

session_start();

require_once('./url.php');

if($_SERVER['REQUEST_METHOD']==='POST')
{
    $error_msg=false;
    if(isset($_POST['Username'])&&isset($_POST['Password']))
    {
        echo "Welcome";

        if(!empty($_POST['Username'])&&!empty($_POST['Password']))
        {
            $username=$_POST['Username'];
            $password=md5($_POST['Password']);
            $av_char="/[^a-z0-9A-Z@._]/";
            if(preg_match($av_char, $username)===1)
            {

                $_SESSION['error']="Use the correct input!";
                $error_msg=true;

            }
            else if(preg_match($av_char, $_POST['Password'])===1)
            {

                $_SESSION['error']="Use the correct input!";
                $error_msg=true;

            }
            if($error_msg)
            {

                header("Location: ./login.php");
                die;

            }
            if(empty($username))
            {
                $_SESSION['error']="Username Cannot Be Empty!";
                $error_msg=true;
            }
            else if(strlen($username) < 5)
            {
                $_SESSION['error']="Use a longer Username!";
                $error_msg=true;
            }
            else if(strlen($username) > 30)
            {
                $_SESSION['error']="Use a shorter Username!";
                $error_msg=true;
            }
            if(empty($_POST['Password']))
            {
                $_SESSION['error']="Password Cannot Be Empty!";
                $error_msg=true;
            }
            else if(strlen($_POST['Password']) < 4)
            {
                $_SESSION['error']="Use a longer Password!";
                $error_msg=true;
            }
            else if(strlen($_POST['Password']) > 30)
            {
                $_SESSION['error']="Use a shorter Password!";
                $error_msg=true;
            }
            if($error_msg)
            {
                header("Location: ./login.php");
                die;
            }

            $sql="SELECT UserName FROM user WHERE UserName=?";
            $query=$mysqli->prepare($sql);
            $hasil=$query->bind_param("s",$username);
            $query->execute();


            $query->store_result();
            if($query->num_rows==0)
            {
                $sql="INSERT INTO user(UserName,UserPass) VALUES (?,?)";
                $query=$mysqli->prepare($sql);
                $hasil=$query->bind_param("ss",$username,$password);
                $query->execute();

                if($query->affected_rows<0)
                {
                    $message="Sign Up Failed";
                    header("location: ./Signup.php?message=$message");
                }
                else{
                    $message="Sign Up Success";
                    header("location: ./login.php?message=$message");
                }
            }
            else
            {
                    $query->fetch();
                    $error_msg=true;
                    $_SESSION['error']="Sign Up Failed!<br>Username Already Used!";
                    header("location: ./Signup.php");
                    die;
            }
        }
        else if(empty($_POST['Username'])||empty($_POST['Password']))
        {
            $_SESSION['error']="The username or Password has not been filled!";
            header("Location: ./Signup.php");
            die;
        }
    }
    else if(!isset($_POST['Username']) && isset($_POST['Password']))
    {
        $_SESSION['error']="The Username or Password has not been filled!";
        header("Location: ./Signup.php");
        die;
    }
}
?>