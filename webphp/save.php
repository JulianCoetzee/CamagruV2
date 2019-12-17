<?php
if(!isset($_SESSION['username']))
  session_start();
// if (isset($_POST['canvasData']))
if (isset($_POST['img']))
{
  // Get the data
  $username = $_SESSION['username'];
  // $imageData = $_POST['canvasData'];
  $imageData = $_POST['img'];

  $savename = '@'.$username.date('Y-m-d H:i:sT');
  if (!$savename || !$imageData)
  {
    echo "<script>alert('Save error!')</script>";
		echo "<script>window.open('../webpages/camlive.php?error=sendingfailed','_self')</script>";
		exit();
  }
 
  // Remove the headers (data:,) part.
  $imageData = str_replace(' ','+',$imageData);
  $filtersave=substr($imageData, strpos($imageData, ",")+1);
 
  // Need to decode before saving since the data received is already base64 encoded
  $unencodedsave=base64_decode($filtersave);
 
  $savefile = fopen('../cheese/'.$savename.'.png', 'wb');
  // $savefile = fopen('/goinfre/jcoetzee/Desktop/PHP_live/apache2/htdocs/CamagruTakeTwo/new3.png', 'w');
  fwrite($savefile, $unencodedsave);
  fclose($savefile);

  if (!$savefile)
  {
    echo "<script>alert('Save error!')</script>";
		echo "<script>window.open('../webpages/camlive.php?error=savingfailed','_self')</script>";
		exit();
  }
  else
  {
    require 'database2.php';

    $stmt = $conn->prepare("INSERT INTO `feed`(`image_id`, `img`, `username`, `upload_date`, `likes`) VALUES(:imgid, :img, :user, :savedate, :likes)");
		$stmt->bindParam(':imgid', $savename);
    $stmt->bindParam(':img', $savefile);
    $stmt->bindParam(':user', $username);
    $stmt->bindParam(':savedate', date('Y-m-d H:i:sT'));
    $stmt->bindParam(':likes', 0);
		if (!$stmt->execute()) 
		{
			echo "<script>alert('SQL ERROR: 1')</script>";
			echo "<script>window.open('../webpages/camlive.php?error=sqlerror','_self')</script>";
			exit();
    }
    else
    {
      echo "<script>window.open('../webpages/camlive.php?save=success','_self')</script>";
      exit();
    }
  }
}
else
{
  echo "<script>window.open('../webpages/camlive.php','_self')</script>";
  exit();
}

?>