<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Classify as MClassify;



class Classify extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(MClassify $ma)
    {
        $data['data'] = $ma->paginate(2);
        return view('',$data);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(MClassify $ma, Request $req)
    {
        $data = $req->post();
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
        
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(MClassify $ma,$id)
    {
        $data['name'] = $ma->find($id);
        // dump($data);
        return view('',$data);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(MClassify $ma,Request $req,$id)
    {
        $data = $req->param();
        // $name = $data['name'];
        if($ma->save($data,['id'=>$id])) {
            return $this->success('修改成功','/a_Classify');
        }
        return $this->error('修改失败');
        
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete(MClassify $ma, $id)
    {
        $data = $ma->destroy($id);
        if($data){
            return $this->success('删除成功','/a_classify.html');
            }
            return $this->error('删除失败');
    }
}
