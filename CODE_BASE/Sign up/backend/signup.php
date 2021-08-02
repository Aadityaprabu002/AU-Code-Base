<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
if ($_POST) {
   switch ($_POST["case"]) {
      case 1:
         echo (intval(checkEmailPresent($_POST['email'])));
         break;
      case 2:
         echo (intval(checkUsernamePresent($_POST['user-name'])));
         break;
      case 3:
         $fname = $_POST["fname"];
         $lname = $_POST["lname"];
         $email = $_POST["email"];
         $username = $_POST['user-name'];
         $password = password_hash($_POST["new-password"], PASSWORD_DEFAULT, array('cost' => 8));
         $github = isset($_POST["github"]) ? $_POST["github"] : "";
         $bio = isset($_POST["user-bio"]) ? $_POST["user-bio"] : "";
         $twitter = isset($_POST["twitter"]) ? $_POST["twitter"] : "";
         $status = addRecord($fname, $lname, $email, $username, $password, $github, $twitter, $bio);
         if ($status == 2) {
            $_SESSION['Username'] = $username;
            $_SESSION['TIME_STAMP'] = time();
            header("Location:" . LINK::CHALLENGES);
         } else {
            echo ("Error adding record or couldnt initialize completely!");
         }
   }
}
?>
<?php
function addRecord($fname, $lname, $email, $username, $password, $github, $twitter, $bio)
{
   global $DB_LINK;
   $status = 0;
   $QUERY = "INSERT INTO " . "`" . TABLE::ACCOUNT_DETAILS_DB . "`" . " (Firstname,Lastname,Email_id,Username,Password_hash,Github,Twitter,Bio) VALUES('$fname','$lname','$email','$username', '$password','$github','$twitter','$bio')";
   $status += intval(mysqli_query($DB_LINK, $QUERY));
   $QUERY = "INSERT INTO " . "`" . TABLE::ACCOUNT_SCORE_DB . "`" . " (Username,Points,Badges,Solved) VALUES('$username','0','[]','[]')";
   $status += intval(mysqli_query($DB_LINK, $QUERY));
   echo $status;
   mysqli_close($DB_LINK);
   return $status;
}

function checkUsernamePresent($username)
{
   global $DB_LINK;
   $FLAG = false;
   $QUERY = "SELECT Username FROM " . "`" . TABLE::ACCOUNT_DETAILS_DB . "`" . " WHERE Username = '$username' LIMIT 1";
   $RESULT = mysqli_query($DB_LINK, $QUERY) or die('Error');
   if (mysqli_num_rows($RESULT) > 0) {
      $FLAG = true;
   }
   mysqli_close($DB_LINK);
   return $FLAG;
}
function checkEmailPresent($email)
{
   global $DB_LINK;
   $FLAG = false;
   $QUERY = "SELECT Email_id FROM " . "`" . TABLE::ACCOUNT_DETAILS_DB . "`" . " WHERE Email_id = '$email' LIMIT 1";
   $RESULT = mysqli_query($DB_LINK, $QUERY) or die('Error');
   if (mysqli_num_rows($RESULT) > 0) {
      $FLAG = true;
   }
   mysqli_close($DB_LINK);
   return $FLAG;
}
?>