<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('');
    }

     public function home() {
         return view('');
     }

     public function uploads(Request $req) {
        $date = time();
        $file = $_FILES['Snip20181128_7_png'];
        move_uploaded_file($file['tmp_name'],\Env::get('root_path').'public/static/'.$date.'.png');
        return json_encode([
                "errno"=>0,
                "data"=>[
                    '/static/uploads/images/uploads/'.$date.'.png',
                        ]
           
       ]);
     } 
}
