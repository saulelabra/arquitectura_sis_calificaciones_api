<?php
    $rawInput = file_get_contents('php://input');

    $inputJson = json_decode($rawInput);
    
    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "saulelabra", "pwd" => "ConstruyeDB1", "Database" => "sistema-calificaciones", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:sistema-calificaciones-db.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    
    //$query = "SELECT estudianteMatricula, materiaClave, cAcad FROM sistemaCalificaciones.CalificacionEstudiante WHERE estudianteMatricula = '$estudianteMatricula'";
    $query = "SELECT estudianteMatricula, materiaClave, cAcad, estatus FROM sistemaCalificaciones.CalificacionEstudiante WHERE estudianteMatricula = '12345'";
    
    
    $stmt = sqlsrv_query( $conn, $query );
        
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
    
    //sqlsrv_free_stmt( $stmt);
?>
