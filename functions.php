<?php
function getConnection() {

  $mysqlhost="ramily.familyds.org:3307";    // MySQL-Host angeben
  $mysqluser="trp";                         // MySQL-User angeben
  $mysqlpwd="xxx";                          // Passwort angeben
  $mysqldb="songdata_trp";                  // Gewuenschte Datenbank angeben


  $connection=mysqli_connect($mysqlhost, $mysqluser, $mysqlpwd, $mysqldb)
    or die("DB Connection ERROR!");
  return $connection;
}


function getSongs(){
  $con = getConnection();
  $sql = "SELECT so.song_id AS ssid,so.*, f_bible_ref_list(so.song_id) AS bible_ref_list, f_themes_list(so.song_id) AS themelist
          FROM songs AS so";
  $query = mysqli_query($con,$sql);
  return $query;
}

function getSongsbyCol($col){
    $con = getConnection();
    $sql = "SELECT so.song_id AS ssid,so.*, f_bible_ref_list(so.song_id) AS bible_ref_list, f_themes_list(so.song_id) AS themelist
          FROM songs AS so WHERE so.song_col = '$col'";
    $query = mysqli_query($con,$sql);
    return $query;
}

function getlyrics($id){
    $con = getConnection();
    $sql = "SELECT blck_content AS lyrics FROM lyrics WHERE song_id = $id";
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_array($query);
    return $data;
}

function getlyricstxt($id){
    $con = getConnection();
    $sql = "SELECT f_get_lyrics_txt_from_song_id($id) AS lyrics";
    $query = mysqli_query($con,$sql);
    return $query;
}

function getsongdata($id){
    $con = getConnection();
    $sql = "SELECT f_get_song_data_from_song_id(lyrics.song_id) AS songdata FROM songs";
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_array($query);
    return $data;
}

function getSongById($id){
    $con = getConnection();
    $sql = "SELECT *, f_get_lyrics_txt_from_song_id($id) AS lyrics FROM songs WHERE song_id = $id";
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_array($query);
    return $data;
}

function getSheetById($id){
    $con = getConnection();
    $sql = "SELECT * FROM sheets WHERE song_id = $id";
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_array($query);
    return $data;
}

function getThemes(){
    $con = getConnection();
    $sql = "SELECT DISTINCT theme
          FROM themes
          ORDER BY theme ASC";
    $query = mysqli_query($con,$sql);
    return $query;
}

function getBibleBook(){
    $con = getConnection();
    $sql = "SELECT DISTINCT book_title
          FROM bible_book_sort
          ORDER BY sort_nr ASC";
    $query = mysqli_query($con,$sql);
    return $query;
}

function getBibleChapterByBook($book){
    $con = getConnection();
    $sql = "SELECT DISTINCT chapter, verse
          FROM bible_references
          WHERE book_title = '$book'
          ORDER BY chapter ASC";
    $query = mysqli_query($con,$sql);
    return $query;
}

function getVerseByBookAndChapter($book, $chapter){
    $con = getConnection();
    $sql = "SELECT DISTINCT verse
          FROM bible_references
          WHERE book_title = '$book'
          AND chapter = '$chapter'
          ORDER BY verse ASC";
    $query = mysqli_query($con,$sql);
    return $query;
}

function getBibleChapter(){
    $con = getConnection();
    $sql = "SELECT DISTINCT chapter
          FROM bible_references
          ORDER BY chapter ASC";
    $query = mysqli_query($con,$sql);
    return $query;
}

function getBibleVerse(){
    $con = getConnection();
    $sql = "SELECT DISTINCT verse
          FROM bible_references
          ORDER BY verse ASC";
    $query = mysqli_query($con,$sql);
    return $query;
}

function getSongCol(){
    $con = getConnection();
    $sql = "SELECT title, song_col
          FROM collections
          WHERE song_col != 'AAA'";
    $query = mysqli_query($con,$sql);
    return $query;
}

