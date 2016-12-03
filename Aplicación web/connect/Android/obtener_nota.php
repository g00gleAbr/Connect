<?php
require 'Nota.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $metas = Meta::getAll();
    if ($metas) {
        $datos["estado"] = 1;
        $datos["metas"] = $metas;
        print json_encode($datos);
    } else {
        print json_encode(array(
            "estado" => 2,
            "mensaje" => "Ha ocurrido un error"
        ));
    }
}
?>