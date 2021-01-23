<?php
    include('dbconnect.php');
    $query = 'SELECT * FROM threads';
    $result = mysqli_query($dbc,$query) or die ("error in fetching posts");
    
?>
<html lang="en">

<head>
    <title>CorruptionFreeIndia</title>
    <link rel="icon" href="./static/Tab_Logo.png" />
    <link href="./css/admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="filter"></div>
    <table>
        <tr>
            <th>Post Id</th>
            <th>Posts</th>
            <th>Discard</th>
        </tr>
        <?php
            
            if(isset($_GET['postid']))
            {
                $postid = $_GET['postid'];
                $delete_query = "DELETE FROM threads WHERE thread_id=$postid";
                mysqli_query($dbc,$delete_query) or die("error in deleting post");
                echo 'post removed sucessfully';
                $admin_url = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/admin.php';
                header('refresh: 0; url='.$admin_url);
            }
            else
            {
                echo "error in deleting post";
                $admin_url = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/admin.php';
                header('refresh: 0; url='.$admin_url);
            }
            
            while($row = mysqli_fetch_array($result))
            {
                $url = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/admin.php?postid='.$row['thread_id'];
                echo'<tr>
                    <td>'.$row['thread_id'].'</td>
                    <td>'.$row['thread_title'].'</td>
                    <td><button class="disapprove" onclick="location.href = \''.$url.'\';">Discard</button></td>
               </tr>';
            }
        
        
        ?>
        
        
        <!-- <tr>
            <td>01</td>
            <td>Alpha Beeta Gamma</td>
            <td><button class="approve">Approve</button></td>
            <td><button class="disapprove">Discard</button></td>
        </tr>
        <tr>
            <td>02</td>
            <td>Alpha Beeta Gamma</td>
            <td><button class="approve">Approve</button></td>
            <td><button class="disapprove">Discard</button></td>
        </tr>
        <tr>
            <td>03</td>
            <td>Alpha Beeta Gamma</td>
            <td><button class="approve">Approve</button></td>
            <td><button class="disapprove">Discard</button></td>
        </tr>
        <tr>
            <td>04</td>
            <td>Alpha Beeta Gamma</td>
            <td><button class="approve">Approve</button></td>
            <td><button class="disapprove">Discard</button></td>
        </tr>
        <tr>
            <td>05</td>
            <td>Alpha Beeta Gamma</td>
            <td><button class="approve">Approve</button></td>
            <td><button class="disapprove">Discard</button></td>
        </tr>
        <tr>
            <td>06</td>
            <td>Alpha Beeta Gamma</td>
            <td><button class="approve">Approve</button></td>
            <td><button class="disapprove">Discard</button></td>
        </tr> -->
    </table>
</body>

</html>