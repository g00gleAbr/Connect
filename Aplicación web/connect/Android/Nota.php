<?php
require 'Database.php';
class Meta{
    function __construct(){
    }
    public static function getAll(){
        $consulta = "SELECT * FROM meta";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return false;
        }
    }
    public static function getById($idMeta){
        // Consulta de la meta
        $consulta = "SELECT idMeta,
                            titulo,
                             descripcion,
                             prioridad,
                             fechaLim,
                             categoria
                             FROM meta
                             WHERE idMeta = ?";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idMeta));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    public static function update(
        $idMeta,
        $titulo,
        $descripcion,
        $fechaLim,
        $categoria,
        $prioridad
    ){
        // Creando consulta UPDATE
        $consulta = "UPDATE meta" .
            " SET titulo=?, descripcion=?, fechaLim=?, categoria=?, prioridad=? " .
            "WHERE idMeta=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($titulo, $descripcion, $fechaLim, $categoria, $prioridad, $idMeta));

        return $cmd;
    }
    public static function insert(
        $titulo,
        $descripcion,
        $fechaLim,
        $categoria,
        $prioridad
    ){
        // Sentencia INSERT
        $comando = "INSERT INTO meta ( " .
            "titulo," .
            " descripcion," .
            " fechaLim," .
            " categoria," .
            " prioridad)" .
            " VALUES( ?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array(
                $titulo,
                $descripcion,
                $fechaLim,
                $categoria,
                $prioridad
            )
        );

    }
    public static function delete($idMeta){
        // Sentencia DELETE
        $comando = "DELETE FROM meta WHERE idMeta=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idMeta));
    }
}

?>