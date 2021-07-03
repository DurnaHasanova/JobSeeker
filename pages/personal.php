<?php
$userType=$_SESSION["userType"];
$view=isset($_GET["pageCode"])?$_GET["pageCode"]:$pageCode;
?>

    <div class="row">
        <div class="col-lg-3">
         <div class="sidebar">
             <?php
             include "././main/sidebar.php";
             ?>
         </div>
        </div>
        <div class="col-lg-9">
            <?php
            $file="pages/personalPages/$view.php";
            if(file_exists($file)) include $file;
            else include "././pageNotFound.php";
            ?>
        </div>
    </div>

