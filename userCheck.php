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

    $query1 = "SELECT * FROM sistemaCalificaciones.Profesor WHERE email = '$user' AND contrasena = '$pwd'";
    $query2 = "SELECT * FROM sistemaCalificaciones.Estudiante WHERE matricula = '$user' AND contrasena = '$pwd'";

    //$query = "SELECT * FROM sistemaCalifiaciones.Profesor WHERE EXISTS (SELECT * FROM sistemaCalifiaciones.Profesor WHERE email='$user' AND contrasena='$pwd')";

    $stmt = sqlsrv_query( $conn, $query1, array(), array( "Scrollable" => 'static' ));
    $num_rows = sqlsrv_num_rows( $stmt );

    if($num_rows > 0) {
        echo '{ "type" : "professor", "exists" : true }';
    }else{
        $stmt2 = sqlsrv_query( $conn, $query2, array(), array( "Scrollable" => 'static' ));
        $num_rows2 = sqlsrv_num_rows($stmt2);
        
        if($num_rows2 > 0) {
            echo '{ "type" : "student", "exists" : true }';
        }else{
            echo '{ "type" : "notype", "exists" : false }';
        }
    }

    return;
    
    sqlsrv_free_stmt( $stmt);
?>