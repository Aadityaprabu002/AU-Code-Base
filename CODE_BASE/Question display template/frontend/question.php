<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\Question Display template\backend\question.php');
?>
<?php
if (isset($_GET)) {
    $data = getQ_DATA(urldecode($_GET["Qid"]));
    $_SESSION["Qid"] = $_GET["Qid"];
    unset($_SESSION["code"]);
} else {
    header("Location:" . LINK::CHALLENGES);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel=" stylesheet" href="editor.css">
    <link rel=" stylesheet" href="question.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark text-uppercase">
        <a class="navbar-brand" href=<?php echo (LINK::HOMEPAGE); ?>><img src=<?php
                                                                                echo (ASSESTS::LOGO);
                                                                                ?> width="85"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href=<?php echo (LINK::HOMEPAGE); ?>>HOME</a>

                <a class="nav-item nav-link" href=<?php echo (LINK::LEADERBOARD); ?>>LEADERBOARD</a>
                <a class="nav-item nav-link" href=<?php echo (LINK::CHALLENGES); ?>>CHALLENGE</a>
                <a class="nav-item nav-link " target="_blank" href=<?php echo (LINK::BADGECHART); ?>>Badge chart</a>
            </div>
        </div>
        <div class="button-item">
            <button onclick="location.href =' <?php echo (LINK::PROFILE); ?>'" class=" btn btn-light profile-btn">
                <?php
                echo ($_SESSION["Username"]);
                ?>
            </button>

        </div>
    </nav>
    <div class="wrapper">
        <section class="question-section">
            <section class="Qname-section ">
                <h1 class="Qname text-uppercase">
                    <?php
                    echo ($data["Qname"]);
                    ?>
                </h1>
                <h4 class="float">
                    <?php
                    echo ("Difficulty type: " . $data["Qlevel"])
                    ?>
                </h4>
                <h4 class="float">
                    <?php
                    echo ("Points: " . calPoints($data["Qaward"]))
                    ?>
                </h4>
            </section>
            <section class="Qdescription-section ">
                <?php foreach ($data["Qdescription"] as $key => $value) {
                    if ($key != 0) {
                        echo ("<div class='Qdescription inner round-edge bg-gray'><code class='font-large'>" . nl2br($value) . "</code></div>");
                    } else {
                        echo ("<div class='Qdescription inner round-edge bg-gray font-large'>" . nl2br($value) . "</div>");
                    }
                } ?>
            </section>
            <section class="panel panel-default" style="background-color: white;">
                <?php
                foreach ($data["Qpicture"] as $key => $value) {
                    echo ("<img class='Qpicture' src = '{$value}'/>");
                } ?>
            </section>
        </section>
        <section class="editor-section">
            <div class="selection-container">
                <div class="form-group">
                    <label for="lang-select">LANGUAGE:</label>
                    <select id="lang-select" onchange="changeLang({'lang':this.value})" class="custom-select">
                        <option value="NONE">NONE</option>
                        <option value="C">C</option>
                        <option value="CPP">CPP</option>
                        <option value="PYTHON">PYTHON</option>
                        <option value="JAVA">JAVA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="theme">THEME:</label>
                    <select id="theme" onchange="changeTheme(this.value)" class="custom-select">
                        <option value="Light">Light Theme</option>
                        <option value="Dark">Dark Theme</option>

                    </select>
                </div>
            </div>
            <div class="editor-container">

                <div id="editor"><?php echo ($_SESSION["code"]) ?></div>


                <div class="checkbox-wrapper">
                    <input type="checkbox" class="custom-input-checkbox"> Test with custom input
                </div>
                <br>
                <div>
                    <button class="btn" onclick="runCode();">Run Code</button>
                </div>
                <br>
                <div class="output-container">
                    <div class="output-area-wrapper">
                        <div hidden></div>
                    </div>
                    <div style="display: none" id="loader"></div>
                </div>
            </div>

            <?php
            $codes = getSubmittedCode($_SESSION["Qid"]);

            if (!empty($codes)) {
                $html = '';
                foreach ($codes as $key => $link) {
                    $sno = $key + 1;
                    $html .= "<tr> <td>$sno </td> <td> <button class='btn' onclick = " . "debugBase64(" . "'$link'" . ")" . " >click here to see code</button> </td> </tr>";
                }
                $table = '
                    <div class="submitted-code-section"> 
                    <table class="table" id="table-id">
                            <thead class="thead-dark">
                                <tr>
                                    <th>SUBMITTED CODE NUMBER</th>
                                    <th>CODE LINK</th>
                                </tr>
                            </thead>
                            <tbody>
                            ' .
                    $html
                    .
                    '</tbody>
                            </table>     </div>';
                echo ($table);
            } else {
                echo ("NO SUBMITTED CODE");
            }
            ?>
        </section>
    </div>

    <script src="../ace-builds/src-noconflict/ace.js" charset="utf-8"></script>
    <script src="../ace-builds/src-noconflict/ext-language_tools.js"></script>

    <script src="editor.js"></script>
    <script src="question.js"></script>
    <?php
    if (isset($_SESSION["code"])) {
        $code = $_SESSION["code"];
        $lang = $_SESSION['lang'];
        echo ('<script> 
                var e = {
                    "lang":' . "'" . $lang . "'" . ',
                    "code":' . "`" . "$code" . "`" . '
                };
                changeLang(e); 
            </script>');
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#table-id').DataTable();
        });
    </script>
    <?php include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\footer\frontend\footer.php');
    ?>
</body>

</html>