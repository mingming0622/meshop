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
class HomeController extends Controller {

	/* 空操作，用于输出404页面 */
	public function _empty(){
		$this->redirect('Index/index');
	}


    protected function _initialize(){
        /* 读取站点配置 */
        $config = api('Config/lists');
        C($config); //添加配置

        if(!C('WEB_SITE_CLOSE')){
            $this->error('站点已经关闭，请稍后访问~');
        }
    }

	/* 用户登录检测 */
	protected function login(){
		/* 用户登录检测 */
		is_login() || $this->error('您还没有登录，请先登录！', U('User/login'));
	}


    /**
     * 获取单一字段值数组
     * @access protected
     * @param sttring $table
     * @param string|array $where
     * @param string $field
     * @return bool|mixed
     */
    protected function fieldAll($table,$where,$field){
        if(empty($table) || empty($where) || empty($field)){
            return false;
        }
        $model=M($table);
        $fieldO=$field=='id' ? 'id':$field.",id as ids";
        $relus=$model->field($fieldO)->where($where)->select();
//        print_r($relus);exit;
        foreach($relus as $k=>$v){
            foreach($v as $ka=>$va) {
                if($ka!='ids'){
                    $field=array_search($va,$v);
                    $data[$field][$v['ids']]=$v[$field];
                }
            }
        }
        return $data;
    }

/**
* 处理图片文件 角度旋转
* @param $path 图片文件路径
* @return resource
*/
    public function iosImgHandle($path)
    {
        //print_r($path);
        $image = imagecreatefromstring(file_get_contents($path));
        $exif = exif_read_data($path);
        /*echo "<PRE>";
        print_r($exif);exit;*/
        if(!empty($exif['Orientation'])) {
            switch($exif['Orientation']) {
                case 8:
                    $image = imagerotate($image,90,0);
                    break;
                case 3:
                    $image = imagerotate($image,180,0);
                    break;
                case 6:
                    $image = imagerotate($image,-90,0);
                    break;
            }
        }
        /*header("Content-Type: image/jpeg");
        imagejpeg($image);*/
        return $image;
        /*

        header("Content-Type: image/jpeg");
        imagejpeg($img);

        */
    }

    /**
     * 图片上传
     * @param $explode_photo
     * @return mixed
     */
    public function uploadImg(){

//		print_r($_FILES);
//		exit;
        foreach ($_FILES as $v) {
//			 $names=explode('.',$v['name']);
//			if($v['error']!=0){
//				echo 2;
//				exit;
//			}
//			 $str='';
//			for($i=0;$i<=9;$i++){
//				$str.=rand(0,9);
//			}
//			$time = date('Ymd', time());
//			/**获得新的图片名称**/
//			  $name = $time .$str.'.'.$names['1'];
//			$dir='./Public/uplodes/share'.date('ymd',time());
//			if(!is_dir($dir)){
//				mkdir($dir);
//			}
//
//		$file=move_uploaded_file($v['tmp_name'],$dir."/".$name);  //移动的位置


            //echo 9;exit;
            $config = array(
                'maxSize'    =>    3145728,
                'rootPath'   =>'./Public',
                'savePath'   =>    '/Uploads/share/',
                'saveName'   =>    array('uniqid',''),
                'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub'    =>    true,
                'subName'    =>    array('date','Ymd'),
                'hash'       =>     false,
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $info   =   $upload->upload();
            if($info){
                $image = new \Think\Image();
                foreach ($info  as $k=>$v) {
                    $savepath=$config['rootPath'].$v['savepath'].$v['savename'];
                    $image->open($savepath);
                    $image->thumb(50, 50,\Think\Image::IMAGE_THUMB_FIXED)->save($config['rootPath'].$v['savepath'].$v['savename']);
                    //unlink($savepath);
                    $info[$k]['path']=$config['rootPath'].$v['savepath'].$v['savename'];
                    $info[$k]['create_time']=time();
                }
                $data['success']=$info;
            }else{
                $data['error']=$upload->getError();
            }


        }

    }

}
