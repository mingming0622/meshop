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
 * @author yangweijie <yangweijiester@gmail.com>
 */
class CommodController extends AdminController
{

    /**
     * 商品列表
     * @return none
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 商品属性
     */
    public function artr()
    {
        $this->display();
    }


    /***
     * 属性添加
     */

    public function artr_add()
    {
        $this->display();
    }

    /***
     * 商品规格
     */
    public function gui()
    {
        $this->display();
    }

    /***
     * 商品品牌
     */
    public function brand()
    {
        $brand = M('Brand')->select();

        int_to_string($brand);

        $this->assign('list', $brand);

        $this->display();
    }

    /***
     * 品牌新增
     */
    public function brand_add()
    {
        if (IS_GET) {
            $cate = M('cate')->where(array('pid' => 0))->field('id,name')->select();
            $this->assign('cate', $cate);
            $this->display();
        } elseif (IS_POST) {
            $mod = D('Brand');
            $data = $mod->create();
            if ($data) {
                if ($data['id']) {
                    $data['cat_name'] = M('cate')->where(array('id' => $data['parent_cat_id']))->getfield('name');
                    $data['desc'] = trim($data['desc']);
                    $red = M('Brand')->where(array('id' => $data['id']))->save($data);
                } else {
                    $data['desc'] = trim($data['desc']);
                    $data['cat_name'] = M('cate')->where(array('id' => $data['parent_cat_id']))->getfield('name');
                    $red = M('Brand')->add($data);
                }
                if ($red) {
                    $this->success('品牌添加成功', U('brand'));
                } else {
                    $this->success('品牌添加失败', U('brand'));
                }
            } else {
                $this->error($mod->getError());
            }
        }
    }

    public function brandedit()
    {
        if (IS_GET) {
            $info = M('Brand')->where(array('id' => I('id')))->find();
            $cate = M('cate')->where(array('pid' => 0))->field('id,name')->select();
            $this->assign('cate', $cate);

            $this->assign('info', $info);
            $this->display('brand_add');
        } elseif (IS_POST) {
            $mod = D('Brand');
            $data = $mod->create();
            if ($data) {
                if ($data['id']) {
                    $data['cat_name'] = M('cate')->where(array('id' => $data['parent_cat_id']))->getfield('name');
                    $data['desc'] = trim($data['desc']);
                    $red = M('Brand')->where(array('id' => $data['id']))->save($data);
                } else {
                    $data['desc'] = trim($data['desc']);
                    $data['cat_name'] = M('cate')->where(array('id' => $data['parent_cat_id']))->getfield('name');
                    $red = M('Brand')->add($data);
                }
                if ($red) {
                    $this->success('品牌添加成功', U('brand'));
                } else {
                    $this->success('品牌添加失败', U('brand'));
                }
            } else {
                $this->error($mod->getError());
            }
        }

    }

    /****
     * 商品分类
     *
     */
    public function cate()
    {
        $this->display();
    }

    /***
     * 分类添加
     */
    public function category()
    {
        $mod = D('Cate');
        if (IS_POST) {
            $data = $mod->create();
            if ($data) {
                if ($data['commission_rate'] >= 100) {
                    $this->error('佣金比例不能超过100');
                }
                if ($data['id']) {
                    $red = $mod->update($data);
                } else {
                    $red = $mod->update($data);
                }
                if ($red) {
                    $this->success('分类添加成功', U('cate'));
                } else {
                    $this->success('分类添加失败', U('cate'));
                }
            } else {
                $this->error($mod->getError());
            }
        } elseif (IS_GET) {
            $cate = M('cate')->where(array('pid' => 0))->field('id,name')->select();
            $this->assign('cate', $cate);
            $this->display();

        }
    }


    /***
     * 商品类型
     */
    public function type()
    {
        $this->display();
    }

    /***
     * 商品类型添加
     */

    public function typeAdd()
    {
        if (IS_GET) {
            $this->display();
        } elseif (IS_POST) {
            if ($_POST['name'] == '') {
                $this->error('类型不能为空');
            }
            $return = M('GoodsType')->add($_POST);
            if (!$return) {
                $this->error('商品类型添加失败');
            } else {
                $this->success('商品类型添加成功', U('type'));
            }
        }
    }


    public function change()
    {
        $id = I('pid');
        $ajax = M('cate')->where(array('pid' => $id))->field('id,name')->select();
        $this->ajaxReturn($ajax);
    }
}
