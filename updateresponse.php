<?php
    require_once('dbconnect.php');
    $commentid = $_GET['commid'];
    $response = $_GET['response'];
    $source = $_GET['location'];
    if($response==1)
    {
        $query = "UPDATE comments SET comment_likes=comment_likes+1 WHERE comment_id='$commentid'";
        mysqli_query($dbc,$query) or die ("user response not updated");
    }
    else
    {
        $query = "UPDATE comments SET comment_dislikes=comment_dislikes+1 WHERE comment_id='$commentid'";
        mysqli_query($dbc,$query) or die ("user response not updated");
    }
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $source;
    header('refresh: 0; url='.$redirect);

?>