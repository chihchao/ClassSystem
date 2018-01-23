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
		}
	}
}

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["LINK"]["DELETE"]);

if ($folder_id == 0){
	$up_folder_id = 0;
}else{
	$str = "Select up_folder_id From link_folder Where folder_id = '" . func_escape_string($folder_id) . "'";
	$result = QueryDatabase($str);
	list($up_folder_id) = mysql_fetch_row($result);
}

$folder_array = array();
$str = "Select up_folder_id, folder_id From link_folder Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_up_folder_id, $array_folder_id) = mysql_fetch_row($result)){
	$folder_array[$array_up_folder_id][$array_folder_id] = $array_folder_id;
}

$document_array = array();
$str = "Select document_id, folder_id, document_file From link_document Where teacher_id = '" . func_escape_string($teacher_id) . "'";
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

$str = "Delete From link_folder Where" . $delete_folder_str;
QueryDatabase($str);
$str = "Delete From link_document Where" . $delete_document_str;
QueryDatabase($str);
header("location:Link.php?teacher_id=" . $teacher_id . "&folder_id=" . $up_folder_id);
?>