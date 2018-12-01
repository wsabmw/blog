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
         foreach($_FILES as $k=>$v) {
                $date = time();
                $file = $_FILES[$k];
                move_uploaded_file($file['tmp_name'],\Env::get('root_path').'public/static/images/uploads/'.$date.'.png');
                return json_encode([
                        "errno"=>0,
                        "data"=>[
                            '/static/images/uploads/'.$date.'.png',
                                ]
                
                        ]);
         }
   
     } 
}
