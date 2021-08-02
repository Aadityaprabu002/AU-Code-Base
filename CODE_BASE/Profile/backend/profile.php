<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
if (!isset($_SESSION["Username"])) {
  header("Location:" . LINK::LOGIN);
}
if ($_GET) {
  $username = urldecode($_GET["Username"]);
} else {
  $username = $_SESSION["Username"];
}

$userDetails = getDetails($username);


?>
<?php
function getDetails($username)
{
  global $DB_LINK;
  $QUERY = "SELECT Firstname, Lastname,Bio,Twitter,Github FROM " . "`" . TABLE::ACCOUNT_DETAILS_DB . "`" . " WHERE Username = '$username' LIMIT 1";
  $RESULT = mysqli_query($DB_LINK, $QUERY);


  if ($RESULT and mysqli_num_rows($RESULT) > 0) {
    $row = mysqli_fetch_assoc($RESULT);
    $name = $row["Firstname"] . " " . $row["Lastname"];
    $bio = $row["Bio"];
    $githubLink =  $row["Github"];
    $twitterLink = $row["Twitter"];
  }

  $QUERY = "SELECT Badges,Points FROM " . "`" . TABLE::ACCOUNT_SCORE_DB . "`" . " WHERE Username = '$username' LIMIT 1";
  $RESULT = mysqli_query($DB_LINK, $QUERY);
  if ($RESULT and mysqli_num_rows($RESULT) > 0) {
    $row = mysqli_fetch_assoc($RESULT);
    $badges = json_decode($row["Badges"]);
    $points  = $row["Points"];
  }

  return array(
    "name" => strtoupper($name),
    "rank" => getRank(),
    "bio" => $bio,
    "github" =>  "$githubLink",
    "twitter" =>  "$twitterLink",
    "badges" => $badges,
    "points" => $points
  );
}
function getRank()
{
  global $username;
  $record = INIT_LEADERBOARD();
  // print_r($record);
  $rank = 1;
  $record[0][2] = $rank;
  for ($i = 1; $i < count($record); $i++) {
    if ($record[$i - 1][1] != $record[$i][1]) {
      $rank++;
    }
    $record[$i][2] = $rank;
  }
  for ($i = 0; $i < count($record); $i++) {
    if ($record[$i][0] == $username) {

      return $record[$i][2];
    }
  }
  return "NOT FOUND";
}
?>