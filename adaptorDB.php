<?php
    class AdaptorDB {

        public $conn = null;

        function __construct() {
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
        }

        public function executeQuery($query) {
            return sqlsrv_query( $conn, $query );
        }

        public function executeQueryParam($query, $array, $parameters) {
            return sqlsrv_query( $conn, $query, $array, $parameters );
        }
    }
?>