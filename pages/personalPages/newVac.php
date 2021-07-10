<?php
include '././model/Vacancy.php';
include '././services/VacancyService.php';
$error = [];
$successResult = "";
$userId = $_SESSION["userId"];
if (isset($_POST["minSalary"]) && isset($_POST["maxSalary"])) {

    if ($_POST["minSalary"] == 0 or $_POST["maxSalary"] == 0) array_push($error, "Min or Max salary can not be zero");
    if ($_POST["minSalary"] > $_POST["maxSalary"]) array_push($error, "Minimum salary can not be greater than maximum salary");
}
if (isset($_POST['description']) && $_POST["description"] == "") array_push($error, "Description can not be empty");
if (isset($_POST['skills']) && $_POST["skills"] == "") array_push($error, "Skills can not be empty");

if (!empty($_POST) && count($error) == 0) {
    $vacancyService = new VacancyService();
    $result = $vacancyService->insert($_POST);
    if ($result->code == ReturnCode::SUCCESS) $successResult = $result->message;
    else array($error, $result->message);
}
// TODO Class yaradilmaldir. DB table yaradilmalidir Insert edilmelidir
// TODO inputlara minimum simvo sayi qoymaq
?>


<div class="container my-5 d-flex justify-content-center">

    <p class="h3"><?= $newVacHeader ?></p>
</div>

<div class="container">
    <div class="text-danger">
        <ul>
            <?php
            for ($i = 0; $i < count($error); $i++) {
                echo '<li>' . $error[$i] . '</li>';
            }
            ?>
        </ul>
    </div>
    <div class="text-success mb-3"><?= $successResult ?></div>
    <form method="post" id="vacancy">
        <div class="form-group">
            <select class="form-control" id="position" name="categoryId"
                    oninvalid="this.setCustomValidity('<?= $newVacSelectError ?>')"
                    oninput="this.setCustomValidity('')">
                <option value=""><?= $newVacSelect ?></option>
            </select>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="jobTitle" required placeholder="<?= $newVacJobTitle ?>"
                   oninvalid="this.setCustomValidity('<?= $newVacJobTitleError ?>')"
                   oninput="this.setCustomValidity('')">
        </div>

        <div class="row mb-3">
            <div class="col">
                <input type="number" class="form-control" name="minSalary" placeholder="<?= $newVacMinSalary ?>" min="0"
                       required
                       oninvalid="this.setCustomValidity('<?= $newVacMinSalaryError ?>')"
                       oninput="this.setCustomValidity('')">
            </div>
            <div class="col">
                <input type="number" class="form-control" name="maxSalary" placeholder="<?= $newVacMaxSalary ?>" min="0"
                       required
                       oninvalid="this.setCustomValidity('<?= $newVacMaxSalaryError ?>')"
                       oninput="this.setCustomValidity('')">
            </div>
        </div>

        <div class="form-group">
                <textarea id="description" class="form-control" name="description"
                          oninvalid="this.setCustomValidity('<?= $newVacJobDescError ?>')"
                          oninput="this.setCustomValidity('')" placeholder="<?= $newVacJobDesc ?>"
                ></textarea>
        </div>


        <div class="form-group">
                <textarea id="requirement" class="form-control" name="skills"
                          oninvalid="this.setCustomValidity('<?= $newVacJobSkillsError ?>')"
                          oninput="this.setCustomValidity('')" placeholder="<?= $newVacJobSkills ?>"
                ></textarea>
        </div>


        <div class="form-group">
            <div class='input-group date' id='datetimepicker1'>
                <span class="input-group-addon">
                            <i class="fas fa-calendar-week fa-2x mr-1"></i>
            </span>
                <input type='text' name='expireDate' class="form-control" require placeholder="<?= $newVacExpDate ?>"
                       oninvalid="this.setCustomValidity('<?= $newVacExpDateError ?>')"
                       oninput="this.setCustomValidity('')"/>
            </div>
        </div>
        <input hidden value="<?= $userId ?>" name="userId">
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block"><?= $newVacButton ?></button>
        </div>
</div>

</form>
</div>

<script>
    $(function () {
        $('#datetimepicker1').datetimepicker({format: 'MM/DD/YYYY', minDate: new Date()});
    });

    $.get("json/position.php",
        function (data, statuse) {

            let pos = JSON.parse(data);
            for (let i = 0; i < pos.length; i++) {

                $("#position").append(new Option(pos[i].name, pos[i].id));
            }
        }
    )


</script>
