<?php

    // PHP Data Objects(PDO) Sample Code:
    try {
        $conn = new PDO("sqlsrv:server = tcp:sistema-calificaciones-db.database.windows.net,1433; Database = sistema-calificaciones", "saulelabra", "ConstruyeDB1");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }

    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "saulelabra", "pwd" => "ConstruyeDB1", "Database" => "sistema-calificaciones", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:sistema-calificaciones-db.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    $query = 'SELECT * FROM sistemaCalificaciones.Estudiante';

    $stmt = sqlsrv_query( $conn, $query );

    if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }

    $json = array();

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $json['matricula'] = $row[sistemaCalificaciones.Estudiante.matricula];
        $json['nombre'] = $row[sistemaCalificaciones.Estudiante.nombre];
        $data[] = $json;
    }

    $jsonOut = json_encode($data);
    echo $jsonOut;

    return "{\"Camion\": ".json_encode($data)."}";
    
    sqlsrv_free_stmt( $stmt);
?>