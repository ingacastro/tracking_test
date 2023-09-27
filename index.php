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
                        echo '<li class="col-lg-3">';
                        echo '<div class="item">';
                        echo $row['image'] != null ? '<h5><img src="https://multitrack.trackingpremium.us/packimages/'.$row['image'].'" width="50%" height="50%"><h5>Trck: '.$row['tracking'].'</h5>' : '<h5>Trck: '.$row['tracking'].'</h5>';
                        echo '<h5>Date: '.$row['creationdate'].'</h5>';
                        echo '<h5>pack: '.$row['npack'].'</h5>';
                        echo '<h5>type: '.$row['packtype'].'</h5>';
                        echo '<h5>w: '.$row['weight'].'</h5>';
                        echo '</div>';
                        echo '</li>';
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
                        
                        echo '<li class="page-item '.$class_active.'"><a class="page-link" href="#" data="'.$i.'">'.$i.'</a></li>';
                    }

                    echo '</ul>';
                    echo '</nav>';
                    echo '</div>';
                    echo '</div>';
                }

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
    
    <div class="row">
        <div class="col-lg-12">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- Bloque de anuncios adaptable -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-6676636635558550"
                 data-ad-slot="8523024962"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>    
</div>

</body>
</html>
