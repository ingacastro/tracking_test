<?php
require('config.php');
$result = $connexion->query('SELECT COUNT(*) as total_packs FROM prepack');
$row = $result->fetch_assoc();
$num_total_rows = $row['total_packs'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Paginación de resultados con jQuery, Ajax y PHP</title>
<meta name="description" content="Paginación de resultados con jQuery, Ajax y PHP..."/>
<meta name="author" content="Alejandro Castro">
<link rel="shortcut icon" href="https://www.jose-aguilar.com/blog/wp-content/themes/jaconsulting/favicon.ico" />
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"></head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styles.css">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/script.js" type="text/javascript"></script>
</head>

<body>
    <div class="container">
        <div id="first">
            <form action="" method="post">
                <input type="text" id="loginusername" placeholder="Username" />
                <input type="password" id="loginpassword" placeholder="Password" />
                <input type="button" id="login" value="Sign In" />
            </form>
        </div>

        <div id="second">

        </div>
    </div>

<div class="container-fluid" id="tablero">
    <h1>Paginación de resultados con jQuery, Ajax y PHP</h1>
    <h2 class="lead"><?php echo $num_total_rows; ?> elementos listados de 20 en 20</h2>
    
    <div class="row">
        <div id="content" class="col-lg-12">
            <?php
            //Si hay registros
            if ($num_total_rows > 0) {
                $num_pages = ceil($num_total_rows / NUM_ITEMS_BY_PAGE);
                $result = $connexion->query(
                    'SELECT id, tracking, creationdate, npack, packtype, weight, image
                    FROM prepack p ORDER BY creationdate DESC LIMIT 0, '.NUM_ITEMS_BY_PAGE
                );
                if ($result->num_rows > 0) {
                    echo '<ul class="row items">';
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <li class="col-lg-3">
                            <div class="item">
                                <div class="row">
                                    <?=$row['image'] != null ? '<div class="col-lg-6"><h5><img src="https://multitrack.trackingpremium.us/packimages/'.$row['image'].'" width="80%" height="80%"></div><div class="col-lg-6"><h5>Trck: '.$row['tracking'].'</h5></div>' : '<div class="col-lg-3"><h5>Trck: '.$row['tracking'].'</h5></div>';?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>Date: <?=$row['creationdate']?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>Pack: <?=$row['npack']?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>Type: <?=$row['packtype']?></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5>Weight: <?=$row['weight']?></h5>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    echo '</ul>';
                }


                if ($num_pages > 1) {
                    echo '<div class="row">';
                    echo '<div class="col-lg-12">';
                    echo '<nav aria-label="Page navigation example">';
                    echo '<ul class="pagination justify-content-start">';

                    for ($i=1;$i<=$num_pages;$i++) {
                        $class_active = '';
                        if ($i == 1) {
                            $class_active = 'active';
                        }
                        
                        echo '<li class="page-item '.$class_active.'">';
                        echo '<a class="page-link" href="#" data="'.$i.'">'.$i.'</a>';
                        echo '</li>';
                    }

                    echo '</ul>';
                    echo '</nav>';
                    echo '</div>';
                    echo '</div>';
                }

                /********************** */
                ?>                
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                    </ul>
                </nav>

                <?php
                /*********************** */
                
                echo '<div class="row">';
                    echo '<div class="col-lg-4">';
                    echo '<label>Fecha de creación</label>';
                    echo '<input type="text" id="fecha_creacion" name="fecha_creacion" />';
                    echo '</div>';
                    echo '<div class="col-lg-4">';
                    echo '<label>Tracking</label>';
                    echo '<input type="text" id="numero_tracking" name="numero_tracking" />';
                    echo '</div>';
                    echo '<div class="col-lg-4">';
                    echo '<input type="button" id="buscar" value="buscar" />';
                    echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
</body>
</html>
