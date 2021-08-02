<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
if (!isset($_SESSION["Username"])) {
    header("Location:http://localhost/AU_CODING_PLATFORM/CODE_BASE/Login/frontend/login.php");
}
$user = $_SESSION["Username"];
function getRankList()
{
    return INIT_LEADERBOARD();
}
