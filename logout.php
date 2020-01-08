<?php
session_start();
session_destroy();
session_unset();
header("refresh:0;url=nodue_login.php");
?>