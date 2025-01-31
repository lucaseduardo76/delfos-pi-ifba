<?php
function retornaDiaPelaData($data){
    $diasSemana = [
    "Sunday"    => "Dom",
    "Monday"    => "Seg",
    "Tuesday"   => "Ter",
    "Wednesday" => "Qua",
    "Thursday"  => "Qui",
    "Friday"    => "Sex",
    "Saturday"  => "Sáb"
];

$data = new DateTime($data);
$diaIngles = $data->format("l");
$diaSemana = $diasSemana[$diaIngles];

return $diaSemana; 
}