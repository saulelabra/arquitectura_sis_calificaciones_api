<?php
    $serverName = "tcp:sistema-calificaciones-db.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "sistema-calificaciones", // update me
        "Uid" => "saulelabra", // update me
        "PWD" => "ConstruyeDB1" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    $tsql= "SELECT * FROM sistemaCalificaciones.Calificacion_estudiante";
        
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading..." . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
     echo ($row['estudiante_matricula'] . " " . $row['materia_clave'] . PHP_EOL);
    }
    sqlsrv_free_stmt($getResults);
?>



