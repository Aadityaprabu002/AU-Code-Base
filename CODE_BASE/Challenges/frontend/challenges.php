<?php
include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\Challenges\backend\challenges.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>CHALLENGE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="challenges.css">
</head>

<body class="">
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

  <section id="topic-selection" class="section section-job-list gradient-light--lean-left">
    <div class="container ">
      <div class="row row-grid justify-content-center">
        <div class="col-md-8 col-lg-7 col-xl-6 text-center">
          <h2 class="section__title mb-4 top-heading">CHALLENGES</h2>
        </div>
        <div class="col-md-10">
          <!-- <form class="filter-form mt-5 mb-4">
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="form-group">
                  <label for="topic">TOPIC:</label>
                  <select id="topic" class="custom-select">
                    <option value="1">ALL</option>
                    <option value="2">DATA STRUCTURES</option>
                    <option value="3">ALOGRITHMS</option>
                    <option value="4">PROBLEM SOLVING</option>
                    <option value="5">MATH O CODE</option>
                    <option value="6">LEARN C</option>
                    <option value="7">LEARN C++</option>
                    <option value="8">LEARN JAVA</option>
                    <option value="9">LEARN PYTHON</option>
                  </select>
                </div>
              </div>
            </div>
          </form> -->
          <div class="job-list__wrapper mb-6">
            <?php
            foreach ($Q_list as $key => $val) {
              echo (getQ_CARD($val[0], $val[1], $val[2], calPoints($val[3])));
            }
            ?>
          </div>
        </div>

      </div>
    </div>
  </section>
  <?php include('C:\xampp\htdocs\AU_CODING_PLATFORM\CODE_BASE\footer\frontend\footer.php');
  ?>
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>

</html>