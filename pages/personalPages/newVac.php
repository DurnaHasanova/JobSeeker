<?php

print_r($_POST);
?>

<div class="container my-5 d-flex justify-content-center">

    <p class="h3">Add new vacancy</p>
</div>

<div class="container">
    <form method="post">
        <div class="form-group">
            <select class="form-control" id="position" name="position"
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
                <textarea id="requirement" class="form-control" name="requirements"
                          oninvalid="this.setCustomValidity('<?= $newVacJobSkillsError ?>')"
                          oninput="this.setCustomValidity('')" placeholder="<?= $newVacJobSkills ?>"
                ></textarea>
        </div>


        <div class="form-group">
            <div class='input-group date' id='datetimepicker1'>
                <span class="input-group-addon">
                            <i class="fas fa-calendar-week fa-2x mr-1"></i>
            </span>
                <input type='text' name='exp' class="form-control"/>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Add</button>
        </div>
</div>

</form>
</div>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({format: 'DD/MM/YYYY', minDate: new Date()});

    });
</script>
<script>


    $.get("json/position.php",
        function (data, statuse) {
            let pos = JSON.parse(data);
            for (let i = 0; i < pos.length; i++) {

                $("#position").append(new Option(pos[i].name, pos[i].id));
            }
        }
    )
</script>
