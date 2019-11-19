<?php
$exampleStudent->id = "A01020725";
$exampleStudent->name = "Pedro Navajas";
$exampleStudent->username = "Aprobado";

$jsonOut = json_encode($exampleStudent);

echo $jsonOut;
?>