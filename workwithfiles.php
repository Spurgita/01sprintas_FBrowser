<?php

//grazina tipo spalva
function find_color_bytype ($typeformatch, $typeclr_arr){
    foreach($typeclr_arr as $type => $clr){
        if ($type == $typeformatch) {
            $color = $clr;
            break;
        }
    }
    return ($color);
}
// grazina reikiamo ilgio spalvu masyva
function prepare_colors_forvalues($niceclrarr, $lenght){
    $clrarr=[];
    if ($lenght>count($niceclrarr)) {
        print("neuztenka graziu spalvu");
        $randomcolor="#ec1c5a";
        array_push($clrarr, $randomcolor);  
        // TODO parasyti papildomu spalvu generacijos funkcija
    } else
    for ($i=0; $i<$lenght; $i++) {
        array_push($clrarr, $niceclrarr[$i]);
    }
    return($clrarr);
}

// grazina assoc. failu masyva vardas => tipas
function getfiles_Names_Types($myfiles, $mydir){  
    // print_r ($mydir); 
    $file_arr=[];
    $arrkeys = [];
    $arrvalues = [];    
    foreach($myfiles as $vnt) {
        $elem = $mydir.DIRECTORY_SEPARATOR.$vnt;
        // print ("vnt= " . $elem . "<br>");
        if(is_file($elem)) {
            $txt = pathinfo($elem, PATHINFO_FILENAME);
            // print (" txt = " . $txt);
            // array_push($arrkeys, $txt); //tik failo vardas
            array_push($arrkeys, $elem);
            $ext = pathinfo($elem, PATHINFO_EXTENSION);
            array_push($arrvalues, $ext);        
        } 
    }
    // print_r ($arrkeys); 
    $file_arr = array_combine($arrkeys, $arrvalues);
    // print_r ($file_arr); 
    return ($file_arr);
}
// grazina folderiu masyva
function get_folders($myfiles, $mypath){
    $dirArr = [];
    foreach($myfiles as $vnt) {
        $elem = $mypath.DIRECTORY_SEPARATOR. $vnt;
        // print("elem=" . $elem . "<br>");
        if(is_dir($elem)) array_push($dirArr, $vnt);   
    }     
    // print_r($dirArr);
    return ($dirArr);
}

// grazina assoc masyva tipas => spalva
function getcolorfortype($arr, $color_arr){
    $typearr = [];
    $clrarr = [];
    $typeclr_arr = [];
    $typearr = array_unique($arr);
    $clrarr = prepare_colors_forvalues($color_arr, count($typearr));
    $typeclr_arr = array_combine($typearr, $clrarr);
    return($typeclr_arr);
}

//failo atsisiuntimas

function file_download($file){

    $fileToDownloadEscaped = str_replace("&nbsp;", " ", htmlentities($file, null, 'utf-8'));
    ob_clean();
    ob_start();
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf'); // mime type → ši forma turėtų veikti daugumai failų, su šiuo mime type. Jei neveiktų reiktų daryti sudėtingesnę logiką
    header('Content-Disposition: attachment; filename=' . basename($fileToDownloadEscaped));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fileToDownloadEscaped)); // kiek baitų browseriui laukti, jei 0 - failas neveiks nors bus sukurtas
    ob_end_flush();
    readfile($fileToDownloadEscaped);
    
    exit; 
}

?>