<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" type="image/png" href="../cheese/cheese.ico"/>
		<title>Camagru | Feed</title>
		<link rel="stylesheet" href="">
		<link rel="stylesheet" href="">
		<link rel="stylesheet" href="">
		<link rel="stylesheet" href="">
		<link rel="stylesheet" href="">
		<script src="../scripts/feedscripts.js"></script>
	</head>
​
  <body class="bg">
    <div class="head">
​
<!-- the drop down button and username-->
<?php
	if(!isset($_SESSION['username']))
		session_start();
	if(isset($_SESSION['username'])) {
		echo("<div class='dropdowns'>
				<label for='drop'><i class='fas fa-cheese'></i></label>
				<button onclick='myFunction()' class='formstuff' name='drop' id='drop'>
				<div class='other_option'></div>
				<div class='options'></div>
				<div class='options'></div>
				<div class='options'></div>
				</button>
				<div id='myDropdown' class='dropdowns'>
				<a href='profilelive.php'>Profile</a>
				<a href='gallery.php'>Gallery</a>
				<a href='feed.php'>Feed</a>
				<a href='camlive.php'>Camera & Editor</a>
				</div>
			</div>");
			
		echo("<div class='loggedin-user'>@"
			.$_SESSION['username']. 
			"</div>");
		echo("
		<div class='formbox'>
			<form action='./user_search.php' method='post'>
				<input class'fieldbox 'type='text' name='search_param' placeholder='username search'>
				<input type='submit' name='search' value='GO!'>
			</form>
			</div>");
	}
?>
  
    <div class="profile-links">
    <?php
        if(isset($_SESSION['username']))
        {
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
​
	</div>
	<!-- script for drop btn-->
	<script>
		function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
		}
		window.onclick = function(event) {
			if (!event.target.matches('.drop'))
			{
				var dropdowns = document.getElementsByClassName("dropdown-content");
				var i;
				for (i = 0; i < dropdowns.length; i++)
				{
					var openDropdown = dropdowns[i];
					if (openDropdown.classList.contains('show'))
					{
						openDropdown.classList.remove('show');
					}
				}
			}
		}
	</script>
​
​
<!--feed stream-->
<?php
	require '../webphp/database2.php';
	try {
		$stmt = $conn->query("SELECT * FROM feed ORDER BY upload_date DESC");
		$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $exception) {
		echo "<script>alert('SQL ERROR: 1')</script>";
		exit();
	}
	if (!$posts) {
		echo "<div class='no-uploads'>No posts to view here yet!</div>";
	}
	else {
		foreach ($posts as $col) {
			echo "<div class='feed-white-space'>";
			echo "<div class='feed-work-space'>";
			// echo "<div class='the-box'>";
			$encoded_image = $col['img'];
			$display = "<img onclick='displayComments({$col['image_id']})' src='data:image/*;base64,{$encoded_image}' width='100%' height='100%' >";
			//session_start();
			if (isset($_SESSION['username'])) {
				// post owner
				echo "<div class='feed-usr' >@" . $col['username'] . "</div>";
				// post image
				echo "<div class='feed-img'>" . $display;
				echo "<span class='tooltiptext'>Click/Tap on the post to view comments</span>";
				echo "</div>";
				echo"<div class='some-space'></div>";
				// like button
				echo "<button class='feed-like' onclick='like_img({$col['image_id']})'>Like</button>";
				// post likes
				echo "<div class='feed-likes' id='like_section-{$col['image_id']}'>
						<p class='feed-likes'>{$col['likes']}</p>
					</div>";
				// post comment
				echo"<div class='comment-post'>";
				echo "<input type='text' id='comment_box-{$col['image_id']}' >";
				echo "<button onclick='comment_img({$col['image_id']})'>Post</button>";
				echo"</div>";
				// view comments section
				echo "<div id='comments_section-{$col['image_id']}'>
						<b class='feed-comment'></b>
					</div>";
				// echo "<div style='width:100%; height:3%;'>  </div>";
				// posted date
				echo "<div class='feed-date' >Posted " . $col['upload_date'] . "</div>";
				// delete button
				if ($_SESSION['username'] === $col['username']) {
					echo "<form class='feed-delete' action='../php/post_activity.php' method='post'>
								<input type='hidden' name='id' value='{$col['image_id']}'>
								<input  type='submit' name='delete' value='Delete post'>
							</form>";
				}
				echo "<div class='feed-line' ><hr/ ></div>";
			}
			else {
				echo "<div class='feed-usr' >@" . $col['username'] . "</div>";
				echo "<div class='feed-img'>" . $display . "</div>";
				echo "<div class='feed-likes'><p class='feed-likes'>{$col['likes']} likes</p></div>";
				echo "<div class='feed-date' >Posted " . $col['upload_date'] . "</div>";
				echo "<div class='feed-line' ><hr/ ></div>";
			}
			echo "</div>";
			echo "</div>";
		}
		echo"<div class='more-space'></div>";
	}
	$conn = NULL;
?>
​
	<!-- <div class="notified" id="notification">
	</div> -->
	<div class="footer">
		<p>Julian Coetzee</p>
		<div class="copyright">Copyright© Camagru - WeThinkCode_ jcoetzee 2019</div>
	</div>
​
  </body>
</html>