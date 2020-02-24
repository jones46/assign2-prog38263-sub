<?php include("templates/page_header.php");?>
<!doctype html>
<html lang="en">
<head>
	<title>Home</title>
	<?php include("templates/header.php"); ?>
</head>
<body>
	<?php include("templates/nav.php"); ?>
	<?php include("templates/contentstart.php"); ?>

	<h3 class="pb-4 mb-4 font-italic border-bottom">Articles</h3>

	<?php
		$result = get_article_list($dbconn);
		if (pg_num_rows($result)>0) {
			while ($row = pg_fetch_array($result)) {
	?>

<div class="blog-post">
<h2 class="blog-post-title"><?php echo $row['title'] ?></h2>
<p class="blog-post-meta"><?php echo substr($row['date'],0,10)." by ".$row['author'] ?></p>
<p><?php echo $row['stub'] ?><br><a href='article.php?aid=<?php echo $row['aid'] ?>'>Read more...</a></p>
</div>

	<?php } //close while loop
		} //if condition close checking if any articles present in database
		else {
			error_log("Forgot loading schema or data sql file!", 3, "/var/tmp/php-assign2-errors.log");
			error_log(" The time is " . date("Y-m-d h:i:sa").PHP_EOL, 3, "/var/tmp/php-assign2-errors.log");
	?>
	<div class="blog-post">
		<h2 class="error-msg">No article exists yet here </h2>
	</div>
	<?php } //close no articles case
	?>
	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>
