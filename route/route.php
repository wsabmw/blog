<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::rule('/','home/index/index');

Route::resource('a_:name','admin/:name')
    ->rest('delete',['GET', '/delete/:id', 'delete']);


    Route::resource('h_:name','home/:name')
    ->rest('delete',['GET', '/delete/:id', 'delete']);

    
