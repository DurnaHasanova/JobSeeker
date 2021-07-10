<?php
require '../configs.php';
require '../utils/langAndMenu.php';

$sql= "select id, name_$lang as name from positions order by name_$lang ";

$result=$connection->query($sql);
$positions=[];
while($row=$result->fetch_assoc()){

    array_push($positions,$row);
};

echo json_encode($positions);


