<?php

namespace public_html\Controller;
use Exception;

class MomentsDayController extends Controller
{
        public static function form()
        {
            try
            {
                include 'View/modules/MomentsDay.php';
            }catch(Exception $e)
            {
                parent::LogError($e);
            }
        }

        public static function visitas()
        {
            try
            {
                include 'View/modules/ListVisitas.php';
            }catch(Exception $e){
                parent::LogError($e);
            }
        }
        
        public static function login()
        {
            try
            {
                include 'View/modules/Login.php';
            }catch(Exception $e){
                parent::LogError($e);
            }
        }
}