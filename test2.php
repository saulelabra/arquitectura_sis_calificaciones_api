<?php
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
        $json['matricula'] = $row['matricula'];
        $json['nombre'] = $row['nombre'];
        $data[] = $json;
    }

    $jsonOut = json_encode($data);
    echo $jsonOut;

    return "{\"Camion\": ".json_encode($data)."}";
    
    //sqlsrv_free_stmt( $stmt);
?>