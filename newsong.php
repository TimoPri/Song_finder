<?php


include_once('functions.php');


include_once('header2.php');


$Allgood=false;


if(filter_has_var(INPUT_POST, 'submit-contact')){
      //print_r($_POST);die;
      addSong($_POST);
      if($fehler=="")$Allgood=true;
}
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

    <body class="text-center">
      <div class="container">
        <div class="py-5 text-center">
    <form class="form-signin" novalidate action="newsong.php" method="POST">
      <div class="form-group">
      <img class="mb-4" src="download2.png" alt="" width="150" height="150">
      <h2>Lied hinzufügen </h2>

      <font size="5"><?php if ($Allgood==true){echo "Lied wurde hinzugefügt!";?></font>
      <a class="btn btn-lg btn-primary btn-block" type="button" name="hompage" href="detailedsongs.php">Zur Startseite</a>
      <font size="5"><?php }else{if(isset($fehler)){echo $fehler; ?> </font>
      <?php }}?>
      </form>

            <!--   <form class="form" action="newsong.php" method="post">    -->
<form class="form" action="newsong.php" method="post" name ="songform" onsubmit="required()">

    <div class="form-group">
        <input type="hidden" class="form-control"  id="themecountid" name="themecount" value="0">
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control"  id="biblecountid" name="biblecount" value="0">
    </div>


    <div class="form-group">
      <input type="text" class="form-control" placeholder="Titel *" id="title" name="title">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Original Titel *" id="orig_title" name="orig_title">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Originaler Texter *" id="orig_lyrics" name="orig_lyrics">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Texter *" id="lyrics" name="lyrics">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Musiker *" id="music" name="music">
    </div>

    <div class="form-group">
        <input type="number" class="form-control" placeholder="Jahr (YYYY) *" id="jahr" name="jahr">
    </div>

    <div class="form-group">
      <input type="text" class="form-control" placeholder="Rechteinhaber *" id="rightsholder" name="rightsholder">
    </div>

    <div class="form-group">
      <input type="text" class="form-control" placeholder="Dirigent *" id="dirigent" name="dirigent">
    </div>

    <div class="form-group">
        <input type="number" class="form-control" placeholder="CCLI Nummer (1111111) *" id="ccli" name="ccli">
    </div>

    <div class="form-group">
        <table class="table table-bordered" id="suitabilitytable">
            <td align="left">
                <label for="suitability">Geeignet für: </label>
                <select name="suitability">
                    <option value="G">Gemeinsamer Gesang</option>
                    <option value="V">Vortragslied</option>
                </select>
            </td>
        </table>
    </div>

    <div class="form-group">
        <table class="table table-bordered" id="lyrics_oktable">
            <td align="left">
              <label for="lyrics_ok">Lyrics geprüft? </label>
                <select name="lyrics_ok">
                    <option value=1>Ja</option>
                    <option value=0>Nein</option>
                </select>
            </td>
        </table>
    </div>

    <div class="form-group">
        <table class="table table-bordered" id="rights_oktable">
            <td align="left">
                <label for="rights_ok">Rechte geprüft? </label>
                <select name="rights_ok">
                    <option value=1>Ja</option>
                    <option value=0>Nein</option>
                </select>
            </td>
        </table>
    </div>

    <div class="form-group">
        <table class="table table-bordered" id="activetable">
            <td align="left">
                <label for="review">Prüfungsdatum:</label>
                <input type="date" id="review" name="review"
                    value="2021-01-01"
                    min="2021-01-01" max="2030-12-31">
            </td>
        </table>
    </div>

    <div class="form-group">
        <table class="table table-bordered" id="activetable">
            <td align="left">
                <label for="active">Aktiv? </label>
                <select name="active">
                    <option value=1>Ja</option>
                    <option value=0>Nein</option>
                </select>
            </td>
        </table>
    </div>

    <div class="form-group">
        <table class="table table-bordered" id="songcoltable">
            <?php $query = getSongCol();?>
            <td align="left">
                <label for="songCol">Liedersammlung: *</label>
                <select name="songCol">
                    <?php while($data=mysqli_fetch_array($query)){?>
                        <option value="<?php echo $data['song_col']; ?>">
                            <?php echo $data['title']; ?>
                        </option>
                    <?php }?>
                </select>
            </td>
        </table>
    </div>



    <!-- Themen auswahl-->


    <div class="form-group" id="themesid">
    <table class="table table-bordered" id="dynamic_field">
        <tr>
            <td align="left" colspan="2">Thema</td>
        <tr>
            <td>
                <?php $query = getThemes();?>
                <select name="categories1">
                    <?php while($data=mysqli_fetch_array($query)){
                        ?>
                        <option value="<?php echo $data['theme']; ?>">
                            <?php echo $data['theme']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td>
               <button type="button" name="add" id="add" class="btn btn-success">Weitere</button>
            </td>
        </tr>
    </table>
    </div>
    <script>
        $(document).ready(function(){
            var i =1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id ="row'+i+'"><td><select name="categories'+i+'">  <?php $query = getThemes(); while($data = mysqli_fetch_array($query)){?><option><?php echo $data["theme"]; ?></option><?php }?>  </select></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">Entfernen</button></td> </tr>');
                $("#themecountid").val(i);
            });
            $(document).on('click','.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
                if(i > 1)i--;
                $("#themecountid").val(i);
            });
        });
    </script>


    <!-- Bibelstellen auswahl-->

    <div class="form-group" id="booksid">
            <table class="table table-bordered" id="dynamic_field2">
                <tr>
                    <td align="left" colspan="2">Bibelstellen</td>
                </tr>
                <tr>
                    <td> <label for="book">Buch:</label> </td>
                    <td> <label for="chapter">Kapitel:</label> </td>
                    <td> <label for="verse">Vers:</label> </td>
                    <td> <button type="button" name="add" id="add2" class="btn btn-success">Bibelstelle hinzufügen</button> </td>
                </tr>
            </table>
    </div>

    <script>
        $(document).ready(function(){
            var j =1000000;
            $('#add2').click(function(){
                j++;
                $('#dynamic_field2').append('<tr id ="row2'+j+'"><td><select name="book'+j+'" style="width: 250px;"><?php $query = getBibleBook();?><?php while($data=mysqli_fetch_array($query)){?><option><?php echo $data["book_title"]; ?></option><?php }?></select></td><td><select name="chapter'+j+'" style="width: 250px;"><?php $query = getBibleChapter();?><?php while($data=mysqli_fetch_array($query)){?><option><?php echo $data["chapter"]; ?></option><?php }?></select></td> <td><select name="verse'+j+'" style="width: 250px;"><?php $query = getBibleVerse();?><?php while($data=mysqli_fetch_array($query)){?><option><?php echo $data["verse"]; ?></option><?php }?></select></td> <td><button name="remove" id="'+j+'" class="btn btn-danger btn_remove">Entfernen</button></td> </tr>');
                $("#biblecountid").val(j);
            });
            $(document).on('click','.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row2'+button_id+'').remove();
                if(j > 1000000)j--;
                $("#biblecountid").val(j);
            });
        });
    </script>


    <br />
    <button class="btn btn-primary btn-lg mt-3" type="submit" name="submit-contact" value = "Submit">Abschicken</button>
    <br> <br>
    <a type="button" class="btn btn-sm btn-outline-secondary" href="detailedsongs.php" >Abbrechen</a>

    <script>
        function required() {
            var empt = document.forms["songform"]["title"].value;
            var empt1 = document.forms["songform"]["orig_title"].value;
            var empt2 = document.forms["songform"]["orig_lyrics"].value;
            var empt3 = document.forms["songform"]["lyrics"].value;
            var empt4 = document.forms["songform"]["music"].value;
            var empt5 = document.forms["songform"]["jahr"].value;
            var empt6 = document.forms["songform"]["rightsholder"].value;
            var empt7 = document.forms["songform"]["dirigent"].value;
            var empt8 = document.forms["songform"]["ccli"].value;
            if (empt == "" || empt1 == "" || empt2 == "" || empt3 == "" || empt4 == "" || empt5 == "" || empt6 == "" || empt7 == "" || empt8 == "") {
                alert("Bitte alle Pflichtfelder ausfüllen");
                return false;
            } else {
                return true;
            }
        }
    </script>




    <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>

    </body>
