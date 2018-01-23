<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$board_id = intval($_POST["board_id"]);
$author = StripSlashes($_POST["author"]);
$title = StripSlashes($_POST["title"]);
$content = StripSlashes($_POST["content"]);

if (empty($teacher_id)) exit();
if (empty($board_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["BOARD"]["EDIT"]);

$check_author = ltrim($author);
if (empty($check_author)){
	echo("<script language=javascript>");
	echo("alert('你的單位沒填或是只填空白，這樣無法修改你的公告事項。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$check_title = ltrim($title);
if (empty($check_title)){
	echo("<script language=javascript>");
	echo("alert('你的公告事項沒填或是只填空白，這樣無法修改你的公告事項。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "Update board Set author = '" . func_escape_string($author) . "', title = '" . func_escape_string($title) . "', content = '" . func_escape_string($content) . "', date_time = now() Where teacher_id = '" . $teacher_id . "' And board_id = '" . $board_id . "'";
QueryDatabase($str);
header("location:Board.php?teacher_id=" . $teacher_id);
?>