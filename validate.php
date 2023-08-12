<?php
// Annisya Riyan Wulandini
//2440086041

require_once('./url.php');

function checkSessionValidity()
{
                if($_SESSION['user_agent']!==$user_agent)
                {
                    return false;
                }  
    }
    else
    {
        return false;
    }
?>