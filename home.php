<?php
session_start();
include_once 'include/functions.php';
$user = new User();
$uid = $_SESSION['uid'];
if (!$user->get_session())
{
	header('location:login.php');
}
if ($_GET['q'] == 'logout')
{
	$user->user_logout();
	header('location:login.php');
}
?>
//HTML Code
<html>
<head></head>
<body>
<a href='?q=logout'>LOGOUT</a>
<h1> Hello <?php $user->get_fullname($uid); ?></h1>	
</body>
</html>
