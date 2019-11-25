<?php
    $serverName = "tcp:sistema-calificaciones-db.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "sistema-calificaciones", // update me
        "Uid" => "saulelabra", // update me
        "PWD" => "ConstruyeDB1" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    $tsql= "SELECT estudiante_matricula, materia_clave, caCad FROM sistemaCalificaciones.Calificacion_estudiante";
        
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading!..." . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        $json['estudiante_matricula'] = $row['estudiante_matricula'];
        $json['materia_clave'] = $row['materia_clave'];
        $json['caCad'] = $row['caCad'];
        $data[] = $json;
    }

    $jsonOut = json_encode($data);
    echo $jsonOut;
    return;

    sqlsrv_free_stmt($getResults);
?>



