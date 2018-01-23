<?php
function resizeImage($source, $thumbnail, $max_width, $max_height){
	if (file_exists($source) && !empty($thumbnail)){
		$source_size = getimagesize($source); //圖檔大小
		if ($source_size[0] < $max_width && $source_size[1] < $max_height) {
			//圖檔寬、高都小於縮圖大小
			$thumbnail_size[0] = $source_size[0];
			$thumbnail_size[1] = $source_size[1];
		} else {
			$source_ratio = $source_size[0] / $source_size[1]; // 計算寬/高
			$thumbnail_ratio = $max_width / $max_height;
			if ($thumbnail_ratio > $source_ratio) {
				$thumbnail_size[1] = $max_height;
				$thumbnail_size[0] = $max_height * $source_ratio;
			}else{
				$thumbnail_size[0] = $max_width;
				$thumbnail_size[1] = $max_width / $source_ratio;
			}
		}
		if (function_exists('imagecreatetruecolor')) {
			$thumbnail_img = imagecreatetruecolor($thumbnail_size[0], $thumbnail_size[1]);
		} else {
			$thumbnail_img = imagecreate($thumbnail_size[0], $thumbnail_size[1]);
		}
		switch ($source_size[2]) {
			case 1:
				$source_img = imagecreatefromgif($source);
				break;
			case 2:
				$source_img = imagecreatefromjpeg($source);
				break;
			case 3:
				$source_img = imagecreatefrompng($source);
				break; 
			default:
				return false;
				break; 
		} 
		imagecopyresized($thumbnail_img, $source_img, 0, 0, 0, 0, $thumbnail_size[0], $thumbnail_size[1], $source_size[0], $source_size[1]);
		imagejpeg($thumbnail_img, $thumbnail, 100);
		imagedestroy($source_img);
		imagedestroy($thumbnail_img);
		return true;
	}else{
		return false;
	}
}
?>