<?php
  include_once('header2.php');
  include_once('functions.php');

    $song = getSongById($_GET['id']);
    $usage = getUsagebySongId($_GET['id']);
    $col = $song['song_col'];

    if(filter_has_var(INPUT_POST, 'submit-contactDate')){
        //print_r($_POST);die;
        updateDate($_POST, $song['song_id']);
        if($fehler=="")$Allgood=true;
    }
    if(filter_has_var(INPUT_POST, 'submit-contactUsage')){
        //print_r($_POST);die;
        updateUsage($_POST, $song['song_id']);
        if($fehler=="")$Allgood=true;
    }
    if(filter_has_var(INPUT_POST, 'submit-contactUpload')){
       // print_r($_FILES['songpdf']['name']);  print_r($_FILES['songpdf']['size']); print_r($_FILES['songpdf']['tmp_name']);print_r("           "); print_r($_FILES['songpdf']['error']); die;

        uploadpdf($_POST ,$song['song_id'],$col);
       // if($fehler=="")$Allgood=true;
    }
?>

<!doctype html>
<html lang="en">
  <body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <h1><?php echo $song['title']?></h1>
        </div>


            <td><?php echo "Nummer: ", $song['song_col']," ", $song['song_nr'], " " ?></td>
             <td><?php if($song['song_nr_ext'] != '-') echo $song['song_nr_ext']?></td>
            <td><?php if($song['title_orig'] != '')echo "<br />Original titel: ", $song['title_orig']?></td>
            <td><?php if($song['name_lyrics'] != '')echo "<br />Text: ", $song['name_lyrics']?></td>
            <td><?php if($song['name_music'] != '')echo "<br />Melodie: ", $song['name_music']?></td>
            <td><?php if($song['year_cre'] != '')echo "<br />Jahr: ", $song['year_cre']?></td>
            <td><?php if($song['rightsholder'] != '')echo "<br />Rechteinhaber: ", $song['rightsholder']?></td>
            <td><?php if($song['dirigent'] != '')echo "<br />Dirigent: ", $song['dirigent']?></td>
            <td><?php if($song['date_review'] != '')echo "<br />Letztes Überprüfungsdatum: ", $song['date_review']?></td>
            <td><?php if($usage['date_usage'] != '')echo "<br />Letztes Verwendungsdatum: ", $usage['date_usage']?></td>

        <table class="table table-bordered">
            <td>
            <form class="form" action="songdetails.php?id=<?php echo  $song['song_id']?>" method="post">
            <div class="form-group">
                <label for="review">Prüfungsdatum updaten:</label>
                <input type="date" id="review" name="review"
                       value="2021-01-01"
                       min="2021-01-01" max="2030-12-31">
                <br>
                <button class="btn btn-primary btn-sm mt-1" id="popup" type="submit" name="submit-contactDate">Update</button>
            </div>
            </form>
            </td>
        </table>

        <table class="table table-bordered">
        <td>
        <form class="form" action="songdetails.php?id=<?php echo  $song['song_id']?>" method="post">
            <div class="form-group1">
                <label for="review">Letzte Nutzung updaten: </label>
                <input type="date" id="usage" name="usage"
                       value="2021-01-01"
                       min="2021-01-01" max="2030-12-31">
            </div>
            <div class="form-group1">

                            <label for="main">Verwendet in Hauptveranstaltung? </label>
                            <select name="main">
                                <option value=1>Ja</option>
                                <option value=0>Nein</option>
                            </select>

            <br>
                <button class="btn btn-primary btn-sm mt-1" id="popup1" type="submit" name="submit-contactUsage">Update</button>

            </div>

        </form>
        </td>
        </table>

        <table class="table table-bordered">
            <td>
        <form class="form" action="songdetails.php?id=<?php echo  $song['song_id']?>" method="post" enctype="multipart/form-data">
            <div class="form-group2">
                <label for="songpdf">Noten hochladen (PDF)</label>
                <br>
                <label for="songpdf">PDF</label>
                <input name="songpdf" type="file" />  <!-- accept="application/pdf" -->
            </div>

            <div class="form-group2">
                    <label for="sheetstyle">Art</label>
                    <select name="sheetstyle">
                        <option value=A>Akkorde</option>
                        <option value=M>Melodie</option>
                        <option value=S>Mehrstimmig</option>
                        <option value=K>Klavier</option>
                    </select>
                <br>

                <button class="btn btn-primary btn-sm mt-1" id="popup1" type="submit" name="submit-contactUpload">Hochladen</button>

            </div>

        </form>
            </td>
        </table>

            <td><?php if($song['lyrics'] != '')echo "<br />Lyrics: <br />", $song['lyrics']?></td>

        </tr>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.js"></script>
        <script src="form-validation.js"></script></body>
</html>
