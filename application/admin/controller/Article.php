<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Article as MArticle;
use app\admin\model\Classify;



class Article extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data['data'] = MArticle::paginate(2);
        return view('',$data);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $data['fl'] = Classify::select();
        return view('',$data);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(MArticle $ma,Request $req)
    {
        $data = $req->post();
        // var_dump($data);
        $val = \Validate::make([
            'fl_id|分类'=>'require|number',           
            'title|标题'=>'require',           
            'content|内容'=>'require',           
        ]);
        
        if(!$val->check($data)){
            return $this->error($val->getError());
        }
        
        $file = $req->file('fm_img');
        $info = $file->move(\Env::get('root_path').'public/uploads');
        $data['atr_img'] = '/uploads/'.$info->getSaveName();

        if($ma->save($data)){
            return $this->success('添加成功','/a_Article');
        }
        return $this->error('添加失败');
    }
    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = MArticle::find($id);
        $content = strip_tags($data->content);
        $fl = Classify::select();
        return view('',[
            'data'=>$data,
            'fl'=>$fl,
            'content'=>$content
            ]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(MArticle $ma,Request $req,$id)
    {
        $data = $req->post();
        // $ws = $data->fm_img;
        $file = $req->file('fm_img');
        $info = $file->move(\Env::get('root_path').'public/uploads');
        $data['atr_img'] = '/uploads/'.$info->getSaveName();

        if($ma->save($data,['id'=>$id])){
            return $this->success('添加成功','/a_Article');
        }
        return $this->error('添加失败');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete(MArticle $ma,$id)
    {
       $data =  $ma::destroy($id);
       if($data){
        return $this->success('删除成功','/a_Article.html');
        }
        return $this->error('删除失败');
        }
}
