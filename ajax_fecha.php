<?php
require_once('config.php');
 
$html = '';

if(isset($_GET['fecha_creacion']) && isset($_GET['tracking'])){
    $fecha_creacion = $_GET['fecha_creacion'];
    $tracking = $_GET['tracking'];
    $query = 'SELECT id, tracking, creationdate, npack, packtype, weight, image
    FROM prepack p WHERE creationdate like "'.$fecha_creacion.'%" AND tracking like "'.$tracking.'%"';
}else if(isset($_GET['fecha_creacion'])){
    $fecha_creacion = $_GET['fecha_creacion'];
    $query = 'SELECT id, tracking, creationdate, npack, packtype, weight, image
    FROM prepack p WHERE creationdate like "'.$fecha_creacion.'%"';
}else if(isset($_GET['tracking'])){
    $tracking = $_GET['tracking'];
    $query = 'SELECT id, tracking, creationdate, npack, packtype, weight, image
    FROM prepack p WHERE tracking like "'.$tracking.'%"';
}

$html = '';

sleep(1);

$result = $connexion->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<li class="col-lg-3">';
        $html .= '<div class="item">';
        $html .= '<div class="row">';
        if($row['image'] != null){
            $html .= '<div class="col-lg-4">';
            $html .= '<img src="https://multitrack.trackingpremium.us/packimages/'.$row['image'].'" width="50%" height="50%">';
            $html .= '</div>';
            $html .= '<div class="col-lg-8">';
            $html .= '<h5>Trck: '.$row['tracking'].'</h5>';
            $html .= '</div>';
        }else{
            $html .= '<div class="col-lg-12">';
            $html .= '<h5>Trck: '.$row['tracking'].'</h5>';
            $html .= '</div>';
        }

        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-12">';
        $html .= '<h5>Date: '.$row['creationdate'].'</h5>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-12">';
        $html .= '<h5>pack: '.$row['npack'].'</h5>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-12">';
        $html .= '<h5>Type: '.$row['packtype'].'</h5>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-12">';
        $html .= '<h5>Weight: '.$row['weight'].'</h5>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</li>';
    }
}

echo $html;
?>
