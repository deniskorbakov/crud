<?php
if (isset($_POST['appetizer_button'])) {
   	
setcookie ("login", "", time() - (10 * 365 * 24 * 60 * 60),"/");
setcookie ("token", "", time() - (10 * 365 * 24 * 60 * 60), "/");



header("Refresh:0; url=../authorization.php");
}
?>