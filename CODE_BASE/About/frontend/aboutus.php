<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\Database_Scripts\DBconnector.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="aboutus.css">
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
        <?php
        if (isset($_SESSION["Username"])) {
        ?>
            <button onclick="location.href =' <?php echo (LINK::PROFILE); ?>'" class=" btn btn-light profile-btn">
                <?php
                echo ($_SESSION["Username"]);
                ?>
            </button>
        <?php
        }
        ?>
    </nav>

    <div class="mid-container">
        <div class="card" style="width: 30rem;">
            <img class="card-img-top" src=<?php
                                            echo (ASSESTS::CODINGGIF);
                                            ?> alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">CODE BASE</h5>
                <p class="card-text">Sample text, There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
            </div>
            <ul class="list-group list-group-flush">

                <li class="list-group-item"><a class="card-link" href=" https://www.annauniv.edu/">Want to know more about Anna University ?</a></a></li>
                <li class="list-group-item"><a class="card-link" href="https://www.aukdc.edu.in/">AUKDC</a></a></li>
            </ul>

        </div>
        <div class="mid-content ">
            <div class="center">
                <h1> PROGRESS THROUGH KNOWLEDGE</h1>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Morbi aliquet hendrerit nisi eu bibendum. Vestibulum ultricies sagittis lorem, at lobortis dui.
                    Vivamus maximus rutrum nulla, quis tempus dolor venenatis eu. Sed mollis imperdiet sem, a tempor nibh efficitur vel.
                    Suspendisse tempor ante ipsum, vel fringilla nulla vulputate eu. Proin ultrices tincidunt urna eu hendrerit.
                    Ut eu neque convallis, congue arcu ac, tincidunt leo. Nullam efficitur tristique imperdiet.
                    Proin sit amet ullamcorper felis, ut rhoncus diam. Aliquam dignissim purus vitae dolor scelerisque ultricies. Duis efficitur orci vitae euismod ultricies.
                    Curabitur quis dui ullamcorper, dignissim augue vitae, aliquam massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Ut eu neque convallis, congue arcu ac, tincidunt leo. Nullam
                </p>
            </div>
        </div>
    </div>




    <?php include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\footer\frontend\footer.php');
    ?>
    <!-- Optional JavaScript -->
    <script src="aboutus.css"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>