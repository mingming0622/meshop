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
class BrandModel extends Model{

    protected $_validate = array(
        array('name', 'require', '品牌不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '', '品牌已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
        array('url', 'require', '品牌网址不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('url', '', '品牌网址已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
        array('name', '', '分类名称已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
        array('desc', '1,140', '品牌描述不能超过140个字符', self::MUST_VALIDATE, 'length', self::MODEL_BOTH),
        array('url', '', 'URL已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
        array('url', 'url', 'URL格式不正确', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),

    );
}
