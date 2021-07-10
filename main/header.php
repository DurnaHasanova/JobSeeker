<?php

$sql = "select short from language where id=" . $lang;
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);
$short = $row[0];
$user = (isset($_SESSION["userName"])) ? $_SESSION["userName"] : "";

?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="./index.php?page=home"><div class="img-div"></div></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= strtoupper($short) ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                        $sql = "select id, short from language where status=true and short <>'.$short'";
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo ' <a class="dropdown-item" href="./index.php?lang=' . $row["id"] . '">' . strtoupper($row["short"]) . '</a>';

                        }
                        ?>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <?php
                $sql = "select id,`page`, `name` from menu where `status`=true and langId=$lang order by orderNo asc";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $active = ($page == $row['page'] ? 'active' : '');
                    echo ' <li class="nav-item ' . $active . '">
                <a class="nav-link" href="./index.php?&page=' . $row["page"] . '">' . $row["name"] . ' <span class="sr-only">(current)</span></a>
            </li>';
                }
                ?>
            </ul>
            <?php
            if ($user != "") {

                echo '<a class="btn btn-sm btn-link m-2 my-sm-0 text-light" role="button" href="?page=personal">'. $user.' </a>';
                echo '<a class="btn btn-sm btn-link m-2 my-sm-0 text-light" role="button" href="pages/auth/logout.php" >'. $btn_logout.' </a>';
            }
            else {

                echo '<a class="btn btn-sm btn-link m-2 my-sm-0 text-light" role="button" href="?page=login" >'. $btn_login.' </a>'.
                       '<a class="btn btn-sm btn-link m-2 my-sm-0 text-light" role="button" href="?page=register">'. $btn_register .'</a>';
            }
            ?>

        </div>
    </nav>
</header>
<main id="main" >


