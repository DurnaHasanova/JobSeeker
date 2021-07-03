<?php
require '../configs.php';

$sql= "select * from positions";
$result=$connection->query($sql);
$positions=[];
while($row=$result->fetch_assoc()){

    array_push($positions,$row);
};

echo json_encode($positions);


