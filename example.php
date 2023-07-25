<?php
// para la conexion de datos a la Data Base de phpmyadmin.
$db_host = "localhost";
$db_nombre = "pruebas";
$db_usuario = "root";
$db_pasword = "";

// a partir de aqui comienza la funcionar la consulta con la Data Base.
$m = $_GET["buscar"];
// require("datos_conexion"); necesario si la conexion dependiera de otro archivo.
$conexion = mysqli_connect($db_host, $db_usuario, $db_pasword);
if (mysqli_connect_errno()) {
    echo "Falló al conectar con la Base de Datos!!!";

    exit();
}

mysqli_select_db($conexion, $db_nombre) or die ("No se encuentra la Base de Datos!!!");

// mysqli_set_charset($conexion, "utf8");

$sql = "SELECT nexp, ci, nombres, apellidos, mun FROM dbpruebas WHERE mun =?";

$resultado = mysqli_prepare($conexion, $sql);

$ok = mysqli_stmt_bind_param($resultado, 's', $m);

$ok = mysqli_stmt_execute($resultado);

if ($ok == false) {
    echo "Error al ejecutar la consulta!";
}
else {
    $ok = mysqli_stmt_bind_result($resultado, $nexp, $ci, $nombres, $apellidos);
    echo "Resultados encontrados: <br><br>";

    while (mysqli_stmt_fetch($resultado)) {
        echo $nexp . " " . $ci . " " . $nombres . " " . $apellidos . "<br>";
    }

    mysqli_stmt_close($resultado);
}

?>