<?php
include "../model/user.php";
$baru = new user();
$result = [];
$baru->select("count(*)")->exec();
while ($row = $baru->fetch()) {
    array_push($result, $row);
}
echo json_encode($result);
