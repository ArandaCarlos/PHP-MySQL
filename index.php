<?php
include_once 'conexion.php';


//LEER DATOS
$sql_leer= 'SELECT * FROM colores';

$gsent= $pdo->prepare($sql_leer);
$gsent->execute();

$resutado = $gsent->fetchAll();

//var_dump($resutado);

//AGREGAR

if(!empty($_POST['color'])){
    
    $color = $_POST['color'];
    $descripcion = $_POST['descripcion'];
    $sql_agregar = 'INSERT INTO colores (color,descripcion) VALUES (?,?)';
    $sentencia_agregar =$pdo->prepare($sql_agregar);
    $sentencia_agregar->execute(array($color,$descripcion));

    header('location:index.php');
}

//EDITAR

if($_GET){
    $id = $_GET['id'];
    $sql_unico= 'SELECT * FROM colores WHERE id=?';
    $gsent_unico= $pdo->prepare($sql_unico);
    $gsent_unico->execute(array($id));
    $resutado_unico = $gsent_unico->fetch();
    
}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">

                <?php
                    foreach($resutado as $dato):
                ?>
                <div class="text-uppercase alert alert-<?php echo $dato['color']?>" role="alert">
                    <?php echo $dato['color']?>
                    -
                    <?php echo $dato['descripcion']?>
                    
                    <a href="eliminar.php?id=<?php echo $dato['id']?>" class="float-right ml-3" id="eliminar">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <a href="index.php?id=<?php echo $dato['id']?>" class="float-right">
                        <i class="fas fa-edit"></i>
                    </a>
                    
                </div>

                <?php endforeach ?>
            
            </div>
            <div class="col-md-6">
                <?php if(!$_GET): ?>
                    <h2>Agregar Elementos</h2>
                    <form method="POST">
                        <input type="text" class="form-control" name="color">
                        <input type="text" class="form-control mt-3" name="descripcion">
                        <button class="btn btn-primary mt-3">Agregar</button>
                    </form>
                <?php endif ?>

                <?php if($_GET): ?>
                    <h2>Editar Elemento</h2>
                    <form method="GET" action="editar.php">
                        <input type="text" class="form-control" name="color" value="<?php echo $resutado_unico['color']?>">
                        <input type="text" class="form-control mt-3" name="descripcion" value="<?php echo $resutado_unico['descripcion']?>">
                        <input type="hidden" value="<?php echo $resutado_unico['id']?>" name="id">
                        <button class="btn btn-primary mt-3">Editar</button>
                    </form>
                <?php endif ?>
            </div>
        </div>
        
    </div>
                    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <script type="text/javascript" src="main.js"></script>
  </body>
</html>