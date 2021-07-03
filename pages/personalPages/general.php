<?php
include '././model/Company.php';
include '././services/CompanyService.php';
print_r($_POST);
$companyService = new CompanyService();
$error = [];
$successResult = "";
$caction = isset($_REQUEST["caction"])?$_REQUEST["caction"]:"insert";

if (isset($_POST['name']) && $_POST["name"] == "") array_push($error, "Company Name can not be null");
if (isset($_POST['webPage']) && $_POST["webPage"] == "") array_push($error, "WebPage can not be null1");
if (isset($_POST['address']) && $_POST["address"] == "") array_push($error, "Company Name can not be null1");
if (isset($_POST['about']) && $_POST["about"] == "") array_push($error, "Company Name can not be null3");
if (isset($_FILES['file']) && $_FILES["file"]['error'][0] == 4  && $caction=='insert') array_push($error, "Company Name can not be null3");
$userId = $_SESSION["userId"];
$buttonText = "";
$activateInput = "";
$company = null;
$showFormButton=false;

if (!empty($companyService->getCompany($userId))) {
    $buttonText = $gen_btn_edit;
    $company = $companyService->getCompany($userId);
    $activateInput = "disabled";
} else {
    $buttonText = $gen_btn_submit;
    $company = new Company();
    $showFormButton=true;
}

switch ($caction) {
    case "insert":
        if (count($error) == 0) {
            $result = $companyService->insert($_FILES, $_POST);
            if ($result->code == ReturnCode::SUCCESS) $successResult = $result->message;
            else array($error, $result->message);
        }
        break;
    case 'edit':
        $buttonText = $gen_btn_update;
        $showFormButton=true;
        $caction='update';
        $activateInput="";
        break;
    case 'update':
        $buttonText = $gen_btn_edit;
        $showFormButton=false;
        $caction='edit';
        $activateInput="";
        $companyService->update($_FILES, $_POST);
        break;

    case 'delete':
        $buttonText = $gen_btn_edit;
        $showFormButton=false;
        $caction='edit';
        break;
    default:
        break;
}
?>

<div class="container-fluid mt-3">
    <div class="h1 text-center">
        <?= $gen_header ?>
    </div>
    <p class="divider"></p>
    <div class="text-danger">
        <ul>
            <?php
            for ($i = 0; $i < count($error); $i++) {
                echo '<li>' . $error[$i] . '</li>';
            }
            ?>
        </ul>
    </div>
    <div class="text-success"><?= $successResult ?></div>
    <div class="container-fluid">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="<?= $gen_companyName ?>"
                       value="<?= $company->name ?>" <?= $activateInput ?> >

            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="webPage" placeholder="<?= $gen_companyEmail ?>"
                       value="<?= $company->webPage ?>" <?= $activateInput ?>>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="address" placeholder="<?= $gen_companyAddress ?>"
                       value="<?= $company->address ?>" <?= $activateInput ?>>
            </div>
            <div class="form-group">


                <textarea id="editor" class="form-control" name="about"   placeholder="<?= $gen_companyAbout ?>"
                          rows="15" <?= $activateInput ?>><?= $company->about ?></textarea>

            </div>
            <?php

            if ($company->image != "") {
                if($caction=='update'){
                    echo '<div class="logo-div">
                        <div class="d-flex justify-content-center">
                    <a href="?caction=delete"><i class="far fa-trash-alt mr-3 text-danger"></i></a>
                    <span onclick="file()" type="button" ><i class="far fa-edit text-primary"></i></span>
                </div>';
                }
                echo '
                <div>
                    <img class="logo-img" src="' . $company->image . '" src="all">
                </div>
                
                 </div>';
            } else {
                echo ' <div class="form-group ">
                <label for="file">' . $gen_companyLogo . '</label>
                
            </div>';
            }
            ?>
            <input hidden value="<?=$userId?>" name="userId">
            <input hidden value="<?=$caction?>" name="caction">
            <input type="file" class="form-control" id="file" name="file[]" hidden>
            <?php
            if($showFormButton){
                echo '
                <div class="mt-5 mb-5 position-relative">
                <button type="submit" class="btn btn-primary btn-block">' . $buttonText .'</button>
            </div>';
            }
            else{
                echo '
                 <div class="mt-5 mb-5 position-relative">
            <a class="btn btn-primary btn-block text-white" href="?caction=edit">'.$buttonText.'</a>
        </div>';
            }

            ?>
        </form>



    </div>


</div>

<script>
    function file() {
        let element = document.getElementById("file");

        element.click();
    }



</script>