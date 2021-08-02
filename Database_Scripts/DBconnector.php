<?php
class SERVER
{
    const HOST = "localhost";
    const SER_USER = "root";
    const SER_PASS = "";
    const ACC_DB_NAME = "account database";
    const QUE_DB_NAME = "question database";
}

class TABLE
{
    const ACCOUNT_DETAILS_DB = "account details";
    const ACCOUNT_SCORE_DB = "account score";
    const QUESTION_PROP_DB = "question properties";
}
class ASSESTS
{
    const CODINGGIF = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/assests/Coding.gif";
    const BADGES_CSS = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Badge%20Chart/frontend/badges.css";
    const LOGO = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/assests/Logo.png";
};
class LINK
{
    const QUESTIONPAGE = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Question%20Display%20template/frontend/question.php";
    const LEADERBOARD = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/leaderboard/frontend/leaderboard.php";
    const CHALLENGES = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Challenges/frontend/challenges.php";
    const PROFILE = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Profile/frontend/profile.php";
    const HOMEPAGE = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Home%20page/frontend/homepage.php";
    const BADGECHART = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Badge%20Chart/frontend/badgechart.php";
    const CODE = "";
    const LOGOUT = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Logout/frontend/logout.php";

    const SIGNUP = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Sign%20up/frontend/signup.php";
    const LOGIN = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Login/frontend/login.php";
    const ABOUTUS = "http://localhost/AU_CODING_PLATFORM/CODE_BASE/About/frontend/aboutus.php";
    const COMPILER = "http://localhost/AU_CODING_PLATFORM/Compiler_Scipts/compiler.php";
    const QUESTIONS_FOLDER = "C:/xampp/htdocs/AU_CODING_PLATFORM/Database/Questions/%s/";
    const ACCOUNTS_FOLDER = "C:/xampp/htdocs/AU_CODING_PLATFORM/Database/Accounts/%s/";
    const SUBMITTED_CODE_FOLDER = "C:/xampp/htdocs/AU_CODING_PLATFORM/Database/Accounts/%s/Submitted Codes/%s/";
    const UNLOCKED_TEST_CASES_FOLDER = "C:/xampp/htdocs/AU_CODING_PLATFORM/Database/Accounts/%s/Unlocked testcases/%s/";
};
?>

<?php

$DB_LINK = mysqli_connect(SERVER::HOST, SERVER::SER_USER, SERVER::SER_PASS, SERVER::ACC_DB_NAME);
$QDB_LINK = mysqli_connect(SERVER::HOST, SERVER::SER_USER, SERVER::SER_PASS, SERVER::QUE_DB_NAME);
if (!$DB_LINK) {
    die('Error connecting to ' . SERVER::ACC_DB_NAME . 'ERROR:' . mysqli_connect_error());
}
if (!$QDB_LINK) {
    die('Error connecting to ' . SERVER::QUE_DB_NAME . 'ERROR:' . mysqli_connect_error());
}
session_start();
if (isset($_SESSION['TIME_STAMP']) && (time() - $_SESSION['TIME_STAMP'] > 10800)) {
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    unset($_SESSION['TIME_STAMP']);
    header("Location:" . LINK::LOGIN);
}

?>
<?php
function getBadgeArray()
{
    return array("BB", "BB++", "LTB", "LTB++", "IMB1", "IMB2", "FSB", "P1B", "P2B", "F1B", "F2B", "BRB", "SLB", "GLB", "RDB");
}

function getPoints($b)
{
    $badge_list = getBadgeArray();
    foreach ($badge_list as $key => $value) {
        if ($value == $b) {
            return intval($key + 1) * 50;
        }
    }
}
function INIT_LEADERBOARD()
{
    global $DB_LINK;
    $QUERY = "SELECT Username,Points FROM " . "`" . TABLE::ACCOUNT_SCORE_DB . "`" . " ORDER BY Points DESC";
    $RESULT = mysqli_query($DB_LINK, $QUERY);
    if ($RESULT and mysqli_num_rows($RESULT)) {
        $row =  mysqli_fetch_all($RESULT);
        return $row;
    }
    return array();
}
function calPoints($arr)
{

    $points = 0;
    foreach ($arr as $key => $value) {

        $points += getPoints($value);
    }
    return $points;
}
function alreadyDone($Username, $Qid)
{
    global $DB_LINK;
    $dir = sprintf(LINK::SUBMITTED_CODE_FOLDER, $Username, $Qid);
    $Username = $_SESSION["Username"];
    $QUERY = "SELECT solved FROM " . "`" . TABLE::ACCOUNT_SCORE_DB . "`" . " WHERE Username = '$Username' LIMIT 1";
    $RESULT = mysqli_query($DB_LINK, $QUERY);
    if ($RESULT and mysqli_num_rows($RESULT) > 0) {
        $flag = 0;
        $row = mysqli_fetch_assoc($RESULT);
        $solved = json_decode($row["solved"]);
        foreach ($solved as $key => $value) {
            if (strval($Qid) == $value) {
                $flag = 1;
            }
        }
        if ($flag == 0) {
            $QUERY = "UPDATE " . "`" . TABLE::ACCOUNT_SCORE_DB . "`" . " SET Solved = JSON_ARRAY_APPEND(Solved,'$','$Qid') WHERE Username = '$Username';";
            $RESULT = mysqli_query($DB_LINK, $QUERY);
            if (!$RESULT) {
                echo ("QUESTION NOT ADDED");
            }
        }
    }
    return $flag;
}


