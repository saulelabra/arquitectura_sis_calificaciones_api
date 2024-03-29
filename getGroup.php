
<?php
    $rawInput = file_get_contents('php://input');

    $inputJson = json_decode($rawInput);

    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "saulelabra", "pwd" => "ConstruyeDB1", "Database" => "sistema-calificaciones", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:sistema-calificaciones-db.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    
    $query = "SELECT sistemaCalificaciones.Materia.nombre AS materiaNombre, estudianteMatricula, Estudiante.nombre, cAcad, cEq, cCom, estatus
    FROM sistemaCalificaciones.CalificacionEstudiante  
    INNER JOIN sistemaCalificaciones.Estudiante 
    ON sistemaCalificaciones.CalificacionEstudiante.estudianteMatricula = sistemaCalificaciones.Estudiante.matricula
    INNER JOIN sistemaCalificaciones.Materia
    ON sistemaCalificaciones.CalificacionEstudiante.materiaClave = sistemaCalificaciones.Materia.clave
    WHERE materiaClave = '$inputJson->claveMateria'";
    
    $stmt = sqlsrv_query( $conn, $query );
        
    $json = array();

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $json['materiaNombre'] = $row['materiaNombre'];
        $json['estudianteMatricula'] =  $row['estudianteMatricula'];
        $json['nombre'] = $row['nombre'];
        $json['cAcad'] = $row['cAcad'];
        $json['cEq'] = $row['cEq'];
        $json['cCom'] = $row['cCom'];
        $json['estatus'] = $row['estatus'];
        $data[] = $json;
    }
    
    if($data != null)
    {
        $jsonOut = json_encode($data);
        echo $jsonOut;
    }else{
        echo '[{}]';
    }
    
    return;
    
    sqlsrv_free_stmt( $stmt);
?>
