<?php
function create_allhtml ($filenametype_arr, $dir_arr, $typeclr_arr, $currentdir){
    create_tophtml($typeclr_arr);
    create_bottomhtml($filenametype_arr, $dir_arr, $typeclr_arr, $currentdir);   
}

// spausdina viena spalvota failo tipa
function create_one_clrtype($type, $color){
    print ('<button class="type_circle" style="background-color: ');
    print($color . '">' . $type . '</button>');  
}

// spausdina visus spalvotus failu tipus
function create_all_clrtypes ($typeclr_arr) {
    print ('<div class="candy_type">');   
    foreach ($typeclr_arr as $type => $color){
        create_one_clrtype($type, $color);
    }
    print ('</div>');
}
//spausdina direktoriju pridejima
function adddir_buttonhtml(){
    print('
    <div class="plus_dir">
    <form class="plus_dir_form" method="post">
        <button
            type="submit"
            class="plus_dir_button"
            name="plus_directory"
            value="new"
        ></button>
    </form>
</div>
    ');
}
//spausdina virsu
function create_tophtml($typeclr_arr) {
    print('<div class="top">');
    create_all_clrtypes($typeclr_arr);
    print('<div class="right">');
    adddir_buttonhtml();
    print('</div></div>');
}
// spausdina vieno saldainio html pagal duota varda ir spalva
function create_candyhtml($filename, $color){
    print('<div class="candy" style="background-color: ');
    print($color . '">' . $filename);
    print('<div class="candy_shape"></div>');
    // download button
    print('<form class="down_form" method="post">');
    print('<button type="submit" class="download_file_button" ');
    print('name="filedelete" value="');
    print($filename . '"></button></form>');
    // delete button
    print('<div class="candy_shape"></div>');
    print('<form class="delete_form" method="post">');
    print('<button type="submit" class="del_file_button" name="filedelete" value="');
    print($filename . '"></button></form></div>');
}
// spausdina visus saldainius
function createall_candyhtml($filenametype_arr, $typeclr_arr){
    foreach($filenametype_arr as $name => $type){
        $color=find_color_bytype($type, $typeclr_arr );
        create_candyhtml($name, $color);
    }
}
//spausdina vienos direktorijos html
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
//spausdina visu direktoriju html
function create_alldir($dir_arr, $mydir){
    // print_r($dir_arr);
    for ($i=0; $i<count($dir_arr); $i++){
        create_dirhtml($dir_arr[$i], $mydir);
    }
}
//spausdina apacia
function create_bottomhtml($filenametype_arr, $dir_arr, $typeclr_arr, $currentdir){
    print('<div class="candy_jar_top">' . $currentdir . '</div>');
    print('<div class="candy_jar_botom">');
    print('<div class="candies">');
    create_alldir($dir_arr, $currentdir);
    createall_candyhtml($filenametype_arr, $typeclr_arr);
    print('</div></div>');
}

?>