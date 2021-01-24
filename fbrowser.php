<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Demo</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">  -->
    <link rel="stylesheet" href="normalize.css" />
    <link rel="stylesheet" href="candy_style.css" />
</head>

<body>


    <?php
    //////////////////////////////////

    include('workwithfiles.php');
    include('workwithhtml.php');

    ////////////////////////////////
    // SPALVU MASYVAS
    $nicecolor_arr = [
        "#f8c1de", "#bdd67a", "#84d3f2", "#f9b77a", "#cbc2f7",
        "#fbe2a0", "#b9db9f", "#66d3b9", "#f9dbdb", "#c1acd3",
        "#fae83e"
    ];


    session_start();

    // logout logic
    if (isset($_GET['action']) and $_GET['action'] == 'logout') {
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['logged_in']);
        print('Logged out!');
    }

    $mypath = $_GET['path'];
    if ($mypath == "") $mypath = "./" . $_GET['path'];

    $myfiles = array_diff(scandir($mypath), array('..', '.'));
    $myfiles  = array_values($myfiles);
    // print_r($myfiles);

    //preparing files for the directory   

    $filenametype_arr = getfiles_Names_Types($myfiles, $mypath);
    $dir_arr = get_folders($myfiles, $mypath);
    // print_r($dir_arr);
    $typeclr_arr = getcolorfortype(array_values($filenametype_arr), $nicecolor_arr);

    // create HTML 
    create_allhtml($filenametype_arr, $dir_arr, $typeclr_arr, $mypath);

    // Naujo folderio sukūrimas

    if (isset($_POST['plus_directory']) & isset($_POST['plus_dir'])) {
        // print(" paspaustas + ir ivesta " . $_POST['plus_dir'] . "<br>");
        $newdirname = strtolower($_POST['plus_dir']);
        $newdirpath = $mypath . $newdirname;
        // print("newdirpath =" . $newdirpath . "<br>");
        $poz = false;
        if (in_array($newdirname, $dir_arr)) {
            print("jau yra");
        } else {
            mkdir($newdirpath);
            array_push($dir_arr, $newdirname);
        }
        echo '<script> location.replace("fbrowser.php"); </script>';
        // header("Refresh:1");
    }
    // Failo delete
    if (isset($_POST['filedelete'])) {
        $filename = $_POST['filedelete'];
        // print("trinti faila " . $filename);
        if (file_exists($filename)) {
            unlink($filename);
        }
        header("Refresh:1");
    }


    // Failo upload
    require_once 'upload.php';



    // Failo download

    if (isset($_POST['filedownload'])) {
        $filename = $_POST['filedownload'];
        // file_download($filename);
        $fileToDownloadEscaped = str_replace("&nbsp;", " ", htmlentities($filename, null, 'utf-8'));
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

</body>

</html>