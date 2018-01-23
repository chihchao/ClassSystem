<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$folder_id = intval($_GET["folder_id"]);
$up_folder_id = intval($_GET["up_folder_id"]);

if (empty($teacher_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;
if (empty($up_folder_id) || $up_folder_id < 0) $up_folder_id = 0;

//function===================
function check_folder($check_folder_id){
	global $up_folder_id, $folder_array, $move_folder;
	if (is_array($folder_array[$check_folder_id])){
		while(list($array_folder_id) = each($folder_array[$check_folder_id])){
			if ($array_folder_id == $up_folder_id){
				$move_folder = 0;
				break;
			}
			check_folder($array_folder_id);
		}
	}
}

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["LINK"]["MOVE"]);

if ($folder_id == 0){
	echo("<script language=javascript>");
	echo("alert('連結區為最上層資料夾，無法搬移。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

if ($folder_id == $up_folder_id){
	echo("<script language=javascript>");
	echo("alert('無法將資料夾搬移至自己本身資料夾。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

if ($up_folder_id != 0){
	$str = "Select folder_id From link_folder Where teacher_id = '" . func_escape_string($teacher_id) . "' And folder_id = '" . func_escape_string($up_folder_id) . "'";
	$result = QueryDatabase($str);
	if (!(list($up_folder_id) = mysql_fetch_row($result))) exit();
}

$folder_array = array();
$str = "Select folder_id, folder_name, up_folder_id From link_folder Where teacher_id = '" . func_escape_string($teacher_id) . "'";
$result = QueryDatabase($str);
while (list($array_folder_id, $array_folder_name, $up_array_folder_id) = mysql_fetch_row($result)){
	$folder_array[$up_array_folder_id][$array_folder_id] = htmlspecialchars($array_folder_name);
}

$move_folder = 1;
check_folder($folder_id);
if (!$move_folder){
	echo("<script language=javascript>");
	echo("alert('無法將資料夾搬移至自己下層資料夾。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "Update link_folder Set up_folder_id = '" . func_escape_string($up_folder_id) . "' Where teacher_id = '" . $teacher_id . "' And folder_id = '" . $folder_id . "'";
QueryDatabase($str);
header("location:Link.php?teacher_id=" . $teacher_id . "&folder_id=" . $folder_id);
?>