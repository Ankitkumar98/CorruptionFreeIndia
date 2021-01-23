<?php
require('dbconnect.php');
session_start();
echo 'login page';
$source = $_GET['location'];
echo $source;
if(!isset($_SESSION['user_mail']))
{
    if(isset($_POST['login_submit']))
    {
        $email=mysqli_real_escape_string($dbc, trim($_POST['login_email']));
        $pass=mysqli_real_escape_string($dbc, trim($_POST['login_pw']));

        if(!empty($email) && !empty($pass))
        {
            $login_query="SELECT * FROM user WHERE `user_email`='$email'";
            $login_result=mysqli_query($dbc,$login_query) or die("login query not executed");
            $row = mysqli_fetch_array($login_result);
            $hash = $row['user_password'];
            if(mysqli_num_rows($login_result)==1)
            {
                if(password_verify($pass,$hash))
                {
                    echo 'login sucessfull';
                    $_SESSION['usermail']=$email;
                    $_SESSION['username'] = $row['user_name'];
                    setcookie('username',$row['user_name'],time()+(60*60*24*7));
                    setcookie('usermail', $row['user_email'], time()+(60*60*24*7));
                    echo '<script>
                        localStorage.setItem(\'login-event\', \'login\' + Math.random());                  
                    </script>';
                    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . $source;
                    //header('refresh: 5; url=http://localhost/corruption/discussion.php');
                    header('refresh: 0; url='.$home_url);
                }
                else{
                    echo 'invalid password please login again';
                }    
            }
            else
            {
                echo 'login unsuccessfull please enter details properly';
                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/signin.php';
                header('refresh: 0; url='.$home_url);
            }
        }
        else{
            echo 'please enter all the details';

        }    
    }

}
else
{
    echo 'you are alreday logged in';
    exit();
}


?>