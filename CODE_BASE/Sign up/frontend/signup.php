<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\Sign up\backend\signup.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Sign up</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="signup.css" />
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
  <section>
    <div class="signup-container">
      <form id="sign-up" action='' method="POST">
        <div class="form-group">
          <label for="fname">First name*</label>
          <input name="fname" type="text" class="form-control form-control-inline" id="fname" placeholder="Enter your Name" maxlength="25" />
          <!-- <small id="hint-name" class="form-text text-muted"></small> -->
        </div>
        <div class="form-group">
          <label for="name">Last name*</label>
          <input name="lname" type="text" class="form-control form-control-inline" id="lname" placeholder="Enter your Name" maxlength="25" />
          <small id="hint-name" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label for="email">Email address*</label>
          <input name="email" type="email" class="form-control" id="email" aria-describedby="email" placeholder="Enter personal email" autocomplete="email" maxlength="50" />
          <small id="hint-email" class="form-text text-muted">
            We'll never share your email with anyone else.
          </small>
        </div>
        <div class="form-group">
          <label for="user-name">Username*</label>
          <input name="user-name" type="text" class="form-control" id="username" aria-describedby="name" placeholder="Enter username" maxlength="30" />
          <small id="hint-username" class="form-text text-muted">Try to be unique, this will be your codebase handle</small>
        </div>Userbio
        <div class="form-group">
          <textarea name="user-bio" id="bio" style="width:100%"></textarea>
          <small id="hint-bio" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label for="github">Github Link</label>
          <input value="" name="github" type="text" class="form-control" id="github" aria-describedby="name" placeholder="Enter Github link" maxlength="70" />
          <small id="hint-github" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label for="twitter">Twitter Link</label>
          <input value="" name="twitter" type="text" class="form-control" id="twitter" aria-describedby="name" placeholder="Enter Twitter link" maxlength="70" />
          <small id="hint-twitter" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
          <label for="new-password">Password*</label>
          <input onkeyup="checkStrength();" name="new-password" type="password" class="form-control" id="new-password" aria-describedby="new-password" autocomplete="new-password" placeholder="New Password" />
          <small id="hint-new-password" class="form-text text-muted">Tip: Use special Characters, Numbers and Different cases</small>
        </div>

        <div class="form-group">
          <label for="confirm-password">Confirm password*</label>
          <input onkeyup="isPasswordMatching();" name="confirm-password" type="password" class="form-control" id="confirm-password" aria-describedby="current-password" placeholder="Confirm Password" autocomplete="new-password" />
          <small id="hint-confirm-password" class="form-text text-muted" value=""></small>
        </div>
        <center>
          <input type="button" onclick="validateForm();" class="btn btn-danger signup-btn" value="Sign up" />
        </center>
        <input type="text" style="display: none" name="case" value="3" />
      </form>
    </div>
  </section>
  <br><br><br>
  <?php include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\footer\frontend\footer.php');
  ?>
  <script src="signup.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>