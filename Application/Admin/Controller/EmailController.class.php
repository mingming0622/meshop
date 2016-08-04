<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: yangweijie <yangweijiester@gmail.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Controller;

/**
 * 后台配置控制器
 * @author mingming <zhumingming_12346@163.com>
 */
class EmailController extends AdminController
{

    /**
     * 后台菜单首页
     * @return none
     */
    public function email()
    {
        $info = M('Email')->select();
        int_to_string($info);
        $this->assign('list', $info);
        $this->display();
    }

    /**
     * 邮箱添加
     *
     */
    public function add()
    {
        $mod = D('Email');
        if (IS_GET) {
            $info = M('Email')->where(array('id' => $_GET['id']))->find();
            $this->assign('info', $info);
            $this->display();
        } elseif (IS_POST) {
            $data = $mod->create();
            if ($data) {
                if ($data['id']) {
                    $edit = M('Email')->where(array('id' => $data['id']))->save($data);
                    if ($edit) {
                        $this->success('修改成功', U('email'));
                    } else {
                        $this->error('修改失败');
                    }
                } else {
                    $infos = M('Email')->add($data);
                    if ($infos) {
                        $this->success('添加成功', U('email'));
                    } else {
                        $this->error('添加失败');
                    }
                }
            } else {
                $this->error($mod->getError());
            }
        }
    }

    /***
     * 更改邮箱状态-> 启用禁用
     */
    public function del($method=null){
        $id = array_unique((array)I('id'));
        $id= is_array($id) ?  implode(',', $id) :$id;
        if(empty($id)){
            $this->error('请选择数据');
        }
        $map['id']=array('in',$id);
        switch(strtolower($method)){
            case'resumeuser':
                    $this->resume('Email',$map);
                break;
            case'forbiduser':
                $this->forbid('Email',$map);
                break;
            default:
                $this->error('参数非法');
        }
    }
}
