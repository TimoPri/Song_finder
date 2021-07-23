<?php
  include_once('header.php');
  include_once('functions.php');

 $song = getSongById($_GET['id']);
 $sheet = getSheetById($song['song_id']);
 ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Checkout example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">Contact</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">Follow on Twitter</a></li>
            <li><a href="#" class="text-white">Like on Facebook</a></li>
            <li><a href="#" class="text-white">Email me</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
      <a href="#" class="navbar-brand d-flex align-items-center">
      </a>
      </button>
    </div>
  </div>
</header>
    <div class="container">
  <div class="py-5 text-center">
    <h1><?php echo $song['title']?></h1>
  </div>

        <tr>
            <td><?php echo  $sheet['song_col_source'] ?></td>
            <td><?php echo  $sheet['song_nr_source'] ?></td>
            <td><?php echo  $sheet['song_nr_ext_source'] ?></td>
            <td><?php echo  $sheet['cons_nr'] ?></td>
            <td><?php echo  $sheet['name_arr'] ?></td>
            <td><?php echo  $sheet['rightsholder_arr'] ?></td>
            <td><?php echo  $sheet['active'] ?></td>
            <td><?php echo  $sheet['type_cont'] ?></td>
            <td><?php
                $result = getSheet($sheet['song_id']);"<br>";
                while ($row = mysqli_fetch_array($result)) {
                    echo $row['t1'];
                }
                ?></td>

        </tr>



</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="form-validation.js"></script></body>
</html>
<?php
  include_once('footer.php')
 ?>
