<?php
namespace App\Helpers;

class NioTrans
{
    static function do($att, $msg, $rules=array('')) 
    {
        $extra = ['attribute' => $att];
        if(!empty($rules)) {
            $extra = array_merge($extra, $rules);
        }
        return __($msg, $extra);
    }
}