<?php

//Controlando el inicio de la sesión
require'../class/sessions.php';
$objses = new Sessions();
$objses->init();
$nameU = $objses->get('loginUsers');
$idUse = $objses->get('idUser');

$user = isset($nameU) ? $nameU : null ;

if($user == ''){
	header('Location: http://localhost:8888/CodigosVideos/9-DatosUsuario2/index.php?error=2');
}

//conectamos a la base de datos
require'../class/database.php';
$objData = new Database();

$sth = $objData->prepare('SELECT * FROM users WHERE idUsers = :idUser');
$sth->bindParam(':idUser', $idUse);
$sth->execute();

$result = $sth->fetchAll();

?>
<!DOCTYPE html>
<html lang="es">
	<head>
    	<meta charset="utf-8" />
        <title>Perfil de Usuario</title>
        
    </head>
    
    <body>
        
        <?php echo "Bienvenido, " . $nameU;?>
        
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="profile.php">Perfil</a></li>
            <li><a href="log_out.php">Salir</a></li>
        </ul>
        
        <br>
        
        <form action="modify_profile.php" method="POST" enctype="multipart/form-data">
            
            <img src="../<?php echo $result[0]['path_imgUser'];?>" width="200" /> <br>
            <label>Nombre de Usuario:</label>
            <input type="text" name="userN" value="<?php echo $result[0]['loginUsers'];?>" /><br>
            <label>Clave de acceso:</label>
            <input type="password" name="userP" /><br>
            <label>Correo electronico:</label>
            <input type="text" name="userC" value="<?php echo $result[0]['emailUser'];?>" /><br>
            <label>Avatar:</label>
            <input type="file" name="userF" /><br>  
            <input type="hidden" name="idUser" value="<?php echo $idUse;?>" />
            <input type="submit" value="ENVIAR" />
                   
            
        </form>
        
    </body>
    
    
    
</html>