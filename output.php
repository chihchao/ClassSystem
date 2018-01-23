<?php
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
if (empty($teacher_id))
{
	echo('<form method="get" action="">teacher_id:<input type="text" name="teacher_id"><input type="submit"></form>');
	exit();
}

$file_path['srce_dm'] = "UploadDocument/";
$file_path['srce_pt'] = "UploadPhoto/";
$file_path['dest'] = "output/" . $teacher_id . "/";


//function===================
function list_folder($list_folder_id, $path, $type)
{
	global $teacher_id, $file_path, $folder_array, $file_array;
	//if ($list_folder_id == "root" && is_array($file_array[0])) $file_array[$list_folder_id] = $file_array[0];
	if (is_array($file_array[$list_folder_id]))
	{
		while(list($array_file_id) = each($file_array[$list_folder_id]))
		{
			$file_name = $file_array[$list_folder_id][$array_file_id];
			if (!empty($file_name))
			{
				$srce_file = $file_path[$type] . $file_name;
				$dest_file = $file_path['dest'] . $path . $file_name;
				if (file_exists($srce_file) && is_dir($file_path['dest'] . $path)) if (!copy($srce_file, $dest_file)) return false;
			}
		}
	}
	if (is_array($folder_array[$list_folder_id]))
	{
		while(list($array_folder_id) = each($folder_array[$list_folder_id]))
		{
			if (!mkdir($file_path['dest'] . $path . $folder_array[$list_folder_id][$array_folder_id] . "/", 0755)) return false;
			list_folder($array_folder_id, $path . $folder_array[$list_folder_id][$array_folder_id] . "/", $type);
		}
	}
}

//page=======================
NoCache();

LinkDatabase();

mkdir($file_path['dest'], 0755);

$folder_array = array();
$folder_array["root"][0] = "文件區";
$str = "Select folder_id, folder_name, up_folder_id From document_folder Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_folder_id, $array_folder_name, $up_array_folder_id) = mysql_fetch_row($result)){
	$folder_array[$up_array_folder_id][$array_folder_id] = str_replace('/', '-', $array_folder_name);
}
$file_array = array();
$str = "Select folder_id, document_id, document_file From document_document Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_folder_id, $array_file_id, $array_file_file) = mysql_fetch_row($result)){
	$file_array[$array_folder_id][$array_file_id] = str_replace('/', '-', $array_file_file);
}

$list_folder_id = "root";
list_folder($list_folder_id, "", "srce_dm");

$folder_array = array();
$folder_array["root"][0] = "相片區";
$str = "Select folder_id, folder_name, up_folder_id From photo_folder Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_folder_id, $array_folder_name, $up_array_folder_id) = mysql_fetch_row($result)){
	$folder_array[$up_array_folder_id][$array_folder_id] = str_replace('/', '-', $array_folder_name);
}
$file_array = array();
$str = "Select folder_id, document_id, document_file From photo_document Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_folder_id, $array_file_id, $array_file_file) = mysql_fetch_row($result)){
	$file_array[$array_folder_id][$array_file_id] = str_replace('/', '-', $array_file_file);
}
$list_folder_id = "root";
list_folder($list_folder_id, "", "srce_pt");
?>
success!