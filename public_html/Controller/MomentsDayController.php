<?php

namespace public_html\Controller;

use Exception;

class MomentsDayController extends Controller
{
    public static function form()
    {
        try {
            include 'View/modules/MomentsDay.php';
        } catch (Exception $e) {
            parent::LogError($e);
        }
    }

    public static function visitas()
    {
        try {
            if (!isset($_GET['senha']))
                header('location: /');

            if ($_GET['senha'] == 'M0m3nt5@')
                include 'View/modules/ListVisitas.php';
            else
                header('location: /');
        } catch (Exception $e) {
            parent::LogError($e);
        }
    }

    public static function login()
    {
        try {
            include 'View/modules/Login.php';
        } catch (Exception $e) {
            parent::LogError($e);
        }
    }
}
