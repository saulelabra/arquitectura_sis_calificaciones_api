<?php
    $rawInput = file_get_contents('php://input');

    $inputJson = json_decode($rawInput);

    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "saulelabra", "pwd" => "ConstruyeDB1", "Database" => "sistema-calificaciones", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:sistema-calificaciones-db.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    
    $query1 = "SELECT clave, nombre FROM sistemaCalificaciones.Materia WHERE profesorEmail='$inputJson->user'";
    $stmt1 = sqlsrv_query( $conn, $query1 );

    $json1 = array();

    while( $row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC) ) {
        $json1['clave'] = $row['clave'];
        $json1['nombre'] = $row['nombre'];
        $data['materias'] = $json;
    }

    $first = $data['materias'][0]->clave;

    $query2 = "SELECT sistemaCalificaciones.Materia.nombre AS materiaNombre, estudianteMatricula, Estudiante.nombre, cAcad, cEq, cCom, estatus
    FROM sistemaCalificaciones.CalificacionEstudiante  
    INNER JOIN sistemaCalificaciones.Estudiante 
    ON sistemaCalificaciones.CalificacionEstudiante.estudianteMatricula = sistemaCalificaciones.Estudiante.matricula
    INNER JOIN sistemaCalificaciones.Materia
    ON sistemaCalificaciones.CalificacionEstudiante.materiaClave = sistemaCalificaciones.Materia.clave
    WHERE materiaClave = '$first'";
    
    $stmt2 = sqlsrv_query( $conn, $query2 );
        
    $json2 = array();

    while( $row = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC) ) {
        $json2['estudianteMatricula'] =  $row['estudianteMatricula'];
        $json2['nombre'] = $row['nombre'];
        $json2['cAcad'] = $row['cAcad'];
        $json2['cEq'] = $row['cEq'];
        $json2['cCom'] = $row['cCom'];
        $json2['estatus'] = $row['estatus'];
        $data['estudiantes'] = $json;
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
