<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$folder_id = intval($_POST["folder_id"]);
$document_title = StripSlashes($_POST["document_title"]);
$document_content = StripSlashes($_POST["document_content"]);

if (empty($teacher_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["LINK"]["ADD"]);

$check_ltrim = ltrim($document_title);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的標題沒填或是只填空白，這樣無法加入連結。');");
	echo("history.back();");
	echo("</script>");
	exit();
}
$check_ltrim = ltrim($document_content);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('你的網址沒填或是只填空白，這樣無法加入連結。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "insert into link_document (teacher_id, folder_id, document_title, document_content, document_time) Values ('" . func_escape_string($teacher_id) . "', '" . func_escape_string($folder_id) . "', '" . func_escape_string($document_title) . "', '" . func_escape_string($document_content) . "', now())";
QueryDatabase($str);

header("location:Link.php?teacher_id=" . $teacher_id . "&folder_id=" . $folder_id);
?>