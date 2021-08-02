<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\leaderboard\backend\leaderboard.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>LEADER BOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="leaderboard.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark text-uppercase">
        <a class="navbar-brand" href=<?php echo (LINK::HOMEPAGE); ?>><img src=<?php
                                                                                echo (ASSESTS::LOGO);
                                                                                ?> width="60"></a>
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
                echo ($user);
                ?>
            </button>

        </div>
    </nav>
    <div class="container">
        <section class="panel">
            <br>
            <header class="panel-heading">
                <div class="top-container">
                    <h2 class="text-center" style="color:maroon">LEADER BOARD</h2>
                </div>
            </header>

            <table class="table p-table" id="table_id">
                <thead class="thead-dark">
                    <tr>
                        <th>Rank</th>
                        <th>Username</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $record = getRankList();
                    $rank = 1;
                    $record[0][2] = $rank;
                    for ($i = 1; $i < count($record); $i++) {
                        if ($record[$i - 1][1] != $record[$i][1]) {
                            $rank++;
                        }
                        $record[$i][2] = $rank;
                    }
                    foreach ($record as $key => $value) {
                        $link = LINK::PROFILE . "?Username=" . urlencode($value[0]);
                        $html = '
                        <tr class="clickable-row" data-href="' . $link . '">
                            <td>' . $value[2] . '</td>
                            <td>' . $value[0] . '</td>
                            <td>' . $value[1] . '</td>
                        </tr>
                        ';
                        echo ($html);
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

    <script src="leaderboard.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
        $(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.open($(this).data("href"), '_blank');
            });
        });
    </script>
    <br><br><br><br><br>
    <?php include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\footer\frontend\footer.php');
    ?>
</body>

</html>