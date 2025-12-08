<?php        
        $debug = [];
        $debug[] = ["debug1"=>"debug1"];
        $debug[] = ["debugName"=> DB_HOST,DB_LOGIN,DB_PWD,DB_NAME];
        $debug[] = ["query"=>"$query"];
        $db->real_escape_string("ABCD");
        $debug[] = ["debug2"=>"debug2"];
        echo  json_encode($debug);
?>