function getSheet($id){
    $con = getConnection();
    $sql = "SELECT f_sheet_list_inc_links($id) as t1";
    $query = mysqli_query($con,$sql);
    return $query;
}

function updateDate($data, $id){
    $con = getConnection();
    $date = $data['review'];
    $sql = "UPDATE songs SET date_review = '$date' WHERE song_id = '$id'";
    $query = mysqli_query($con,$sql);
    global $fehler;
    $fehler = mysqli_error($con);
    return $query;
}

function updateUsage($data, $id){
    $con = getConnection();
    $date = $data['usage'];
    $main = $data['main'];
    $s_id = "SELECT song_id
          FROM usages
          WHERE song_id = '$id'";
    $result = mysqli_query($con, $s_id);
    $rs = mysqli_fetch_array($result);
    $song = getSongById($id);
    if($rs == '') {
        $sql = "INSERT INTO usages VALUES ('".$song["song_col"]."','".$song["song_nr"]."','".$song["song_nr_ext"]."','".$id."','".$date."','".$main."')";
    }else{
        $sql = "UPDATE usages SET date_usage = '$date', main_serv = $main WHERE song_id = '$id'";
    }
    $query = mysqli_query($con,$sql);
    global $fehler;
    $fehler = mysqli_error($con);
    return $query;
}

function getUsagebySongId($id){
    $con = getConnection();
    $sql = "SELECT date_usage
          FROM usages
          WHERE song_id = '$id'";
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_array($query);
    return $data;
}


function addSong($data){
    //echo json_encode($data);
    $con = getConnection();
    $s_col = $data['songCol'];

    $s_nr = "SELECT max(song_nr) +1 AS max
          FROM songs
          WHERE song_col = '$s_col'";
    $result = mysqli_query($con, $s_nr);
    $rs = mysqli_fetch_array($result);
    $s_nr1 = $rs['max'];

    $id = "SELECT DISTINCT f_get_song_id_from_col_nr_ext('$s_col', '$s_nr1','-' ) as t1
          FROM sheets";
    $result1 = mysqli_query($con, $id);
    $rs1 = mysqli_fetch_array($result1);
    $id1 = $rs1['t1'];

    $titel = $data['title'];
    $orig_title = $data['orig_title'];
    $og_lyrics = $data['orig_lyrics'];
    $lyrics = $data['lyrics'];
    $name_music = $data['music'];
    $year = $data['jahr'];
    $rights = $data['rightsholder'];
    $dir = $data['dirigent'];

    $ccli = $data['ccli'];
    $suitability = $data['suitability'];
    $lyrics_ok = $data['lyrics_ok'];
    $rights_ok = $data['rights_ok'];
    $review = $data['review'];
    $active = $data['active'];

    if ($titel == "" || $orig_title == "" || $og_lyrics == "" || $lyrics == "" || $name_music == "" || $year == "" || $rights == "" || $dir == "" || $ccli == "") {
        $sql = "SELECT song_id FROM songs WHERE song_id NOT IN (SELECT song_id FROM songs)";
        $error = 1;
    }else{
        $sql = "INSERT INTO songs VALUES ('".$s_col."','".$s_nr1."','-','".$id1."','".$orig_title."','".$titel."','".$og_lyrics."',
                                        '".$lyrics."','".$name_music."','".$year."','".$rights."','".$dir."','".$suitability."',
                                        '".$lyrics_ok."','".$rights_ok."','".$review."','".$ccli."','11111','11111111','".$active."')";
        $error = 0;
    }

    $anzthe = $data['themecount'];
    addTheme($data, $anzthe);
    $anzbib = $data['biblecount'];
    addBible($data, $anzbib);

    $query = mysqli_query($con,$sql);
    global $fehler;
    if($error = 0) {
        $fehler = mysqli_error($con);
    }else{
        $fehler = "";
    }
    return $query;
}

function addTheme($data, $j){
    for ($i = 1; $i <= $j; $i++) {
        addTheme1($data, $i);
    }
}

function addBible($data, $j){
    for ($i = 1000001; $i <= $j; $i++) {
        addBible1($data, $i);
    }
}

