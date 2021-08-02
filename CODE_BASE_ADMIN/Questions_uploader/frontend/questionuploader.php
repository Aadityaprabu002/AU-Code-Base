<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE_ADMIN\Questions_uploader\backend\questionuploader.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question uploader</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="questionuploader.css">
    <link rel="stylesheet" href=<?php echo (ASSESTS::BADGES_CSS); ?>>
</head>

<body>

    <center><img src=<?php echo (ASSESTS::LOGO); ?> width="100"></a></center>
    <h1 align="center">QUESTION FORM</h1>
    <form id="Qform" method="POST" action="" enctype="multipart/form-data">
        <div class="err_status">
            <?php
            if (isset($response)) {
                print_r($response);
            }
            ?>

        </div>
        <div class="container">
            <section>
                <h3><label for="Qname">Enter the name of the question:</label></h3>
                <input type="text" name="Qname" id="Qname">

            </section>

            <section>
                <h3><label for="Qlevel">Enter the difficulty level:</label></h3>
                <select id="Qlevel" name="Qlevel">
                    <option value="1">EASY</option>
                    <option value="2">MEDIUM</option>
                    <option value="3">HARD</option>
                </select>
            </section>
            <section>
                <h3><label for="Qdescription">Enter the question:</label></h3>
                <div class="desp-list">
                    <p>Description #1</p>
                    <textarea name="Qdescription[]" id="Qdescription" cols="30" rows="10"></textarea>
                </div>
                <button class="btn btn-success" type='button' onclick="addDesp();">add description</button>
                <button class="btn btn-danger" type='button' onclick="deleteDesp();">delete description</button>
            </section>
            <section>
                <h3> Insert pictures here:
                    <div class="pic-list"></div>
                </h3>
                <button class="btn btn-success" type='button' onclick="addPic();">add picture</button>
                <button class="btn btn-danger" type='button' onclick="deletePic();">delete picture</button>
            </section>
            <section>
                <h3> Click and press enter to select awards:</h3>
                <div class="award-options">
                    <?php
                    $badge_list = getBadgeArray();
                    for ($badge = 0; $badge < count($badge_list); $badge++) {
                        $html = getBadge($badge_list[$badge]);
                        echo ($html);
                    }
                    ?>
                </div>
                <input type="text" name="Qaward" id="Qaward" readonly hidden>
                <div class="selected-awards"></div>
                <button class="btn btn-success" type='button' onclick="clearAll();">clear</button>
            </section>
            <section>
                <h3> Enter testcases:</h3>
                <div class="test-cases">
                </div>
                <button class="btn btn-success" type='button' onclick="addCase();">add case</button>
                <button class="btn btn-danger" type='button' onclick="deleteCase();">delete case</button>
            </section>
            <section>
                <input class="btn btn-success" type="button" value="submit question" onclick="validate();">
                <input class="btn btn-danger" type="reset" value="reset">
            </section>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="questionuploader.js"></script>
</body>

</html>