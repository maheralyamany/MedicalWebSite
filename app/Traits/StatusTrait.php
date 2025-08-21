<?php

namespace App\Traits;




trait StatusTrait
{
    public static function laratablesStatus($obj)
    {
        return ($obj->status == 1 ? trans('m.actived') : trans('m.un_actived'));
    }

  
  
    public function getStatus()
    {
        return ($this->status == 1 ? trans('m.actived') :  trans('m.un_actived'));
    }
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }
    public function scopeUnActive($query)
    {
        return $query->where('status', '0');
    }
}
