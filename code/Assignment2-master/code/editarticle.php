<?php include("templates/page_header.php");?>
<?php include("lib/auth.php") ?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$aid = $_GET['aid'];	
	$result=get_article($dbconn, $aid);
	$row = pg_fetch_array($result, 0);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$title = $_POST['title'];
	$content = $_POST['content'];
	$aid = $_POST['aid'];
	if($_SESSION['userrole'] == "admin") {
		$result=update_article($dbconn, $title, $content, $aid);
	}
    elseif (($_SESSION['userrole'] == "user") && (checkauthor($dbconn,$aid) == $_SESSION['username'])){
        //check if author is same user
        $result=update_article($dbconn, $title, $content, $aid);
    }
    else {
        error_log("a student user tried editing not owned article: ". $_SESSION['username'], 3, "/var/tmp/php-assign2-errors.log");
        error_log(" The time is " . date("Y-m-d h:i:sa").PHP_EOL, 3, "/var/tmp/php-assign2-errors.log");
        header("Location: /logout.php");
    	//someone messed with sessions
        exit;
	}
	header("Location: /");
	exit;
}
?>

<!doctype html>
<html lang="en">
<head>
	<title>New Post</title>
	<?php include("templates/header.php"); ?>
</head>
<body>
	<?php include("templates/nav.php"); ?>
	<?php include("templates/contentstart.php"); ?>

<h2>New Post</h2>

<form action='#' method='POST'>
	<input type="hidden" value="<?php echo $row['aid'] ?>" name="aid">
	<div class="form-group">
	<label for="inputTitle" class="sr-only">Post Title</label>
	<input type="text" id="inputTitle" required autofocus name='title' value="<?php echo $row['title'] ?>">
	</div>
	<div class="form-group">
	<label for="inputContent" class="sr-only">Post Content</label>
	<textarea name='content' id="inputContent"><?php echo $row['content'] ?></textarea>
	</div>
	<input type="submit" value="Update" name="submit" class="btn btn-primary">
</form>
<br>

	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>
