<?php
session_start();
if ($_SESSION['masuk'] == false) {
    header('location: masuk.php');
}

?>