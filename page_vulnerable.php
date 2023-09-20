<?php

// Conectarse a la base de datos
$db = new PDO('mysql:host=localhost;dbname=my_database', 'root', '');

// Verificar la consulta SQL
function verify_sql($query) {
    // Eliminar caracteres especiales
    $query = str_replace("'", "", $query);
    $query = str_replace(";", "", $query);

    // Comprobar si la consulta SQL es válida
    try {
        $statement = $db->prepare($query);
        $statement->execute();
    } catch (PDOException $e) {
        return false;
    }

    return true;
}

// Procesar la solicitud
if (isset($_POST['query'])) {
    // Verificar la consulta SQL
    if (!verify_sql($_POST['query'])) {
        echo "Error: La consulta SQL no es válida.";
    } else {
        // Ejecutar la consulta SQL
        $statement = $db->prepare($_POST['query']);
        $statement->execute();

        // Mostrar el resultado
        echo "Éxito";
    }
}

?>

