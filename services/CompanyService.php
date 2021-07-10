<?php
include '././model/Result.php';
include '././constants/ReturnCode.php';

class CompanyService
{

    public function getCompany($userId)
    {
        global $connection;
        $sql = "select * from company where userId=$userId";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_array();
            return new Company($row["userId"], $row["name"], $row["webPage"], $row["address"], $row["about"], $row["image"]);
        } else return null;
    }

    public function insert($files, $post): Result
    {
        global $connection;
        if (isset($files['file'])) {
            $uploadResult = fileUpload($files['file'], $post["userId"]);
            if ($uploadResult->code == 4) return new Result(ReturnCode::FILE_UPLOAD_ERROR, $uploadResult->message);
            else {
                $company = new Company($post["userId"], $_POST["name"],
                    $post["webPage"], $post["address"], $post["about"], $uploadResult->fileName);
                $sql = objectToInsertSqlQuery($company, "company");
                $connection->begin_transaction();
                $connection->query($sql);
                if ($connection->affected_rows < 0) {
                    unlink($uploadResult->fileName);
                    $connection->rollback();
                    return new Result(ReturnCode::SQL_ERROR, "There is an error in sql");
                } else {
                    $connection->commit();
                    return new Result(ReturnCode::SUCCESS, "Succesfully added");
                }

            }
        } else {
            return new Result(ReturnCode::VALIDATION_ERROR, "File not selecter");
        }

    }

    public function update($files, $post){
                  if($files["file"]["error"][0]==0){
            $company = $this->getCompany($post["userId"]);
        }
    }
}