<?php

$lang = (isset($_GET["lang"]) && is_numeric($_GET["lang"])) ? $_GET["lang"] : 0;
$sql = "select * from language where status=true and id=" . $lang;
$result = mysqli_query($connection, $sql);
$pageCode="";
if (mysqli_num_rows($result) > 0) {
    setcookie("lang", $lang);
} elseif (isset($_COOKIE["lang"])) $lang = $_COOKIE["lang"];
else { $lang = 1;}

if (isset($_GET["page"])) {
    setcookie("page", $_GET["page"]);
    $page=$_GET["page"];
} elseif (isset($_COOKIE["page"])) $page = $_COOKIE["page"];
else $page = "home";


if (isset($_SESSION["userType"])) {
    if (isset($_GET["pageCode"])) {
        setcookie("pageCode", $_GET["pageCode"]);
    }
    elseif (isset($_COOKIE["pageCode"])){
        $pageCode = $_COOKIE["pageCode"];}
    else {
        if ($_SESSION["userType"] == 'P') $pageCode = 'apply';
        if ($_SESSION["userType"] == 'C') $pageCode = 'vacs';

    }
}



$dictionary = 'lang/aze.php';
if ($lang == 1) $dictionary = 'lang/aze.php';
elseif ($lang == 2) $dictionary = 'lang/eng.php';
elseif ($lang == 3) $dictionary = 'lang/rus.php';


