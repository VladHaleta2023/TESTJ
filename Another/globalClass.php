<?php 
    try {
        $globalClassPHP_Object = file_get_contents("php://input");
        $globalClassPHP_Object = var_dump(json_decode($globalClassPHP_Object));
    }
    catch (Exception $e){
        $globalClassPHP_Object = null;  
    }
    finally {
        echo $globalClassPHP_Object;
    }
?>