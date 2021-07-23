<?php


  include_once('header2.php');
  include_once('functions.php');

/*
  if (!isset($_SESSION['login_roles']) || isset($_SESSION['login_roles']) && !in_array(58, $_SESSION['login_roles'])) {

    echo 'Bitte anmelden!';

    exit;

  }
*/


    if(filter_has_var(INPUT_POST, 'submit-contact')){
    //print_r($_POST); //die;
    $filterdata = filterSong($_POST);
    if($fehler=="")$Allgood=true;
}
?>

<body class="bg-light">

    <div class="container" style="margin-top: 30px;">
        <div class="row" >
                <table class="table">
                    <td class="bTop" colspan="3"><h2>Lieder</h2><td>
                    <td class="bBottom" colspan="3"><a type="button" class="btn btn-success" style="float: right;" href="newsong.php">Neues Lied hinzufügen</a></td>
                </table>


                <table class="table table-bordered">
                    <td>
                    <form class="form" action="detailedsongs.php" method="post">
                    <div class="menu-wrap">
                        <!--     <input type="checkbox" class="toggler"> -->
                        <div class="hamburger"><div></div></div>
                        <div class="menu">
                            <div>
                                <div>
                                        <ul>
                                        <div class="form-group">
                                            <input type="text" id="search" placeholder="Search.." class="form-control"  name="search" value = "<?php if(!empty($filterdata)){ echo $_POST["search"];}?>">
                                        </div>

                                        <div class="form-group">
                                            <?php $query = getThemes();?>
                                            <label for="songCol">Thema: </label>
                                            <select name="theme">
                                                <option value="NOTHEME">  -  </option>
                                                <?php while($data=mysqli_fetch_array($query)){ ?>
                                                    <option value="<?php echo $data['theme']; ?>" <?php if(!empty($filterdata) && $data['theme'] == $_POST["theme"]) echo "selected"; ?>>
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
                                                    <option value="<?php echo $data['song_col']; ?>" <?php if(!empty($filterdata) && $data['song_col'] == $_POST["songCol"]) echo "selected"; ?>>
                                                        <?php echo $data['title']; ?>
                                                    </option>
                                                <?php }?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <script type="text/javascript" >
                                                function fetch_select(val)
                                                {
                                                    $.ajax({
                                                        type: 'post',
                                                        url: 'fetch_data.php',
                                                        data: {
                                                            get_option:val
                                                        },
                                                        success: function (response) {
                                                            document.getElementById("chapterandverse").innerHTML=response;
                                                        }
                                                    });
                                                }
                                            </script>

                                            <div id="select_box">
                                                <label for="book">Buch: </label>
                                                <select name="book" onchange="fetch_select(this.value);">
                                                    <option value="NOBOOK" selected>  -  </option>
                                                    <?php
                                                    $select=getBibleBook();
                                                    while($row=mysqli_fetch_array($select))
                                                    {
                                                        echo "<option>".$row['book_title']."</option>";
                                                    }
                                                    ?>
                                                </select>

                                                <?php $default_state = 'NOBOOK';?>
                                                <script type='text/javascript'>

                                                    $(document).ready(function(){
                                                        $("#state option:contains(" + '<?php echo $default_state?>' + ")").attr('selected', 'selected');
                                                    });
                                                </script>


                                                <label for="chapterandverse">Kapitel, Vers: </label>
                                                <select id="chapterandverse" name="chapterandverse">
                                                </select>
                                            </div>

                                        </div>

                                        <button class="btn btn-primary btn-lg mt-3" type="submit" name="submit-contact">Filtern</button>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </td>
                </table>


                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <td>Nr</td>
                            <td>Titel</td>
                            <td>Bibelstellen</td>
                            <td>Themen</td>
                            <td>Details</td>
                            <td>Noten</td>


                				</tr>
                    </thead>

                    <tbody>
                      <?php
                      if(!empty($filterdata)){
                      while($data=mysqli_fetch_array($filterdata)){
                      ?>
                      <tr>
                          <td><?php echo $data['song_col']," ", $data['song_nr'] ?>
                              <?php  if($data['song_nr_ext'] != '-') echo $data['song_nr_ext']?>
                          </td>
                          <td><?php echo $data['title']?></td>
                          <td><?php echo $data['bible_ref_list']?></td>
                          <td><?php echo $data['themelist']?></td>


                        <td><a name="P_ID" type="button" class="btn btn-sm btn-outline-secondary" href="songdetails.php?id=<?php echo  $data['song_id']?>">Info</a></td>

                          <td><?php
                              $result = getSheet($data['song_id']);"<br>";
                              while ($row = mysqli_fetch_array($result)) {
                                  echo $row['t1'];
                              }
                              ?>
                          </td>

                          <?php /*       <td><a name="P_ID" type="button" class="btn btn-sm btn-outline-secondary" href="notes.php?id=<?php echo  $data['song_id']?>">Noten</a></td> */ ?>

                      </tr>
                          <?php }}else{}?>
                    </tbody>

                </table>
            </div>


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="js/dataTables.bootstrap.min.js" type="text/javascript"></script>

</body>
