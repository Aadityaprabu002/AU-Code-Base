<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
?>

<?php

if (!isset($_SESSION["Username"])) {
  header("Location:" . LINK::LOGIN);
}
?>

<?php
$user = $_SESSION["Username"];
$Q_list = getQ_DETAILS();

?>

<?php
function getQ_DETAILS()
{
  global $QDB_LINK;
  $details = array();
  $QUERY = "SELECT Qid,Qname,Qlevel,Qaward FROM " . "`" . TABLE::QUESTION_PROP_DB . "`";
  $RESULT = mysqli_query($QDB_LINK, $QUERY);
  if ($RESULT and mysqli_num_rows($RESULT) > 0) {
    while ($row = mysqli_fetch_assoc($RESULT)) {
      array_push($details, array($row["Qid"], $row["Qname"], $row["Qlevel"], json_decode($row["Qaward"])));
    }
  }
  return $details;
}
function getQ_CARD($id, $name, $level, $points)
{

  $link = LINK::QUESTIONPAGE . "?Qid=" . urlencode($id);
  $html = '<a href=' . $link . ' class="card p-0 mb-3 border-0 shadow-sm shadow--on-hover">
    <div class="card-body">
      <span class="row justify-content-between align-items-center">
        <span class="col-md-5 color--heading">' . $name . '
     
        </span>

        <span class="col-5 col-md-3 my-3 my-sm-0 color--text">
          <i class="fas fa-clock mr-1"></i>' . $points  . ' points
        </span>

        <span class="col-7 col-md-3 my-3 my-sm-0 color--text">
          <i class="fas fa-map-marker-alt mr-1"></i> ' . $level . '
        </span>

        <span class="d-none d-md-block col-1 text-center color--text">
          <small><i class="fas fa-chevron-right"></i></small>
        </span>
      </span>
    </div>
  </a> ';
  return $html;
}
?>