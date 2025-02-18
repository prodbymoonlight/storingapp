<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$type = $_POST['type'];
$capaciteit = $_POST['capaciteit'];
$prioriteit = $_POST['prioriteit'];
$melder = $_POST['melder'];
$overig = $_POST['overig'];

// Error handling 
if(empty($attractie)) {
    $errors[] = "Vul de attractie-naam in.";
}
if(empty($capaciteit)) {
    $errors[] = "Vul voor capaciteit een geldig getal in.";
}
if(isset($errors)) {
    var_dump($errors);
    die();
}
if(isset($_POST['prioriteit'])) {
    $prioriteit = 1;
}else 
{
    $prioriteit = 0;
}

//echo $attractie . " / " . $capaciteit . " / " . $melder;

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query
$query = 
"INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info)
VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";
//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
   ":attractie" => $attractie,
   ":type" => $type, 
   ":capaciteit" => $capaciteit, 
   ":prioriteit" => $prioriteit, 
   ":melder" => $melder, 
   ":overige_info" => $overig
]);

header("Location: ../../../resources/views/meldingen/index.php?msg=Melding opgeslagen");