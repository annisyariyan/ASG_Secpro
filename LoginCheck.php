<?php
// Annisya Riyan Wulandini
//2440086041

session_start();

require_once('url.php');

if($_SERVER['REQUEST_METHOD']==='POST')
{
    $error_msg=false;
    if(!empty($_POST['Username']) && !empty($_POST['Password']))
    {
        //login
        $email=$_POST['Username'];
        $password=md5($_POST['Password']);
        $av_char="/[^a-z0-9A-Z@._]/"; 
        if(preg_match($av_char, $username)===1)
        {

            $_SESSION['error']="Use the correct input!";
            $error_msg=true;

        }
        else if(preg_match($av_char, $password)===1)
        {

            $_SESSION['error']="Use the correct input!";
            $error_msg=true;

        }
        if($error_msg)
        {

            header("Location: login.php");
            die;

        }
        if(strlen($username) < 5)
        {

            $_SESSION['error']="!";
            $error_msg=true;

        }
        else if(strlen($emusernameail) > 30)
        {

            $_SESSION['error']="Use a shorter Username!";
            $error_msg=true;
        }

        if(strlen($_POST['password']) < 5)
        {

            $_SESSION['error']="Use a longer Password!";
            $error_msg=true;

        }
        else if(strlen($_POST['password']) > 50)
        {

            $_SESSION['error']="Use a shorter Password!";
            $error_msg=true;

        }
        if($error_msg)
        {

            header("Location: ./login.php");
            die;

        }
        
            $sql="SELECT UserID,UserName FROM User WHERE UserPass= ?";
            $query=$mysqli->prepare($sql);
            $hasil=$query->bind_param("ss",$username,$password);
            $query->execute();
            $query->bind_result($user_id,$username_data);
            $query->store_result();
                if($query->num_rows>0)
        {    
                    //valid Username and Password
                    $query->fetch();
                    $_SESSION['is_login']=true;
                    $_SESSION['User_id']=$user_id;
                    $_SESSION['Username']=$username_data;
        }
        else
        
        {
                    //invalid Username and Password
                    $message="Login failed, please check your Username and Password again";
                    header("Location: ./login.php?message=$message");
                    $mysqli->close();
                    session_destroy();
                    unset($_SESSION);
                    die;
        }
    }
    else
    {
            $_SESSION['error']="The Username or Password has not been filled!";
            header("Location: ./login.php");
            die;
    }
}
?>