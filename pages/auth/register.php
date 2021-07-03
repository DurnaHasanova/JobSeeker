<?php
require "./utils/ValidationFunctions.php";
include "./model/User.php";
$error = "";

if (isset($_POST['email'])
    && isset($_POST['name'])
    && isset($_POST['password'])
    && isset($_POST['confirmPassword'])
    && isset($_POST['userType'])) {
    $result = null;
    $result = isEmailExist($_POST['email']);
    if ($result->code == ReturnCode::EMAIL_IS_EXIST) $error = $EMAIL_IS_EXIST;
    elseif ($_POST['password'] != $_POST['confirmPassword']) $error = $PASSWORD_CONFIRM;
    else {
        $result = validatePassword($_POST["password"]);
        if ($result->code == ReturnCode::PASSWORD_DOES_NOT_MATCH) $error = $PASSWORD_DOES_NOT_MATCH;
        else {
            createuser(new User($_POST["email"], $_POST["name"], $_POST["userType"], $_POST["password"]));
        }
    }

}
?>


<div class="mt-5">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-6">
            <div class="card px-5 py-5">
                <h1 class="m-3 text-center text-muted"><?= $reg_header ?></h1>
                <form method="post">
                    <div class="text-center text-danger"><?= $error ?></div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" required placeholder="<?= $reg_user ?>">
                    </div>
                    <div class="form-group"><input type="text" class="form-control" name="name" required
                                                   placeholder="<?= $reg_name ?>"></div>
                    <div class="form-group"><input type="password" class="form-control" name="password"
                                                   placeholder="<?= $reg_pass ?>"></div>
                    <div class="form-group"><input type="password" class="form-control" name="confirmPassword"
                                                   placeholder="<?= $reg_pass2 ?>"></div>

                    <div class="form-check form-check-inline">
                        <p class="m-3">
                            <input class="form-check-input" type="radio" name="userType"
                                   value="P">
                            <label class="form-check-label"><?= $reg_seeker ?></label>
                        </p>
                        <p class="m-3"><input class="form-check-input " type="radio" name="userType"
                                              value="C">
                            <label class="form-check-label"><?= $reg_emp ?></label></p>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class=" btn btn-primary mt-4" type="submit"><?= $reg_btn ?></button>
                    </div>
                    <div class="text-center mt-4"><span><?= $reg_member ?></span> <a href="?page=login"
                                                                                     class="text-decoration-none"><?= $reg_signin ?></a>

                </form>

            </div>
        </div>
    </div>
</div>