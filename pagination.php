<?php
require_once('config.php');
$query = 'SELECT count(*) as total FROM prepack p';
$result = $connexion->query($query);
$total = mysqli_fetch_assoc($result);
echo json_encode($total);