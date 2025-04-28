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
}