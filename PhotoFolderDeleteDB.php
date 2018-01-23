<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$folder_id = intval($_POST["folder_id"]);

if (empty($teacher_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;

//function===================
function get_delete_str($delete_folder_id){
	global $folder_array, $document_array, $deletefile_array, $delete_folder_str, $delete_document_str;

	if (is_array($folder_array[$delete_folder_id])){
		while (list($delete_down_folder_id) = each($folder_array[$delete_folder_id])){
			$delete_folder_str = $delete_folder_str . " Or folder_id = '" . $delete_down_folder_id . "'";
			get_delete_str($delete_down_folder_id);
		}
	}

	if (is_array($document_array[$delete_folder_id])){
		while (list($delete_document_id) = each($document_array[$delete_folder_id])){
			$delete_document_str = $delete_document_str . " Or document_id = '" . $delete_document_id . "'";
			if (!empty($document_array[$delete_folder_id][$delete_document_id])) $deletefile_array[$delete_document_id] = "UploadPhoto/" . $document_array[$delete_folder_id][$delete_document_id];
		}
	}
}

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["PHOTO"]["DELETE"]);

if ($folder_id == 0){
	$up_folder_id = 0;
}else{
	$str = "Select up_folder_id From photo_folder Where folder_id = '" . func_escape_string($folder_id) . "'";
	$result = QueryDatabase($str);
	list($up_folder_id) = mysql_fetch_row($result);
}

$folder_array = array();
$str = "Select up_folder_id, folder_id From photo_folder Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_up_folder_id, $array_folder_id) = mysql_fetch_row($result)){
	$folder_array[$array_up_folder_id][$array_folder_id] = $array_folder_id;
}

$document_array = array();
$deletefile_array = array();
$str = "Select document_id, folder_id, document_file From photo_document Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_document_id, $array_folder_id, $array_document_file) = mysql_fetch_row($result)){
	$document_array[$array_folder_id][$array_document_id] = $array_document_file;
}

$delete_folder_str = "";
$delete_document_str = "";

get_delete_str($folder_id);
if ($folder_id == 0) {
	$delete_folder_str = substr($delete_folder_str, 3);
}else{
	$delete_folder_str = " folder_id = '" . $folder_id . "'" . $delete_folder_str;
}
$delete_document_str = substr($delete_document_str, 3);

while(list($delete_document_id) = each($deletefile_array)){
	unlink($deletefile_array[$delete_document_id]);
	if (file_exists('UploadPhoto/tn_' . $delete_document_id)) unlink('UploadPhoto/tn_' . $delete_document_id);
}
$str = "Delete From photo_folder Where" . $delete_folder_str;
QueryDatabase($str);
$str = "Delete From photo_document Where" . $delete_document_str;
QueryDatabase($str);
header("location:Photo.php?teacher_id=" . $teacher_id . "&folder_id=" . $up_folder_id);
?>