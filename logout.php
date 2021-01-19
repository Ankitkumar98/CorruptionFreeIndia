<?php
    session_start();
    if($_SESSION['username'] && $_SESSION['usermail'])
    {
        $_SESSION=array();
        if($_COOKIE[session_name()])
        {
            setcookie(session_name(),"",time()-3600000);    
        }
        session_destroy();
    }
    
    setcookie('usermail' ,"" ,time()-36000000);
    setcookie('username' ,"" ,time()-36000000);
    echo "logout sucessfull";
    echo '<script>
        localStorage.setItem(\'logout-event\', \'logout\' + Math.random());
    </script>';
    $home_url='http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']).'/discussion.php';
    print_r($home_url);
    header('refresh: 5; url='.$home_url);

?>