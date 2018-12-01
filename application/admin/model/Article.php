<?php

namespace app\admin\model;

use think\Model;

class Article extends Model
{
    public function classify(){
        return $this->hasOne('Classify','id','fl_id');
    }
    
    public function searchTitleAttr($query, $value, $data)
    {
        $query->where('title','like','%'.$value.'%');
    }
}
