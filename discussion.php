<?php
    session_start();
    require_once('dbconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/discussion.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <!-- <div class="content">
                <h1 class="title">title</h1>
                <h4 class="title-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad corrupti cupiditate praesentium
                    esse nobis harum repudiandae ipsa quidem perferendis. Reiciendis impedit vero ab sequi ea hic repellat quas velit.
                    Hic voluptatum minima pariatur placeat veritatis et expedita eveniet nemo maxime, aliquid sit quos ab quae facere
                    alias, numquam nisi eligendi ut magnam repudiandae est aperiam?
                </h4>
                <button class="btn"><a id="ask">Ask a Question</a></button>
            </div> -->
        </div>

        <div class="search-sort" style="background-color:rgb(173, 169, 169);">
            <?php
                $query = 'SELECT thread_id FROM threads';
                $queryResult = mysqli_query($dbc,$query);
                $countQuestions =mysqli_num_rows($queryResult);
            ?>
            <div class="numQuestions">
                <p>Total no. of Questions : <?php echo $countQuestions ?></p>
            </div>
            
            <div class="search">
                <label for="search-ques">Search : </label>
                <input type="text" name="search-ques" length="500">
            </div>
    
            <div class="sort">
                <label for="sort-ques">Sort : </label>
                <select name="sort-type" id="sort-type">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                </select>
            </div>
        </div>

        <div class="askQuestion" id="ask-question">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="askQuestion">
                <textarea name="question" id="doubt" cols="30" rows="10"></textarea>
                <input type="submit" id="submit-form" value="POST" name="submit">
            </form>
        </div>
        

        <?php
            $query = 'SELECT * FROM threads';
            $queryResult = mysqli_query($dbc,$query) or die("error in fetching details from threads table");
            echo '<div class="questions">';
            while($row = mysqli_fetch_array($queryResult))
            {
                
                echo'<div class="user" style="
                            display:inline-block;
                            width:10%;
                            float:left;
                            height:100px;
                            padding-left:20px;
                        ">
                        <img src="./image/user.svg" width="50" height="50"alt="user"> <br>
                        <label for="username" style="padding-left:10px;">User</label>
                    </div>

                    <div class="questionDescription" style="
                        width: 90%;
                        height:100px;
                        float: right;
                        padding-top: 10px;   
                    ">';
                      echo  '<a href = "./threads.php?th_id='.$row['thread_id'].'">
                        <label for="quesTitle">'.$row['thread_title'].'</label> </a>
                        <p style="display:inline; padding-left:100px;">Asked on '.$row['thread_date'].' </p>
                        <p>'.$row['thread_desc'].'</p>
                    </div>

                    <hr style="
                        width:85%;
                        height:5%;
                        margin-left:10%;
                        margin-top:15px;
                    ">
                ';
                    
            }

            echo '</div>';

        ?>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, suscipit.
        </p>

    

    </main>
    
</body>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/discussion.js"></script>    
</html>