<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;

/**
 * 文档基础模型
 */
class EmailModel extends Model{

    protected $_validate = array(
        array('email', 'require', '服务器地址不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('account', 'require', '账号不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('password', 'require', '密码不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('port', 'require', '端口号不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('account', '', '账号已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),



    );


}
