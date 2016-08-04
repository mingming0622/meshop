<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use Think\Controller;

/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用分组名称
 */
class AjaxController extends Controller {

	/**
     * 邮件发送
     * parm: user   收件人地址
     * parm:title  标题
     * parm: body   内容
     */

    public function mail($user,$title=null,$body=null){
        $mai= M('Email')->where(array('id'=>1,'status'=>1))->find();
        $mail = new \Common\Util\PHPMailer();
        $mail->IsSMTP(); // 使用SMTP方式发送
        $mail->CharSet='UTF-8';// 设置邮件的字符编码
        $mail->Host =$mai['email']; // 您的企业邮局服务器
        //$mail->Port = 25; // 设置端口
        $mail->SMTPAuth = true; // 启用SMTP验证功能
        $mail->Username =$mai['account']; // 邮局用户名(请填写完整的email地址)
        $mail->Password = $mai['password']; // 邮局密码
        $mail->From = $mai['account']; //邮件发送者email地址
        $mail->FromName = "阿拉丁龙哥";
        $mail->AddAddress($user);//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")

        $mail->IsHTML(true); // set email format to HTML //是否使用HTML格式
        $mail->Subject = $title;//"PHPMailer测试邮件"; //邮件标题
        $mail->Body = "<b>'.$body.'</b>"; //邮件内容
        if(!$mail->Send())
        {
            echo "邮件发送失败. <p>";
            echo "错误原因: " . $mail->ErrorInfo;
        }else{
            echo "发送成功了,嘛嘛再也不担心我不会发邮件了!";
        }
    }

}
