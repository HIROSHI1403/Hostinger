<?php

require_once 'userfunctions.php';

$get_image_id = $_GET['id'];

$extensions = array(
		IMAGETYPE_GIF => "gif",
		IMAGETYPE_JPEG => "jpg",
		IMAGETYPE_PNG => "png",
		IMAGETYPE_SWF => "swf",
		IMAGETYPE_PSD => "psd",
		IMAGETYPE_BMP => "bmp",
		IMAGETYPE_TIFF_II => "tiff",
		IMAGETYPE_TIFF_MM => "tiff",
		IMAGETYPE_JPC => "jpc",
		IMAGETYPE_JP2 => "jp2",
		IMAGETYPE_JPX => "jpx",
		IMAGETYPE_JB2 => "jb2",
		IMAGETYPE_SWC => "swc",
		IMAGETYPE_IFF => "iff",
		IMAGETYPE_WBMP => "wbmp",
		IMAGETYPE_XBM => "xbm",
		IMAGETYPE_ICO => "ico"
);

$mysqli = new mysqli($mySQLAddress,$mainDbUserName,$mainDbPass,$mainDbName);
if ($mysqli->connect_error){
	$mysqli->close();
	exit();
}else {
	$query_image_str = "SELECT comp_info.*,job_info.*,image.* FROM (comp_info INNER JOIN job_info ON comp_info.comp_id = job_info.comp_id) INNER JOIN image ON job_info.job_info_id = image.job_info_id";
	$result_image = $mysqli->query($query_image_str);
	if (!$result_image){
		exit();
	}else {
		while ($row_image = $result_image->fetch_assoc()){
// 			var_dump(image_type_to_mime_type($row_image['type']));
// 			var_dump($row_image['id']);
// 			var_dump($row_image['name']);
// 			var_dump($get_image_id);
// 			var_dump($row_image['job_info_id']);
// 			var_dump($get_image_id == $row_image['job_info_id']);
			if ($get_image_id == $row_image['id']){
				header('Content-Type: ' . image_type_to_mime_type($row_image['type']));
				echo $row_image['raw_data'];
				exit();
			}
// 			if ($get_image_id == $row_image['job_info_id']){
// 	            header('Content-Type: ' .image_type_to_mime_type($row_image['type']));
// 	            echo $row_image['raw_data'];
// 			}
// 			function convert_img($img_data) {
// 				$base64 = base64_encode($img_data);
// 				$mime = 'image/jpg';
// 				return 'data:'.$mime.';base64,'.$base64;
// 			}
// 			echo('<img src="'.convert_img($img_src).'">');
			
			
		}
	}
}

?>
