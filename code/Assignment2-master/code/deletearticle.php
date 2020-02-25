<?php
    include("templates/page_header.php");
    include("lib/auth.php");
    $aid = $_GET['aid'];
    $author = checkauthor($dbconn,$aid);  
    #echo "aid=".$aid."<br>";
    if($_SESSION['userrole'] == "admin") {
        $result = delete_article($dbconn, $aid);
        //Redirect to admin area
        header("Location: /admin.php");
        exit;
        }
    elseif (($_SESSION['userrole'] == "user") && ($author == $_SESSION['username'])){
        //check if author is same user
        $result = delete_article($dbconn, $aid);
        //redirect to student
        header("Location: /studenthome.php");
        exit;
    }
    else{
        error_log("a student user tried deleting not owned article: ". $_SESSION['username'], 3, "/var/tmp/php-assign2-errors.log");
        error_log(" some one who shouldn't be here on delete page was here on time " . date("Y-m-d h:i:sa").PHP_EOL, 3, "/var/tmp/php-assign2-errors.log");
        header("Location: /logout.php");
        exit;
    }

?>
