<?php
    //$materia = $_POST['materiaClave'];
    
    // SQL Server Extension Sample Code:
    $connectionInfo = array("UID" => "saulelabra", "pwd" => "ConstruyeDB1", "Database" => "sistema-calificaciones", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:sistema-calificaciones-db.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    
    //$query = "SELECT estudianteMatricula, materiaClave, cAcad FROM sistemaCalificaciones.CalificacionEstudiante WHERE estudianteMatricula = '$estudianteMatricula'";
    //$query = "SELECT estudianteMatricula, materiaClave, cAcad, estatus FROM sistemaCalificaciones.CalificacionEstudiante WHERE estudianteMatricula = '12345'";

    $stmt = sqlsrv_query($conn, $query);
    if($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    sqlsrv_free_stmt($stmt);
    
    

    $query = "INSERT INTO sistemaCalificaciones.CalificacionEstudiante (estudianteMatricula, materiaClave, cAcad, cEq, cCom, estatus)
    VALUES ('12345', 'TC1000', '85','85','85','aprobado')";

    if (sqlsrv_query($conn, $query)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $query . "<br>" . sqlsrv_error($conn);	
	}


	/*for($i = 0, $size = count($array); $i < $size; ++$i) {
    	$query = "INSERT INTO sistemaCalificaciones.CalificacionEstudiante (estudianteMatricula, materiaClave, cAcad, cEq, cCom, estatus) 
    	VALUES(
    	'"{$array[$i]['estudianteMatricula']}"', 
    	'"{$array[$i]['materiaClave']}"', 
    	'"{$array[$i]['cAcad']}"',
    	'"{$array[$i]['cEq']}"',
    	'"{$array[$i]['cCom']}"',
    	'"{$array[$i]['estatus']}"')"
    	if (sqlsrv_query($conn, $query)) {
    		echo "New record created successfully";
		} else {
    		echo "Error: " . $query . "<br>" . sqlsrv_error($conn);	
		}
	}*/


   



    //$query = "SELECT * FROM sistemaCalificaciones.CalificacionEstudiante";
    //$stmt = sqlsrv_query($conn, $query);
    
    /*$json = array();
    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
        $json['estudianteMatricula'] =  $row['estudianteMatricula'];
        $json['materiaClave'] = $row['materiaClave'];
        $json['cAcad'] = $row['cAcad'];
        $json['estatus'] = $row['estatus'];
        $data[] = $json;
    }
    
    $jsonOut = json_encode($data);
    echo $jsonOut;*/
    //return;
    
    sqlsrv_free_stmt( $stmt);
?>
