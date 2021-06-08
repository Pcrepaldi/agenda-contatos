<?php
    session_start();

    try{
        
        $user = "pedro";
        $password = "123";

        $user_form = $_POST["user"];
        $password_form = $_POST["password"];

        if($user_form === $user){
            if($password_form === $password){
                $_SESSION["usuario_logado"] = $user_form;
                header("Location: index.php");
            }else{
                header("Location: login.php?fail=true");
            }
        }else{
            header("Location: login.php?fail=true");
        }

    }catch(Exception $ex){
        echo $ex->getMessage();
    }
    