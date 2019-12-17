<?php
	if(!isset($_SESSION['username']))
    session_start();
?>

<html>
  <head>      
    <meta charset = utf-8>
    <title>Profile</title>
    <link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="../css_html/form.css">
    <link rel="stylesheet" href="../css_html/layout.css">
  </head>
    <body>
    <div class="camagru_header">
        <?php
        if(isset($_SESSION['username']))
        {
            echo ($_SESSION['username']."'s Camera & Editor<br />");
            echo("<a id='logout' href='../webphp/logout.php'>Logout</a>"); 
        }
        else
            {
            echo("<div class='create'>
                    <a id='link' href='signuplive.php'>Sign Up</a>
                </div>
                <div class='create'>
                    <a id='link' href='loginlive.php'>Login</a>
                </div>");
            }
        ?>
    </div>
    
        <div >
         
        </div>
     </body>
</html>