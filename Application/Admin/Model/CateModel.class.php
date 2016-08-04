<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;

/**
 * 分类模型
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
class CateModel extends Model{

    protected $_validate = array(
        array('name', 'require', '分类名称不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '', '分类名称已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),

    );

        public function update(){
            $data = $this->create($_POST);
            if(empty($data)){
                return false;
            }
            if(empty($data['id'])){
               $return= $this->add();

            }else{
                $return= $this->save();
            }
             return $return;
        }

}
