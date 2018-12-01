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
        $data = $ma->order('id','desc')->paginate(5);
        // dump($data->toarray());
        
        $rw = $ma->order('browse','desc')->limit(5)->select();
        return view('',[
            'data'=>$data,
            'rw'=>$rw
        ]);
    }

    public function detail(Request $req,MArticle $ma,MClassify $mc) {
            $id = $_GET['id'];
            $data = $ma->get($id);

            $data1 = $ma->all();
            $classify = $mc->all();
            $zxA = $ma->order('id','desc')->limit(5)->select();
            for($i=0;$i<count($data1);$i++) {
                $Sid[] =$data1[$i]['id'];
            }
            shuffle($Sid);
            for($i=0;$i<count($data1);$i++) {
                $SjArt[] = $ma->find($Sid[$i]);
            }
            return view('',[
                'data'=>$data,
                'classify'=>$classify,   //分类
                'zxA'=>$zxA,        //作者推荐
                'SjArt'=>$SjArt  //随便看看
            ]);
    }

    public function article(MArticle $ma,MClassify $mc,Request $req) {
        if($req->title) {
            $data = MArticle::withSearch(['title'], [
                       'title'	=>	$req->title,
                     ])
                     ->paginate(5);
        }else {
             $data = MArticle::paginate(5);            
        }
        $data1 = $ma->all();
        $classify = $mc->all();
        $zxA = $ma->order('id','desc')->limit(5)->select();
        for($i=0;$i<count($data1);$i++) {
            $Sid[] =$data1[$i]['id'];
        }
        shuffle($Sid);
        for($i=0;$i<count($data1);$i++) {
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
       for($i=0;$i<count($data);$i++) {
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
