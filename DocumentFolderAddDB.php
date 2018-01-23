<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$folder_id = intval($_POST["folder_id"]);
$folder_name = StripSlashes($_POST["folder_name"]);
$folder_explain = StripSlashes($_POST["folder_explain"]);

if (empty($teacher_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DOCUMENT"]["ADD"]);

$check_ltrim = ltrim($folder_name);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的資料夾名稱沒填或是只填空白，這樣無法加入資料夾。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "insert into document_folder (teacher_id, up_folder_id, folder_name, folder_explain, folder_time) Values ('" . func_escape_string($teacher_id) . "', '" . func_escape_string($folder_id) . "', '" . func_escape_string($folder_name) . "', '" . func_escape_string($folder_explain) . "', now())";
QueryDatabase($str);
header("location:Document.php?teacher_id=" . $teacher_id . "&folder_id=" . $folder_id);
?>