function addTheme1($data, $i){
    $con = getConnection();
    $s_col = $data['songCol'];

    $s_nr = "SELECT max(song_nr) +1 AS max
          FROM songs
          WHERE song_col = '$s_col'";
    $result = mysqli_query($con, $s_nr);
    $rs = mysqli_fetch_array($result);
    $s_nr1 = $rs['max'];

    $id = "SELECT DISTINCT f_get_song_id_from_col_nr_ext('$s_col', '$s_nr1','-' ) as t1
          FROM sheets";
    $result1 = mysqli_query($con, $id);
    $rs1 = mysqli_fetch_array($result1);
    $id1 = $rs1['t1'];

    $theme = $data["categories$i"];
    $sql = "INSERT INTO themes VALUES('".$s_col."','".$s_nr1."','-','".$id1."','$i','".$theme."')" ;
    //echo $sql;

    $query = mysqli_query($con,$sql);
    global $fehler;
    $fehler = mysqli_error($con);
    return $query;

}


function addBible1($data, $i){
    $con = getConnection();
    $s_col = $data['songCol'];

    $s_nr = "SELECT max(song_nr) +1 AS max
          FROM songs
          WHERE song_col = '$s_col'";
    $result = mysqli_query($con, $s_nr);
    $rs = mysqli_fetch_array($result);
    $s_nr1 = $rs['max'];

    $id = "SELECT DISTINCT f_get_song_id_from_col_nr_ext('$s_col', '$s_nr1','-' ) as t1
          FROM sheets";
    $result1 = mysqli_query($con, $id);
    $rs1 = mysqli_fetch_array($result1);
    $id1 = $rs1['t1'];

    $book = $data["book$i"];
    $chapter = $data["chapter$i"];
    $verse = $data["verse$i"];

    $temp = $i-1000000;
    $sql = "INSERT INTO bible_references VALUES('".$s_col."','".$s_nr1."','-','".$id1."','$temp','".$book."','".$chapter."','".$verse."','')" ;
    //echo $sql;

    $query = mysqli_query($con,$sql);
    global $fehler;
    $fehler = mysqli_error($con);
    return $query;
}

function getSongsByTheme($id){
    $con = getConnection();
    $sql = "SELECT * FROM themes WHERE theme = '$id'";
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_array($query);
    return $data;
}

function getSongsByCollection($id){
    $con = getConnection();
    $sql = "SELECT * FROM themes WHERE theme = '$id'";
    $query = mysqli_query($con,$sql);
    $data = mysqli_fetch_array($query);
    return $data;
}

function getBooksNotInDb($book)
{
    $con = getConnection();
    $sql = "SELECT DISTINCT book_title
            FROM bible_book_sort
            WHERE book_title NOT IN (SELECT DISTINCT book_title FROM bible_references)";
    $query = mysqli_query($con, $sql);
    //$data = mysqli_fetch_array($query);
    $temp = 0;

    while ($row = mysqli_fetch_array($query)) {
        If ($book == $row['book_title']) $temp = 1;
    }
    if ($temp == 1){
        return true;
    }else{
        return false;
    }
}


