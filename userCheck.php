<?php

    $user = $_GET['user'];
    $pwd = $_GET['pwd'];

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

    $query = "SELECT * FROM sistemaCalificaciones.Profesor WHERE email = '$user' AND contrasena = '$pwd'";

    //$query = "SELECT * FROM sistemaCalifiaciones.Profesor WHERE EXISTS (SELECT * FROM sistemaCalifiaciones.Profesor WHERE email='$user' AND contrasena='$pwd')";

    $stmt = sqlsrv_query( $conn, $query );

    if($stmt->rowCount() > 0) {
        $json = array();

        echo "true";
    }

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

    return;
    
    sqlsrv_free_stmt( $stmt);
?>