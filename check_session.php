<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['session_id'])) {
    header("Location: login_form.php?error=1");
    exit();
}
?>
