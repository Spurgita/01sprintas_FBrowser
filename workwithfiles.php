<?php
function printArray($arr){
    print($arr[0]);
    for ($i=1; $i<count($arr); $i++){
        print(", " . $arr[$i]);
    }
    print (".");
}

function print_asoc_array($arr){
    foreach ($arr as $key =>$val) print( $key . ' ' . $val . "\n");
    print ("<br>");  
}

function print_multi_asoc_array($arr){
    for ($i=0; $i<count($arr); $i++) {
        $keys = array_keys($arr[$i]);   
        for($j=0; $j < count($keys); $j++) {
          print( $keys[$j] . ' ' . $arr[$i][$keys[$j]] . "\n");
        }
        print ("<br>");
    }
      
}
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
            array_push($arrkeys, $txt);
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
function get_folders($myfiles, $mydir){
    $dirArr = [];
    foreach($myfiles as $vnt) {
        // $elem = $mydir.DIRECTORY_SEPARATOR.$vnt;
        if(is_dir($vnt)) array_push($dirArr, $vnt);   
    }     
    array_splice($dirArr, 0, 2); // reiktu patikrinti ar taskai
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



?>
