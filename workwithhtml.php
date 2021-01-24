<?php
//sukuria viska

use function PHPSTORM_META\map;

function create_allhtml ($filenametype_arr, $dir_arr, $typeclr_arr, $pathtogo){
    create_tophtml($typeclr_arr,$pathtogo);
    create_bottomhtml($filenametype_arr, $dir_arr, $typeclr_arr, $pathtogo);   
}

// sukuria viena spalvota failo tipa
function create_one_clrtype($type, $color){
    print ('<button class="type_circle" style="background-color: ');
    print($color . '">' . $type . '</button>');  
}

// sukuria visus spalvotus failu tipus
function create_all_clrtypes ($typeclr_arr) {
    print ('<div class="candy_type">');   
    foreach ($typeclr_arr as $type => $color){
        create_one_clrtype($type, $color);
    }
    print ('</div>');
}
//sukuria direktoriju pridejima
function adddir_buttonhtml($pathtogo){
    print('<div class="plus_dir"><form');
    print(' class="plus_dir_form" method="post">
    <input type="text" class="plus_dir_name" name="plus_dir"
    onfocus="this.placeholder=');
    print("''");
    print('"');
    print('placeholder="New folder name" value=""/>');
    print('<button type="submit" class="plus_dir_button" name="plus_directory" value="new">');
    print("<a href='");
    print("?path=" . $pathtogo. "'>");
    print('</a></button></form></div>');
}
//sukuria virsu
function create_tophtml($typeclr_arr, $pathtogo) {
    print('<div class="top">');
    create_all_clrtypes($typeclr_arr);
    print('<div class="right">');
    adddir_buttonhtml($pathtogo);
    print('</div></div>');
}
// sukuria vieno saldainio html pagal duota varda ir spalva
function create_candyhtml($filename, $color){
    $onlyname = pathinfo($filename, PATHINFO_FILENAME);
    print('<div class="candy" style="background-color: ');
    print($color . '">' . $onlyname);
    print('<div class="candy_shape"></div>');
    // download button
    print('<form class="down_form" method="post">');
    print('<button type="submit" class="download_file_button" ');
    print('name="filedownload" value="');
    print($filename . '"></button></form>');
    // delete button
    print('<div class="candy_shape"></div>');
    print('<form class="delete_form" method="post">');
    print('<button type="submit" class="del_file_button" name="filedelete" value="');
    print($filename . '"></button></form></div>');
}
// sukuria visus saldainius
function createall_candyhtml($filenametype_arr, $typeclr_arr){
    foreach($filenametype_arr as $name => $type){
        $color=find_color_bytype($type, $typeclr_arr );
        create_candyhtml($name, $color);
    }
}
//sukuria vienos direktorijos html
function create_dirhtml($dirname, $mydir){
    $pathtogo = $mydir.DIRECTORY_SEPARATOR.$dirname;
    // print("pathtogo = " . $pathtogo);
    print('<form class="dir_form" method="POST">');
    print(' <button type="submit" class="candy_jar_dir" name="dir"');
    print('" value="' . $dirname . '">');
    print("<a href='");
    print("?path=" . $pathtogo. "'>");
    print($dirname . '</a></button></form>');
}
//sukuria visu direktoriju html
function create_alldir($dir_arr, $mydir){
    // print_r($dir_arr);
    for ($i=0; $i<count($dir_arr); $i++){
        create_dirhtml($dir_arr[$i], $mydir);
    }
}
//sukuria BACK html
function create_backpath($currentpath){
    $pathseparated = explode(DIRECTORY_SEPARATOR, $currentpath);
    array_pop($pathseparated);
    $backpath = implode(DIRECTORY_SEPARATOR, $pathseparated);
    return ($backpath);
}

//sukuria apacia
function create_bottomhtml($filenametype_arr, $dir_arr, $typeclr_arr, $currentdir){
    print('<div class="candy_jar_top">');
    // Failo upload
    print(' <div class="candy_jar_top_left">
    <form action="" method="POST" enctype="multipart/form-data">
			<input type="file" name="file">
			<input id="submit" type="submit" name="submitBtn" value="Upload">		
		</form></div>');
    $currentdir_name = $currentdir;
    if ($currentdir_name == "./")  $currentdir_name="HERE YOU ARE";
    else $currentdir_name = strtoupper(str_replace( array("./"), '', $currentdir));  
    print('<div class="candy_jar_top_center">' . $currentdir_name ); 
    print('<div> Click here to <a href = "index.php?action=logout"> logout.</div> </div>');   
    print('<div class="candy_jar_top_right">');
    if ($currentdir_name !="START") {//ideti BACK mygtuka
        $pathtogo = create_backpath($currentdir);
        print('<form class="back_form" method="post">');
        print('<button type="submit" class="back_dir" name="back" value="">');  
        print("<a href='");
        print("?path=" . $pathtogo. "'>");
        print('BACK</a></button></form>');
    }       
    print('</div></div>');
    print('</div><div class="candy_jar_botom">');
    print('<div class="candies">');
    create_alldir($dir_arr, $currentdir);
    createall_candyhtml($filenametype_arr, $typeclr_arr);
    print('</div></div>');
}

?>