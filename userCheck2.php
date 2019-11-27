<?php
    class UserCheck2 {
        public static function userCheckFunc($user, $pwd, $adaptorDB) {
            $query1 = "SELECT * FROM sistemaCalificaciones.Profesor WHERE email = '$user' AND contrasena = '$pwd'";
            $query2 = "SELECT * FROM sistemaCalificaciones.Estudiante WHERE matricula = '$user' AND contrasena = '$pwd'";
    
            $stmt = $adaptorDB->executeQueryParam($query1, array(), array( "Scrollable" => 'static' ));
    
            $num_rows = sqlsrv_num_rows( $stmt );
    
            if($num_rows > 0) {
                echo '{ "type" : "professor", "exists" : true }';
            }else{
                $stmt2 = $adaptorDB->executeQueryParam($query2, array(), array( "Scrollable" => 'static' ));
    
                $num_rows2 = sqlsrv_num_rows($stmt2);
                
                if($num_rows2 > 0) {
                    echo '{ "type" : "student", "exists" : true }';
                }else{
                    echo '{ "type" : "notype", "exists" : false }';
                }
            }
            sqlsrv_free_stmt( $stmt);
    
            return;
        }
    }
?>