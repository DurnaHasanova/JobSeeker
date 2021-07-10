<?php
include '././model/Result.php';
include '././constants/ReturnCode.php';

class VacancyService
{
    public function insert($post): Result
    {
        global $connection;

            $vacancy = new Vacancy($post["userId"],$post["categoryId"], $post["jobTitle"], $post["minSalary"],
                $post["maxSalary"],$post["description"], $post["skills"], $post["expireDate"]);



                $sql = objectToInsertSqlQuery($vacancy, "vacancy");
                $connection->begin_transaction();
                $connection->query($sql);
                if ($connection->affected_rows < 0) {

                    $connection->rollback();
                    return new Result(ReturnCode::SQL_ERROR, "There is an error in sql");
                } else {
                    $connection->commit();
                    return new Result(ReturnCode::SUCCESS, "Succesfully added");
                }



    }
}