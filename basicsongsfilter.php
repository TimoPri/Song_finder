<?php
  include_once('header.php');
  include_once('functions.php');

if(filter_has_var(INPUT_POST, 'submit-contact')){
    //print_r($_POST);die;
    $filterdata = filter($_POST);
    if($fehler=="")$Allgood=true;
}
 ?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CSS Hamburger Animation</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

    <div class="container" style="margin-top: 30px;">
        <div class="row" >
            <div class="col-md-8 col-md-offset-2">
                <h2>Lieder</h2>
                <font size="3">Es werden aus rechtlichen Gründen keine Noten angezeigt.<br> Um auf Notensätze zugreifen zu können müssen Sie sich Anmelden </font>
                <form class="form" action="basicsongs.php" method="post">
                <div class="menu-wrap">
                    <!-- <input type="checkbox" class="toggler"> -->
                    <div class="hamburger"><div></div></div>
                    <div class="menu">
                        <div>
                            <div>
                                <ul>
                                    <div class="form-group">
                                        <?php $query = getThemes();?>
                                        <label for="songCol">Thema: </label>
                                        <select name="theme">
                                            <option value="NOTHEME">  -  </option>
                                            <?php while($data=mysqli_fetch_array($query)){ ?>
                                                <option value=" <?php echo $data['theme']; ?> ">
                                                    <?php echo $data['theme']; ?>
                                                </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <?php $query = getSongCol();?>
                                        <label for="songCol">Liedersammlung: </label>
                                        <select name="songCol">
                                            <option value="NOCOLLECTION">  -  </option>
                                            <?php while($data=mysqli_fetch_array($query)){?>
                                                <option value="<?php echo $data['song_col']; ?>">
                                                    <?php echo $data['title']; ?>
                                                </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary btn-lg mt-3" type="submit" name="submit-contact">Filtern</button>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                </form>
            </div>


                <br><br>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <td>Nr</td>
                            <td>Titel</td>
                            <td>Bibelstellen</td>
                            <td>Themen</td>
                				</tr>
                    </thead>

                    <tbody>
                      <?php
                      $query = getSongs();
                      while($data=mysqli_fetch_array($query)){
                      ?>
                      <tr>
                          <td><?php echo $data['song_col']," ", $data['song_nr']?></td>
                          <td><?php echo $data['title']?></td>
                          <td><?php echo $data['bible_ref_list']?></td>
                          <td><?php echo $data['themelist']?></td>
                      </tr>
                          <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>

</body>
