<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\admin\model\Article as MArticle;
use app\admin\model\Classify as MClassify;

class Index extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(MArticle $ma)
    {
        $data = MArticle::paginate(5);
        // dump($data);
        
        $rw = $ma->order('browse','desc')->limit(5)->select();
        return view('',[
            'data'=>$data,
            'rw'=>$rw
        ]);
    }

    public function detail(Request $req,MArticle $ma) {
            $id = $_GET['id'];
            $data = $ma->get($id);
            return view('',[
                'data'=>$data,
            ]);
    }

    public function article(MArticle $ma,MClassify $mc) {
        $data = MArticle::paginate(5);
        $data1 = $ma->all();
        $classify = $mc->all();
        $zxA = $ma->order('id','desc')->limit(5)->select();
        for($i=0;$i<count($data1);$i++) {
            $Sid[] =$data1[$i]['id'];
        }
        shuffle($Sid);
        for($i=0;$i<5;$i++) {
            $SjArt[] = $ma->find($Sid[$i]);
        }
        return view('',[
            'data'=>$data,          //左侧主要数据列表
            'classify'=>$classify,   //分类
            'zxA'=>$zxA,        //作者推荐
            'SjArt'=>$SjArt  //随便看看
        ]);
    }

    public function cikcls(MArticle $ma,MClassify $mc,$id) {  //点击分类显示相应数据和页面
       $data = $ma->where('fl_id',$id)->select();
       $data1 = $ma->all();
       $classify = $mc->all();
       $zxA = $ma->order('id','desc')->limit(5)->select();
       for($i=0;$i<count($data1);$i++) {
           $Sid[] =$data1[$i]['id'];
       }
       shuffle($Sid);
       for($i=0;$i<4;$i++) {
           $SjArt[] = $ma->find($Sid[$i]);
       }
       return view('',[
           'data'=>$data,
           'classify'=>$classify,   //分类
            'zxA'=>$zxA,        //作者推荐
            'SjArt'=>$SjArt  //随便看看
       ]);
    }

    public function resource() {
        return view('');
    }


    public function about() {
        return view('');
    }
    // 点点滴滴
    public function timeline() {
        return view('');
    }
   
}
