<?php
require '../configs.php';
require '../utils/langAndMenu.php';
include '../dtoS/VacancyDto.php';


if (!empty($_POST)) {

    if(isset($_POST["pageSize"])&& isset($_POST["limit"])){
        $pageSize=$_POST["pageSize"];
        $limit=$_POST["limit"];
        $pageStart=($pageSize-1)*$limit;
        $category=isset($_POST["category"])?$_POST["category"]:"";
        $minSal=isset($_POST["minSal"])?$_POST["minSal"]:"";
        $maxSal=isset($_POST["maxSal"])?$_POST["maxSal"]:"";
        $condition="";
        (isset($_POST["category"]) && !empty($_POST["category"]) && is_numeric($_POST["category"]) && $_POST["category"]>0)? $condition="$condition and pos.id=$category":"";
        (isset($_POST["minSal"])&& !empty($_POST["minSal"]) && is_numeric($_POST["minSal"]))? $condition="$condition and vac.minSalary >=$minSal":"";
        (isset($_POST["maxSal"])&& !empty($_POST["maxSal"]) && is_numeric($_POST["maxSal"]))? $condition="$condition and vac.maxSalary <=$maxSal":"";
        $sql="select vac.id as id,vac.jobTitle, com.name,pos.name_$lang as category,vac.expireDate from vacancy as vac ,company as com, positions as pos
              where  vac.userId=com.userId
              and vac.categoryId=pos.id
                $condition
              order by vac.expireDate limit $pageStart,$limit";

        $result=$connection->query($sql);
//print_r( $result->num_rows);
        $vacancies=[];
        while($row=$result->fetch_assoc()){
            array_push($vacancies,$row);
        };

         $dto=new VacancyDto($result->num_rows, $vacancies);

        header("Status: 200 Not Found");
        echo json_encode($dto);

    }

}

