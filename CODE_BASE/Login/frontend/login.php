<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\Login\backend\login.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="login.css">
    <title>Log in</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href=<?php echo (LINK::HOMEPAGE); ?>><img src=<?php
                                                                                echo (ASSESTS::LOGO);
                                                                                ?> width="60"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto text-uppercase">
                <li class="nav-item ">
                    <a class="nav-link active" aria-current="page" href=<?php echo (LINK::HOMEPAGE); ?>>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href=<?php echo (LINK::ABOUTUS); ?>>About</a>
                </li>

                <li class="nav-item" id="signup">
                    <a class="nav-link active" aria-current="page" href=<?php echo (LINK::SIGNUP); ?>>Sign up</a>
                </li>
                <li class="nav-item" id="login">
                    <a class="nav-link active" aria-current="page" href=<?php echo (LINK::LOGIN); ?>>Log in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href=<?php echo (LINK::LEADERBOARD); ?>>Leader board</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" target="_blank" href=<?php echo (LINK::BADGECHART); ?>>Badge chart</a>
                </li>
        </div>
    </nav>
    <br><br><br>
    <div class="login-container">
        <div> <a href=<?php echo (LINK::HOMEPAGE); ?>>
                <img class="logo" src=<?php echo (ASSESTS::LOGO); ?> />
            </a></div>
        <div id="log-in" class="log-in">
            <div class="inner-login-container">
                <div class="text-center" style="color:maroon;font-size:25px">Account Login</div>
                <br>
                <center> <span id="err-output"></span> </center>
                <div class="form-group">
                    <label for="user-email">Email address:</label>
                    <div class="input-group">
                        <input type="text" class="form-control input-lg" id="user-email" autocomplete="email" name="email">
                    </div>
                    <span id="email-err"></span>
                </div>

                <div class="form-group">
                    <label for="user-name">Password:</label>
                    <div class="input-group">

                        <input type="password" class="form-control input-lg" id="user-pwd" name="current-password" autocomplete="current-password">
                    </div>
                    <span id="password-err"></span>
                </div>

                <div class="switch-container">
                    <input name="rem" value="1" id="remember-me-switch" class="switch" type="checkbox" checked data-toggle="toggle" data-size="mini" data-onstyle="danger" data-style="slow">
                    <label for="remember-me-switch">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remember me</label>
                </div>

                <br>
                <input type="button" onclick="validateForm();" class="btn btn-danger login-btn" value="Login">
            </div>
            <span id="login-err"></span>
        </div>


        <div class="divider-box">
            <button onclick=" window.open('http://localhost/AU_CODING_PLATFORM/CODE_BASE/Sign%20up/frontend/signup.php','_self');" type="submit" class="btn btn-danger sign-btn">Sign up</button>

        </div>
    </div>

    <script src="login.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <br><br><br><br>
    <?php include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\footer\frontend\footer.php');
    ?>
    <?php
    if (isset($_COOKIE["email"]) and isset($_COOKIE["pass"])) {

        echo ('
            <script>
                document.getElementById("user-email").value =' . "'" . $_COOKIE["email"] . "'" . ';
                document.getElementById("user-pwd").value =' . "'" . $_COOKIE["pass"] . "'" . ';
            </script>');
    }
    ?>
</body>

</html>