<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
if (!isset($_SESSION["Username"])) {
    header("Location:" . LINK::LOGIN);
}
?>
<?php
function getQ_DATA($id)
{
    global $QDB_LINK;
    if (!intval($id)) {
        header("Location:" . LINK::CHALLENGES);
    }
    $details = array();
    $QUERY = "SELECT * FROM " . " `" . TABLE::QUESTION_PROP_DB . "` " . " WHERE Qid= " . intval($id) . ';';
    $RESULT = mysqli_query($QDB_LINK, $QUERY);
    if ($RESULT and mysqli_num_rows($RESULT) > 0) {
        $row = mysqli_fetch_assoc($RESULT);
        $Qname = $row["Qname"];
        $Qlevel = $row["Qlevel"];
        $Qaward = json_decode($row["Qaward"]);

        $Qdescription = [];

        foreach (glob($row["Qdescription"] . "*") as $key => $file) {
            array_push($Qdescription, file_get_contents($file));
        }


        $Qpicture = [];
        if ($row["Qpicture"]) {
            foreach (glob($row["Qpicture"] . "*") as $key => $file) {
                array_push($Qpicture, 'data:image/jpeg;base64,' . base64_encode(file_get_contents($file)));
            }
        }
        $details = array(
            "Qname" => $Qname,
            "Qlevel" => $Qlevel,
            "Qaward" => $Qaward,
            "Qdescription" => $Qdescription,
            "Qpicture" => $Qpicture
        );
    }
    return $details;
}
function getSubmittedCode($Qid)
{
    $Uname = $_SESSION["Username"];
    $dir = sprintf(LINK::SUBMITTED_CODE_FOLDER, $Uname, $Qid);
    $codes = array();
    if (is_dir($dir)) {
        foreach (glob($dir . "*.txt") as $key => $file) {
            array_push($codes, 'data:text/plain;base64,' . base64_encode(file_get_contents($file)));
        }
    }
    return $codes;
}
