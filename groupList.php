<?php
    $rawInput = file_get_contents('php://input');

    $inputJson = json_decode($rawInput);

    // PHP Data Objects(PDO) Sample Code:
    try {
        $conn = new PDO("sqlsrv:server = tcp:sistema-calificaciones-db.database.windows.net,1433; Database = sistema-calificaciones", "saulelabra", "ConstruyeDB1");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
    
    $query = "SELECT clave, nombre FROM sistemaCalificaciones.Materia WHERE profesorEmail='$inputJson->user'";
    $stmt = sqlsrv_query( $conn, $query);
    $json = array();
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $json['clave'] = $row['clave'];
        $json['nombre'] = $row['nombre'];
        $data[] = $json;
    }
    $jsonOut = json_encode($data);
    echo $jsonOut;
    return;
    
    //sqlsrv_free_stmt( $stmt);
?>
