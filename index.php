<?php
    include_once("adaptorDB.php");
    include_once("userCheck2.php");

    $adaptor = new AdaptorDB();

    switch($_SERVER['SCRIPT_NAME']) {
        case "/userChecks.php":
            echo 'entered user check';
            $user = $_GET['user'];
            $pwd = $_GET['pwd'];
            $userCheck2 = new userCheck2();
            $userCheck2->userCheckFunc($user, $pwd, $adaptor);
            break;
        default:
            echo 'entered default';
    }
?>