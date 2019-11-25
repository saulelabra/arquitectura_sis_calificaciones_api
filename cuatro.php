<?php
    //$materia = $_POST['materiaClave'];
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
    
    //$query = "SELECT estudianteMatricula, materiaClave, cAcad FROM sistemaCalificaciones.CalificacionEstudiante WHERE estudianteMatricula = '$estudianteMatricula'";
    //$query = "SELECT estudianteMatricula, materiaClave, cAcad, estatus FROM sistemaCalificaciones.CalificacionEstudiante WHERE estudianteMatricula = '12345'";
    
    

    $query = "INSERT INTO CalificacionEstudiante (estudianteMatricula, materiaClave, cAcad, cEq, cCom, estatus)
    VALUES ('1111', 'TC2222', '1','1','1','reprobado')";

    $stmt = sqlsrv_query($conn, $query);
    if($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_free_stmt($stmt);



    $query = "SELECT * FROM sistemaCalificaciones.CalificacionEstudiante";
    $stmt = sqlsrv_query($conn, $query);
    
    $json = array();
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $json['estudianteMatricula'] =  $row['estudianteMatricula'];
        $json['materiaClave'] = $row['materiaClave'];
        $json['cAcad'] = $row['cAcad'];
        $json['estatus'] = $row['estatus'];
        $data[] = $json;
    }
    
    $jsonOut = json_encode($data);
    echo $jsonOut;
    return;
    
    sqlsrv_free_stmt( $stmt);
?>