function getBadge($b)
{
    switch ($b) {
        case "BB":
            $html = '<div class="content">
    <div class="badge-container" value="BB">
        <div class="badges blue">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;


        case "BB++":
            $html = '<div class="content">
    <div class="badge-container" value="BB++">
        <div class="badges blue-dark">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "LTB":
            $html = '<div class="content">
    <div class="badge-container" value="LTB">
        <div class="badges green">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>

</div>';
            return $html;
        case "LTB++":
            $html = '<div class="content">
    <div class="badge-container" value="LTB++">
        <div class="badges green-dark">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "IMB1":
            $html = '<div class="content">
    <div class="badge-container" value="IMB1">
        <div class="badges teal">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "IMB2":
            $html = '
<div class="content">
    <div class="badge-container" value="IMB2">
        <div class="badges teal-dark">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "FSB":
            $html = '
<div class="content">
    <div class="badge-container" value="FSB">
        <div class="badges pink">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "P1B":
            $html = ' <div class="content">
    <div class="badge-container" value="P1B">
        <div class="badges purple">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "P2B":
            $html = '<div class="content">
    <div class="badge-container" value="P2B">
        <div class="badges red">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "F1B":
            $html = '
<div class="content">
    <div class="badge-container" value="F1B">
        <div class="badges orange">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-brightness-low-fill" viewBox="0 0 16 16">
                    <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8.5 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 11a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm5-5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm-11 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9.743-4.036a.5.5 0 1 1-.707-.707.5.5 0 0 1 .707.707zm-7.779 7.779a.5.5 0 1 1-.707-.707.5.5 0 0 1 .707.707zm7.072 0a.5.5 0 1 1 .707-.707.5.5 0 0 1-.707.707zM3.757 4.464a.5.5 0 1 1 .707-.707.5.5 0 0 1-.707.707z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "F2B":
            $html = '
<div class="content">
    <div class="badge-container" value="F2B">
        <div class="badges yellow">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-brightness-low-fill" viewBox="0 0 16 16">
                    <path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8.5 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 11a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm5-5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm-11 0a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9.743-4.036a.5.5 0 1 1-.707-.707.5.5 0 0 1 .707.707zm-7.779 7.779a.5.5 0 1 1-.707-.707.5.5 0 0 1 .707.707zm7.072 0a.5.5 0 1 1 .707-.707.5.5 0 0 1-.707.707zM3.757 4.464a.5.5 0 1 1 .707-.707.5.5 0 0 1-.707.707z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "BRB":
            $html = '
<div class="content">
    <div class="badge-container" value="BRB">
        <div class="badges bronze">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "SLB":
            $html = '
<div class="content">
    <div class="badge-container" value="SLB">
        <div class="badges silver">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "GLB":
            $html = '
<div class="content">
    <div class="badge-container" value="GLB">
        <div class="badges gold">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                    <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
        case "RDB":
            $html = '
<div class="content">
    <div class="badge-container" value="RDB">
        <div class="badges diamond">
            <div class="circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                    <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z" />
                </svg>
            </div>
        </div>
    </div>
</div>';
            return $html;
    }
}

?>
<?php
function deleteFile($filepath)
{
    if (is_dir($filepath)) {
        $files = glob($filepath . '*', GLOB_MARK);
        foreach ($files as $file) {
            deleteFile($file);
        }
        rmdir($filepath);
    } elseif (is_file($filepath)) {
        unlink($filepath);
    }
}
?>