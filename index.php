<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Demo</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!-- <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">  -->
        <link rel="stylesheet" href="normalize.css"/>
        <link rel="stylesheet" href="candy_style.css"/>
    </head>
    <body>
    

<?php
//////////////////////////////////

    // include('login.php');
    include('workwithfiles.php');
    include('workwithhtml.php');

////////////////////////////////
// SPALVU MASYVAS
    $nicecolor_arr = [
        "#f8c1de", "#bdd67a", "#84d3f2", "#cbc2f7","#f9b77a",
        "#fbe2a0", "#b9db9f", "#66d3b9", "#f9dbdb", "#c1acd3",
        "#fae83e"];

    // specifying directory 
    $mydir = './'; 
    $mydir = getcwd();

    // $mydir = './images'; 
    // print(basename(dirname(__FILE__)));
    // print("<br>");
    // print(basename(dirname(__DIR__)));
    // print("<br>");
    // print(getcwd());
    // print("<br>");  
    // $dir = glob(dirname(__FILE__));
    // $startdir=$dir[0];
    // $mydir = $startdir;
    // print_r("startdir = " . $startdir . "<br>");
    // print("<br>");

    // $mydirs = array_filter(glob('*'), 'is_dir');
    // $mydirs  = array_values($mydirs);
    // print_r ($mydirs);
    // print("<br>");
    
    // $myfiles = array_diff(scandir($mydir), array('..', '.'));
    // $myfiles  = array_values($myfiles);
    // print_r($myfiles);
    // // print("<br>");
    
    // $mydir=$dir[0].DIRECTORY_SEPARATOR.$mydirs[0];
    // print_r("mydir =" . $mydir . "<br>");
    
    // $myfiles = array_diff(scandir($mydir), array('..', '.'));
    // print_r($myfiles);

    // foreach($myfiles as $vnt){
    //     $elem=$mydirs[0].DIRECTORY_SEPARATOR.$vnt;
    //     print_r("elem = " . $elem . "<br>");
    //     if(is_dir($elem)) print("yra folderis");
    // }
    // print("<br>");
    
    // $myfiles = array_diff(scandir($mydir), array('..', '.'));
    // $myfiles = scandir($mydir);
    // $myfiles  = array_values($myfiles);
    // print_r($myfiles);
    // print("<br>");

    // $url = $_SERVER['REQUEST_URI'];
    // print("url = " . $url . "<br>"); //url = /sprintai/01sprintas/index.php

    // $mydir = dirname($_SERVER['PHP_SELF']);
    // print("mydir = " . $mydir); // cia gaunam mydir = /sprintai/01sprintas

    // $myfiles = scandir($mydir, SCANDIR_SORT_NONE); 

    // print('<form class="dir_form" method="POST">');
    // echo('button type="submit" class="candy_jar_dir" name="dir" onclick="');
    // echo("location.href='");
    // echo("?path=" . $mydir. "'");
    // echo('" value="' . $dirname . '">' . $dirname . ' </button></form>');

    //scanning files in a given diretory in unsorted order 
    
    function explore_dir($mydir, $nicecolor_arr){

    // $myfiles = scandir($mydir, SCANDIR_SORT_NONE); 
    // print_r($myfiles);

    $myfiles = array_diff(scandir($mydir), array('..', '.'));
    $myfiles = scandir($mydir);
    $myfiles  = array_values($myfiles);
    // print_r($myfiles);

    //preparing files for the directory   
 
    $filenametype_arr = getfiles_Names_Types($myfiles, $mydir);
    $dir_arr = get_folders($myfiles, $mydir);
    // print_r($dir_arr);
    $typeclr_arr = getcolorfortype(array_values($filenametype_arr), $nicecolor_arr);

    create_allhtml ($filenametype_arr, $dir_arr, $typeclr_arr, $mydir);
    // create_tophtml($typeclr_arr);

    // create_candyhtml('candy.css', $nicecolor_arr[0]);
    if(isset($_POST['filedelete'])) { 
        print ("reikia trinti faila " . $_POST['filedelete']);   
    }
    if(isset($_POST['dir'])) {
        $dirtogo = $_POST['dir'];
        $dirtogo = $mydir.DIRECTORY_SEPARATOR.$dirtogo;
        print ("reikia eiti i " . $dirtogo);
        // print("<a class='file__link' href='?path=$dirtogo'></a>");  
        // explore_dir($dirtogo, $nicecolor_arr); 
    }
    } //end of explore_dir

    explore_dir($mydir, $nicecolor_arr);
    //onclick='href="?path=$dirtogo"'
    //print("<button id='bck'><a href='$previous_dir'>BACK</a></button>");
    // <a href="?path=./images>
    ?>

  </body>  

</html>
