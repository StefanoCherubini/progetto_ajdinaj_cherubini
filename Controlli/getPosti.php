<?php
include("../db.php");

$sql = "SELECT fila, num_posto FROM posti WHERE disponibile = 0";
$result = $connessione->query($sql);

$posti = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $posti[] = $row;
    }
}

echo json_encode($posti);

$connessione->close();
?>
