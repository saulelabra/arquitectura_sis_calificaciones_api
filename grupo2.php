
<?php

    $materia = $_POST['clave'];
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
    //$query = "SELECT * FROM sistemaCalificaciones.Calificacion_estudiante WHERE materia_clave = '$materia'";
    $query = "SELECT estudiante_matricula FROM sistemaCalificaciones.Calificacion_estudiante";
    echo ("Reading data from table");
    $stmt = sqlsrv_query( $conn, $query );
    
    /*if( $stmt === false) {
        die( print_r( sqlsrv_errors(), true) );
    }*/

    
    $json = array();

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $json['estudiante_matricula'] =  $row['estudiante_matricula'];
        echo($row['estudiante_matricula'] . PHP_EOL);
        //$json['materia_clave'] = $row['materia_clave'];
        //$json['caCad'] = $row['caCad'];
        $data[] = $json;
    }
    
    $jsonOut = json_encode($data);
    echo $jsonOut;
    return;
    
    sqlsrv_free_stmt( $stmt);
?>
