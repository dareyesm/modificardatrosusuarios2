<?php

//llamar las sesiones
require'../class/sessions.php';
$objSes = new Sessions();
$objSes->init();

//llamamos la clase file
require'../class/files.php';
$objFile = new Files();

$idUser = $objSes->get('idUser');

//print_r($_SESSION);

//vamos a armar la ruta para cargar la imagen
$path = $objFile->fix_path($idUser);

//cambiar el nombre del archivo

$file = $objFile->change_name();

$success = $objFile->upload_file($file, $path);


