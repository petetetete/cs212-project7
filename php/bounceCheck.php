<?php

session_start();

// Check if the username session variable is set, meaning they've logged in
if(!isset($_SESSION["username"])){
    header("Location: login.php");
}
