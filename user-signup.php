<?php
require_once('dbconnect.php');
$source = $_GET['location'];


if(isset($_POST['register_submit']))
{
    $username = mysqli_real_escape_string($dbc,trim($_POST['register_name']));
    $mail=mysqli_real_escape_string($dbc,trim($_POST['register_email']));
    $passw=mysqli_real_escape_string($dbc,trim($_POST['register_pw']));
    $confirmPassw = mysqli_real_escape_string($dbc,trim($_POST['confirmPassword']));

    
    
    if(!empty($mail) && !empty($passw) && !empty($confirmPassw) && ($passw == $confirmPassw))
    {
        $query = "SELECT * FROM user WHERE user_email='$mail'";
        $result = mysqli_query($dbc,$query) or die("error in fetching details from database");
        
        $row=mysqli_fetch_array($result);
       
        //echo mysqli_num_rows($result);
        if(mysqli_num_rows($result) == 0)  
        {
            $hash_passw = password_hash($passw,PASSWORD_DEFAULT);
           // var_dump($hash_passw); 
            $register_query="INSERT INTO user(`user_name`,`user_email`,`user_password`) VALUES('$username','$mail','$hash_passw')";
            $register_result=mysqli_query($dbc,$register_query) or die("error in registering user");
            echo 'registration sucessfull';
            mysqli_close($dbc);
            // header("refresh: 5; url=http://localhost/corruption/signin.php");
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . $source;
            header('refresh: 0; url='.$home_url);
        }
        else
        {
            echo 'email id is already registered';
            mysqli_close($dbc);
            // header("refresh: 5; url=http://localhost/corruption/signup.php");
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . $source;
            header('refresh: 0; url='.$home_url);

        }
        
    }
    else{
        echo 'please enter details properly';
        mysqli_close($dbc);
        //header("refresh: 5; url=http://localhost/corruption/signup.php");
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . $source;
        header('refresh: 0; url='.$home_url);
        
    }
    
    
    
}
?>