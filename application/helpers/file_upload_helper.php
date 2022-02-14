<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('fileuplodCi')) {
  function fileuplodCi($file,$target_dir) {
    $CI = get_instance();
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0777, true);
		}
		$config['upload_path'] = $target_dir;
		//$config['file_name']   = strtotime(date('Y-m-d H:i:s'));
		if($file=='userImage'){
			$config['allowed_types'] = 'png|jpg|jpeg';
			/*$config['max_size'] = '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';*/
		}elseif ($file=='birthDateProof') {
			$config['allowed_types'] = 'pdf';
			//$config['max_size'] = '1024';
		}elseif ($file=='casteAttachFile') {
			$config['allowed_types'] = 'pdf';
			//$config['max_size'] = '1024';
			}elseif ($file=='attachNocFile') {
			$config['allowed_types'] = 'pdf';
			//$config['max_size'] = '1024';
		}elseif ($file=='refereesEmployProof') {
			$config['allowed_types'] = 'pdf';
			//$config['max_size'] = '1024';
		}elseif ($file=='signature') {
			$config['allowed_types'] = 'png|jpg|jpeg';
			/*$config['max_size'] = '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';*/
		}else{
			$config['allowed_types'] = 'pdf';
		}
		$CI->load->library('upload', $config);
		$CI->upload->initialize($config);
		if ( ! $CI->upload->do_upload($file)) {
			$image = $CI->upload->display_errors('', '');
			unset($config);
			return $image;
		}else{
			$imageData = $CI->upload->data();
			$image = $target_dir.'/'. $imageData['file_name'];
			unset($config);
			return $image;
		}

	$CI->image_lib->clear();







		/*$config['upload_path'] = $target_dir;
		$config['file_name']   = strtotime(date('Y-m-d H:i:s'));
			$config['allowed_types'] = $allowed_types;
			$config['max_size'] = $max_size;
			$config['max_width'] = $max_width;
			$config['max_height'] = $max_height;
		
			$CI->load->library('upload', $config);
				$CI->upload->initialize($config);

		if ( ! $CI->upload->do_upload($file)) {
			$image = $CI->upload->display_errors('', '');
			unset($config);
			return $image;
		}else{
			$imageData = $CI->upload->data();
			$image = $target_dir.'/'. $imageData['file_name'];
			unset($config);
			return $image;
		}

		$CI->image_lib->clear();*/




   
  }
}
