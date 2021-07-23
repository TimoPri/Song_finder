<?php
include_once('functions.php');


if (isset($_POST['get_option'])) {

    $select = $_POST['get_option'];
    $find = getBibleChapterByBook($select);
    while ($row = mysqli_fetch_array($find)) {
        echo "<option>" . $row['chapter'] . ", " . $row['verse'] ."</option>";
    }
    exit;
}