function filterSong($data){
    $con = getConnection();
    $theme = $data["theme"];
    $collection = $data["songCol"];
    $book = $data["book"];
    $search = $data["search"];

    if($theme == 'NOTHEME'){
        $sqlthemeid = "SELECT song_id FROM songs";
        $sqlthemeresult = getSongs();
    }else{
        $sqlthemeselection = "SELECT song_id FROM themes WHERE theme = '$theme'";
        $sqlthemeid = "SELECT song_id FROM songs AS so WHERE song_id IN($sqlthemeselection)";
        $sqlthemeresult =  "SELECT so.song_id AS ssid, so.*, f_bible_ref_list(so.song_id) AS bible_ref_list, f_themes_list(so.song_id) AS themelist 
                            FROM songs AS so 
                            WHERE song_id IN($sqlthemeselection)";
    }

    if($collection == 'NOCOLLECTION'){
        $sqlcollectionid = "SELECT song_id FROM songs AS s1 WHERE s1.song_id IN ($sqlthemeid)";
        $sqlnocollectionresult = $sqlthemeresult;
    }else{
        $sqlcollectionid = "SELECT song_id FROM songs AS s1 WHERE song_col = '$collection' AND s1.song_id IN ($sqlthemeid)";
        $sqlnocollectionresult =   "SELECT s1.song_id AS ssid, s1.*, f_bible_ref_list(s1.song_id) AS bible_ref_list, f_themes_list(s1.song_id) AS themelist 
                                    FROM songs AS s1
                                    WHERE song_col = '$collection' AND s1.song_id IN ($sqlthemeid)";
    }

    if($book == 'NOBOOK'){
        $sqlbookresult = $sqlnocollectionresult;
        $sqlbookid = "SELECT song_id FROM songs AS so WHERE song_id IN ($sqlcollectionid)";
    }else{
        if(getBooksNotInDb($book)) {
            $chapter = 'NOCHAPTER';
        }else{
            $chapter = $data["chapterandverse"];
        }
        $sqlbookselection = "SELECT song_id FROM bible_references WHERE book_title = '$book' AND chapter = '$chapter'";
        $sqlbookid = "SELECT song_id FROM songs AS so WHERE song_id IN ($sqlbookselection) AND s1.song_id IN ($sqlcollectionid)";
        $sqlbookresult =   "SELECT s1.song_id AS ssid,s1.*, f_bible_ref_list(s1.song_id) AS bible_ref_list, f_themes_list(s1.song_id) AS themelist 
                            FROM songs AS s1 WHERE song_id IN ($sqlbookselection) AND s1.song_id IN ($sqlcollectionid)";
    }

    if($search == ''){
        $sqlsearchresult = $sqlbookresult;
    }else{
        $temp = "SELECT song_id FROM lyrics WHERE blck_content LIKE '%$search%'";
        $sqlsearchresult = "SELECT s1.song_id AS ssid,s1.*, f_bible_ref_list(s1.song_id) AS bible_ref_list, f_themes_list(s1.song_id) AS themelist 
                            FROM songs AS s1 
                            WHERE  s1.song_id IN ($sqlbookid) AND title LIKE '%$search%' OR s1.song_id IN ($temp) AND s1.song_id IN ($sqlbookid)";
    }

   // print_r($sqlsearchresult);
    if($theme == 'NOTHEME' && $collection == 'NOCOLLECTION' && $book == 'NOBOOK' && $search == ''){
        $query = $sqlthemeresult;
    }else{
        $query = mysqli_query($con,$sqlsearchresult);
    }

    global $fehler;
    $fehler = mysqli_error($con);
    return $query;
}


function uploadpdf($data,$id, $col){
    $song = getSongById($id);
    $con = getConnection();
    $sheetstyle = $data["sheetstyle"];
    $tfilename = $_FILES['songpdf']['tmp_name'];
    $pfilename = $sheetstyle.'_'.$col.'_'.$song["song_nr"];

    $ext = pathinfo($_FILES["songpdf"]["name"], PATHINFO_EXTENSION);
    $uploadDir = __DIR__ . '/../downloads/chor/ns-pdf';
    print_r($tfilename);
    print_r($uploadDir.'/'.$pfilename);
    move_uploaded_file($tfilename, $uploadDir.'/'.$pfilename.'.'.$ext);

    print_r(move_uploaded_file($tfilename, $uploadDir));
    print_r($tfilename);
    print_r($uploadDir);

    $sql = "INSERT INTO sheets VALUES ('".$song["song_col"]."','".$song["song_nr"]."','".$song["song_nr_ext"]."','".$song["song_id"]."','".$sheetstyle."','1','unbekannt','unbekannt','JLB','".$song["song_nr"]."','-','1')";
    //print_r($sql);
    $query = mysqli_query($con,$sql);
    global $fehler;
    $fehler = mysqli_error($con);
    return $query;
}


