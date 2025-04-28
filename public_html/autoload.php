<?php
    spl_autoload_register(function ($class) {
        $arq = BASEDIR . '/' . $class . '.php';

        $arq = str_replace("\\", "/", $arq);

        if(file_exists($arq)) {
            include $arq;
        } else 
            exit('Arquivo não encontrado. Arquivo: ' . $arq . "<br />");
    });