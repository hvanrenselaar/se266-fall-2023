<?php
    //call session before any html
    session_start();
    if(!$_SESSION['loggedIn'])
    {
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <span class="navbar-brand">Schools</span>
    </div>
    <ul class="nav navbar-nav">
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'upload.php'): ?>class="active"<?php endif; ?>><a href="upload.php">Upload</a></li>
        <li <?php if(basename($_SERVER['PHP_SELF']) == 'search.php'): ?>class="active"<?php endif; ?>><a href="search.php">Search</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logoff.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">

