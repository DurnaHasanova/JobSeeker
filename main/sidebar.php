<?php

$userType = $_SESSION["userType"];
$sql = "select * from user_menu where userType='$userType' and status=true and langId=$lang order by orderNo asc";
$result = $connection->query($sql);

?>

<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">

    <ul class="nav nav-pills flex-column mb-auto ">

        <?php
        while ($row = $result->fetch_assoc()) {
            //print_r($row);
            $active=($view==$row["pageCode"])?"active":"";
            echo '
                     <li class="nav-item">
                    <a href="?pageCode='.$row["pageCode"].'" class="nav-link text-white '.$active.' " aria-current="page">
                <i class="'.$row["iconClassName"].' mr-3"></i><span>'
             .$row["menu"].
            '</span></a>
        </li>
                ';
        }
        ?>

    </ul>
    <hr>
</div>