<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class ShareController extends HomeController {

	//分享首页
    public function index(){

        $this->login();
       $info= M('Share')->select();
        $this->assign('category',$info);
        $this->display('lists');
}

    /***
     * 分享列表
     */
    public function lonk(){

       $share=M('Share')->where(array('id'=>I('id')))->find();
        $where['id']=array('in',$share['img']);
        $share['imgs']=M('Picture')->where(array('id'=>$where['id']))->field('path')->select();
        $share['imgs']=$this->fieldAll('picture',$where,'path');
//        print_r($share);
        $this->assign('info',$share);
        $this->display();
    }


    /**
     * 分享添加
     */

    public function add(){
        if($_POST){
               $_POST['content']=trim($_POST['content']);
              $_POST['creat_time']=time();
            $_POST['uid']=is_login();
           $share=M('share')->add($_POST);
            if($share){
                    $info=array(
                        'status'=>1,
                        'info'=>'上传成功',
                        'jump'=>U('Share/index'),
                    );
                $this->ajaxReturn($info);
            }else{
                $info=array(
                    'status'=>0,
                    'info'=>'上传失败',
                    'jump'=>U('Share/add'),
                );
                $this->ajaxReturn($info);
            }
        }
        $this->display();
    }
}