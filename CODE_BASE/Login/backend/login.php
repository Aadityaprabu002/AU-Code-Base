<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
?>
<?php
if (isset($_SESSION['Username'])) {
    header("Location:" . LINK::CHALLENGES);
}
?>
<?php
if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $QUERY = "SELECT Password_hash, Username FROM " . "`" . TABLE::ACCOUNT_DETAILS_DB . "`" . " WHERE Email_id = '$email' LIMIT 1";
    $RESULT = mysqli_query($DB_LINK, $QUERY);
    $RESPONSE  = array(0, "");
    if (mysqli_num_rows($RESULT) > 0) {
        $row = mysqli_fetch_assoc($RESULT);
        if (password_verify($password, $row["Password_hash"])) {
            $_SESSION['Username'] = $row["Username"];
            $_SESSION['TIME_STAMP'] = time();
            if (isset($_POST["rem"])) {
                setrawcookie("email", $email, time() + (86400 * 30), "/");
                setrawcookie("pass", $password, time() + (86400 * 30), "/");
            }
            $RESPONSE[0] = 1;
            $RESPONSE[1] = LINK::CHALLENGES;
            echo (json_encode($RESPONSE));
        } else {
            echo (json_encode($RESPONSE));
        }
    } else {
        echo (json_encode($RESPONSE));
    }
}
?>