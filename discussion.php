<?php
    session_start();
    require_once('dbconnect.php');
    if(isset($_SESSION['usermail']))
    {
        $email = $_SESSION['usermail'];
        $user_query = "SELECT * FROM user WHERE user_email ='$email'";
        $user_query_result = mysqli_query($dbc,$user_query) or die("unable to fetch user details from database");
        $row_user = mysqli_fetch_array($user_query_result);
        $userid = $row_user['user_id'];
        if(isset($_GET['questionTitle']) && isset($_GET['questionDescription']))
        {
            $threadtitle = mysqli_real_escape_string($dbc,trim($_GET['questionTitle']));
            $threaddesc = mysqli_real_escape_string($dbc,trim($_GET['questionDescription']));
            $insert_query = "INSERT INTO threads(`thread_title`,`thread_desc`,`thread_user_id`,`thread_category`) VALUES('$threadtitle','$threaddesc','$userid',1)";
            mysqli_query($dbc,$insert_query) or die("error in posting query");
            echo 'post successfull';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/discussion.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./static/Tab_Logo.png">
    <title>Discussion-Forum</title>
</head>
<body>
        <script>
            window.addEventListener('storage',function(event){
                if(event.key == 'logout-event')
                {
                    window.location.reload();
                }
                if(event.key == 'login-event')
                {
                    window.location.reload();
                }
            });
        </script>
        <?php
            include('navbar.php');
        ?>    
        <main>
        <!-- jumbotron -->
        <div class="jumbotron"> 
            <div class="jumbotron_img"><img src="https://images.wallpaperscraft.com/image/books_library_old_111388_3840x2400.jpg" width="1865px" height="500px" alt=""></div>
            <div class="content">
                <h1 class="title">Feel free to Discuss here...</h1>
                <h4 class="title-description">
                    <ul>
                        <li>Introduce yourself.</li>
                        <li>Introduce yourself.</li>
                        <li>Be intellectually rigorous.</li>
                        <li>Forgive other's mistakes.</li>
                        <li>Read the whole thread before posting.</li>
                        <li>Maintain confidentiality.</li>
                        <li>Utilize a netiquette policy.</li>
                    </ul>
                </h4>
                <button class="btn"><a href="#askQuestionForm">Ask a Question</a></button>
            </div>
        </div>

        <div class="search-sort" style="background-color:rgb(173, 169, 169);">
            <?php
                $query = 'SELECT thread_id FROM threads';
                $queryResult = mysqli_query($dbc,$query);
                $countQuestions =mysqli_num_rows($queryResult);
            ?>
            <div class="numQuestions">
                <p><span class="barTitle">Total no. of Questions :</span> <?php echo $countQuestions ?></p>
            </div>
            
            <div class="search">
                <label for="search-ques"><span class="barTitle">Search : </span></label>
                <form action="./search.php" method="get">
                    <input type="text" name="search" length="500" style="padding:1%;font-size:18px;border:none;border-bottom:2px solid grey;outline:none;">
                    <button class="btnSearch" type="submit">Search</button>
                </form>
            </div>
    
            <div class="sort">
                <label for="sort-ques"><span class="barTitle">Sort : </span></label>
                <select name="sort-type" id="sort-type" style="font-size:18px;padding:1%;">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                </select>
            </div>
        </div>        

        <?php
            $query = 'SELECT * FROM threads';
            $queryResult = mysqli_query($dbc,$query) or die("error in fetching details from threads table");
            echo '<div class="questions">';
            while($row = mysqli_fetch_array($queryResult))
            {
                echo'<div class="userBox">
                        <div class="indivUser">
                            <div class="userLogo">
                                <img src="./image/user.svg" width="50" height="50" alt="user">
                            </div>
                            <div class="userDescription">';
                                echo  '<a href = "./threads.php?th_id='.$row['thread_id'].'">
                                    <label class="userThreadLabel" for="quesTitle">'.$row['thread_title'].'</label><br/> </a>
                                    <p style="display:inline-block;float:left;margin-right:30px;">'.$row['thread_desc'].'</p><p style="display:inline-block;float:left;"><b>Asked on '.$row['thread_date'].'</b> </p>
                            </div>
                        </div>
                    </div>
                    <hr style="width:85%;height:5%;margin-left:6%;margin-top:15px;">';     
            }

            echo '</div>';

        ?>
        
        <div class="askQuestionForm" id="askQuestionForm">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
                <label class="questionTitleLabel" for="questionTitle">Question Title</label>
                <input class="questionTitleBox" type="text" id="questionTitle" name="questionTitle" placeholder="Question Title ...">

                <label class="questionDescriptionLabel" for="questionDescription">Question Description</label>
                <textarea class="questionDescriptionBox" rows="10" cols="50" id="questionDescription" name="questionDescription" placeholder="Question Description ..."></textarea>        
                
                <input class="askQuestionFormSubmit" type="submit" value="Add Question" style="text-decoration:none;width:15%;font-size:22px;padding:1%;outline:none;border:none;border-radius:25px;padding-bottom:3%;">
            </form>
        </div>

        <div class="bottom_section">
        <footer class="footer">
            <div class="footer-left">
                <img src="./static/Footbar_Logo.png" alt="">
                <p><b>CorruptionFreeIndia</b> builds awareness and is an easily accessible tool that educates users about various anti-corruption laws and regulations. This forum should act as a content curator platform that displays anti-corruption initiatives
                    (globally and regionally), citizens’ rights on reporting incidences of petty/grand corruption, and ways to hold authorities accountable for such acts.</p>
            </div>
            <ul class="footer-right">
                <li>
                    <h2>Links</h2>
                    <hr width="50%">
                    <ul class="box">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="corruption_laws.html">Corruption Laws In India</a></li>
                        <li><a href="initiatives_globally.html">Anti-Corruption Initiatives</a></li>
                        <!-- <li><a href="initiatives_regionally.html">Anti-Corruption Initiatives (Regionally)</a></li> -->
                        <li><a href="complaint_against_corrupt.html">How to file a complaint against the corrupt</a></li>
                        <li><a href="http://localhost/corruption/discussion.php">Discussion Forum</a></li>
                    </ul>
                </li>
                <li class="features">
                    <h2>Useful</h2>
                    <hr width="50%">
                    <ul class="box">
                        <li><a href="http://www.cbi.gov.in/contact.php">CBI</a></li>
                        <li><a href="http://anticorruptionbureau.org/">Anti Corruption Council Of India</a></li>
                        <li><a href="https://www.india.gov.in/frequently-asked-questions-anti-corruption-bureau?page=39">FAQ - Anti Corruption Bureau</a></li>
                        <li><a href="https://cba.gov.pl/en">Central Anti-Corruption Bureau</a></li>
                        <li><a href="https://www.nativeplanet.com/anti-corruption-bureau-acb-toll-free-number-india-1228.html">Toll Free Number (Anti Corruption Bureau)</a></li>
                    </ul>
                </li>
                <li>
                    <h2>Contact Us</h2>
                    <hr width="50%">
                    <ul class="box">
                        <li><a href="https://github.com/Ankitkumar98">Ankit Kumar (Github)</a></li>
                        <li><a href="mailto:1805279@kiit.ac.in">Ankit Kumar (Mail)</a></li>
                        <hr width="20%">
                        <li><a href="https://github.com/RgnDunes">Divyansh Singh (Github)</a></li>
                        <li><a href="mailto:1805661@kiit.ac.in">Divyansh Singh (Mail)</a></li>
                    </ul>
                </li>
            </ul>
            <div class="footer-bottom">
                <p>All Right reserved by &copy;CorruptionFreeIndia 2020</p>
            </div>
            <div class="footer-bottom">
                <p><a href="#top">Back to top</a></p>
            </div>
        </footer>
    </div>
    </main>
    
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/discussion.js"></script>    
</html>