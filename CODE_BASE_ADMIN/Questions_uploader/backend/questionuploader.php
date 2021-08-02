<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
?>
<?php

if ($_POST) {


    global $QDB_LINK;
    $Qname = trim($_POST["Qname"]);
    $Qlevel = trim($_POST["Qlevel"]);
    $Qaward = json_encode(explode(',', $_POST["Qaward"]));
    $Qdescription = $_POST["Qdescription"];
    $Qtestcase = $_POST["Qtestcase"];
    $Qpicture = isset($_FILES["Qpicture"]) ? $_FILES["Qpicture"] : false;
    if (!doesQuestionAlreadyExist($Qname) && createQuestionFolderPath($Qname)) {
        $tcDir = mysqli_escape_string($QDB_LINK, testcaseUpload($Qtestcase, $Qname));
        $dcpDir = mysqli_escape_string($QDB_LINK, descriptionUpload($Qdescription, $Qname));
        $ret = imageUpload($Qpicture, $Qname);
        $imgDir = $ret ?  mysqli_escape_string($QDB_LINK, $ret[1]) : "";
        if ($imgDir || $tcDir && $dcpDir) {
            $QUERY = "INSERT INTO " . "`" . TABLE::QUESTION_PROP_DB . "`" . "(Qname,Qlevel,Qaward,Qdescription,Qtestcase,Qpicture) VALUES('$Qname','$Qlevel','$Qaward','$dcpDir','$tcDir', '$imgDir')";
            $status = intval(mysqli_query($QDB_LINK, $QUERY));
            if (!$status) {
                $response = array(
                    "code" => 0,
                    "status" => "failure",
                    "message" => "Record adding failed!"
                );
                deleteFile(getQuestionFolderPath($Qname));
            }
        } else {
            $response = array(
                "code" => 0,
                "status" => "failure",
                "message" => "File upload failed!"
            );
        }
    } else {
        $response = array(
            "code" => 0,
            "status" => "failure",
            "message" => "Failed to create folder path / question already exist"
        );
    }
}
function doesQuestionAlreadyExist($name)
{
    global $QDB_LINK;
    $QUERY = "SELECT Qname FROM " . "`" . TABLE::QUESTION_PROP_DB . "`" . " WHERE Qname = '$name' LIMIT 1";

    $RESULT = mysqli_query($QDB_LINK, $QUERY);
    $FLAG = false;
    if (mysqli_fetch_row($RESULT) > 0) {
        $FLAG = true;
    }
    return $FLAG;
}
function getQuestionFolderPath($name)
{
    return sprintf(LINK::QUESTIONS_FOLDER, $name);
}
function createQuestionFolderPath($name)
{
    $uploadsDir = sprintf(LINK::QUESTIONS_FOLDER, $name);
    if (!is_dir($uploadsDir)) {
        return mkdir($uploadsDir, 0755, recursive: true);
    }
    return false;
}
function testcaseUpload($file, $name)
{

    $uploadsDir = sprintf(LINK::QUESTIONS_FOLDER, $name) . 'testcases/';
    $sampleCaseDir = $uploadsDir . 'samplecase/';
    $realCaseDir = $uploadsDir . 'realcase/';
    if (!file_exists($uploadsDir)) {
        mkdir($sampleCaseDir  . 'input/', recursive: true);
        mkdir($sampleCaseDir  . 'output/', recursive: true);
        mkdir($realCaseDir  . 'input/', recursive: true);
        mkdir($realCaseDir  . 'output/', recursive: true);
    } else {
        return false;
    }

    $sCaseCount = 0;
    $rCaseCount = 0;

    foreach ($file as $key => $value) {
        if (isset($value["samplecase"])) {
            $sCaseCount++;
            if (!file_put_contents($sampleCaseDir  . 'input/' . $sCaseCount . ".txt", $value[0])) {
                deleteFile($uploadsDir);
                return false;
            }
            if (!file_put_contents($sampleCaseDir  . 'output/' . $sCaseCount . ".txt", $value[1])) {
                deleteFile($uploadsDir);
                return false;
            }
        } else {

            $rCaseCount++;

            if (!file_put_contents($realCaseDir  . 'input/' . $rCaseCount . ".txt", $value[0])) {
                deleteFile($uploadsDir);
                return false;
            }
            if (!file_put_contents($realCaseDir  . 'output/' . $rCaseCount . ".txt", $value[1])) {
                deleteFile($uploadsDir);
                return false;
            }
        }
    }
    return $uploadsDir;
}
function descriptionUpload($file, $name)
{
    $uploadsDir = sprintf(LINK::QUESTIONS_FOLDER, $name) .  'descriptions/';
    if (!file_exists($uploadsDir)) {
        mkdir($uploadsDir, recursive: true);
    }
    foreach ($file as $key => $value) {
        if (!file_put_contents($uploadsDir . $key + 1 . ".txt", $value)) {
            deleteFile($uploadsDir);
            return false;
        }
    }
    return $uploadsDir;
}
function imageUpload($file, $name)
{
    if ($file == false) return $file;
    $uploadsDir =  sprintf(LINK::QUESTIONS_FOLDER, $name) . 'images/';
    if (!file_exists($uploadsDir)) {
        mkdir($uploadsDir, recursive: true);
    } else {
        $response = array(
            "code" => 0,
            "status" => "failure",
            "message" => "Question already exist."
        );
        return [$response, $uploadsDir];
    }
    $allowedFileType = array('jpg', 'png', 'jpeg');
    $fileList = [];
    $response = [];
    if (!empty(array_filter($file['name']))) {
        foreach ($file['name'] as $key => $val) {
            $fileName        = $file['name'][$key];
            $tempLocation    = $file['tmp_name'][$key];
            $fileType        = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $targetFilePath  = $uploadsDir . $key + 1 . ".$fileType";
            if (in_array($fileType, $allowedFileType)) {
                if (move_uploaded_file($tempLocation, $targetFilePath)) {
                    array_push($fileList, $fileName);
                    $response = array(
                        "code" => 1,
                        "status" => "success",
                        "message" => "Question has been uploaded."
                    );
                } else {
                    deleteFile($uploadsDir);
                    $response = array(
                        "code" => 0,
                        "status" => "failure",
                        "message" => "Question could not be uploaded."
                    );
                    break;
                }
            } else {
                deleteFile($uploadsDir);
                $response = array(
                    "code" => 0,
                    "status" => "failure",
                    "message" => "Only .jpg, .jpeg and .png file formats are allowed."
                );
                break;
            }
        }
    }
    return [$response, $uploadsDir];
}


?>


