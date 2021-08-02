<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
?>
<?php
if ($_POST) {
    if (isset($_SESSION['Username'])) {
        session_destroy();
    }
    header("Location:" . LINK::LOGIN);
} else {
    header("Location:" . LINK::LOGIN);
}
?>