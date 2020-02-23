 <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="/">Blog</a>
  <div class="collapse navbar-collapse" id="navbarCollapse">
<ul class="navbar-nav mr-auto">
<li><a class="nav-link" href="/">Home</a></li>
<?php 
	if ($_SESSION['authenticated']) {
?>
      <li class="nav-item">
      <?php
        if($_SESSION['userrole'] == 'admin') {
      ?>
        <a class="nav-link" href="/admin.php">Admin</a>
        <?php } else { ?>
        <a class="nav-link" href="/studenthome.php">Student</a>
        <?php } ?>
      </li>
<?php
	}
?>
</ul>
<?php
	if ($_SESSION['authenticated']) {
?>
<a href="/logout.php"><span class="navbar-text">Logout <?php echo $_SESSION['username'] ?></a>
</span>
<?php
	}
?>
  </div>
</nav>
