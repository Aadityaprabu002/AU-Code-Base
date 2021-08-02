<?php
function tranferBadges_and_Points($Username, $Qid)
{
    global $DB_LINK, $QDB_LINK;

    $questionQuery = "SELECT Qaward FROM " . " `" . TABLE::QUESTION_PROP_DB . "` " . " WHERE Qid= " . intval($Qid) . ';';
    $questionResult = mysqli_query($QDB_LINK, $questionQuery);
    if ($questionResult and mysqli_num_rows($questionResult) > 0) {
        $questionRow = mysqli_fetch_assoc($questionResult);
        $points = calPoints(json_decode($questionRow["Qaward"]));
        $badges = json_decode($questionRow["Qaward"]);
        $accountQuery = "SELECT Points,Badges FROM " . "`" . TABLE::ACCOUNT_SCORE_DB . "`" . " WHERE Username = '$Username' LIMIT 1";
        $accountResult = mysqli_query($DB_LINK, $accountQuery);
        if ($accountResult and mysqli_num_rows($accountResult) > 0) {
            $accountRow = mysqli_fetch_assoc($accountResult);
            $newPoints = intval($accountRow["Points"]) + $points;
            $newBadge = json_decode($accountRow["Badges"]);
            $newBadge = array_merge($newBadge, $badges);
            $newBadge = json_encode($newBadge);
            $accountUpdateQuery = "UPDATE " . "`" . TABLE::ACCOUNT_SCORE_DB . "`" . " SET Points = '$newPoints', Badges = '$newBadge' WHERE Username = '$Username';";

            $accountUpdateResult =  mysqli_query($DB_LINK, $accountUpdateQuery);
            if (!$accountUpdateResult) {
                echo ("Account updation failed");
            }
        } else {
            echo ("Account retrival  failed");
        }
    } else {
        echo ("Award retrival failed");
    }
}
function storeCode($code, $Username, $Qid, $language)
{
    $flag = 1;
    $dir = sprintf(LINK::SUBMITTED_CODE_FOLDER, $Username, $Qid);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
        $filename = 1 . ".txt";
        $filename = $dir . $filename;
        $data = "$language\n" . $code;
        if (!file_put_contents($filename, $data)) {
            $flag = 0;
        }
    } else {
        $files = scandir($dir);
        $len = count($files) - 2;
        $filename = intval($len + 1) . ".txt";
        $filename = $dir . $filename;
        $data = "$language\n" . $code;
        if (!file_put_contents($filename, $data)) {
            $flag = 0;
        }
    }
    return $flag;
}
