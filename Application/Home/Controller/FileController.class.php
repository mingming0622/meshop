<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

/**
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */

class FileController extends HomeController {
	/**
	 * return  0  上传成功  1 上传失败
	 *
	 */
	public function uploadImg(){
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
					$image->thumb(100, 100,\Think\Image::IMAGE_THUMB_FIXED)->save($config['rootPath'].$v['savepath'].$v['savename']);
					//unlink($savepath);
					$info[$k]['path']=$config['rootPath'].$v['savepath'].$v['savename'];
					$map['path']=$info[$k]['path'];
					$map['create_time']=time();
					$fild=M('Picture')->add($map);

				$id=	M('Picture')->where(array('path'=>$map['path']))->getField('id');

					if($fild){
							$array=array(
								'status'=>1,
								'src'=>$info[$k]['path'],
								'id'=>$id,

							);
						$this->ajaxReturn($array);
					}
				}
			}else{
				$data['error']=$upload->getError();
			}
		}

	}

	/* 下载文件 */
	public function download($id = null){
		if(empty($id) || !is_numeric($id)){
			$this->error('参数错误！');
		}

		$logic = D('Download', 'Logic');
		if(!$logic->download($id)){
			$this->error($logic->getError());
		}

	}
}
