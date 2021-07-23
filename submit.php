<?php
include_once('functions.php');

function processDrpdown($selectedVal) {

    $find = getBibleChapterByBook($selectedVal);

    while($row=mysqli_fetch_array($find))
    {
        echo $row['chapter'],";";
    }

    exit;
}

if ($_POST['dropdownValue']){
    //call the function or execute the code
    processDrpdown($_POST['dropdownValue']);
}


/*
if(isset($_POST['get_option']))
{
    print_r($_POST['get_option']);
    $select = $_POST['get_option'];
    $find = getBibleChapterByBook($select);
    print_r($find);
    while($row=mysqli_fetch_array($find))
    {
        echo "<option>".$row['chapter']."</option>";
    }
    exit;
}
*/