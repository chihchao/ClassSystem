<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$author = StripSlashes($_POST["author"]);
$title = StripSlashes($_POST["title"]);
$content = StripSlashes($_POST["content"]);

if (empty($teacher_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["BOARD"]["POST"]);

$check_author = ltrim($author);
if (empty($check_author)){
	echo("<script language=javascript>");
	echo("alert('你的單位沒填或是只填空白，這樣無法加入你的公告事項。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$check_title = ltrim($title);
if (empty($check_title)){
	echo("<script language=javascript>");
	echo("alert('你的公告事項沒填或是只填空白，這樣無法加入你的公告事項。');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "insert into board (teacher_id, author, title, content, date_time) Values ('" . $teacher_id . "', '" . func_escape_string($author) . "', '" . func_escape_string($title) . "', '" . func_escape_string($content) . "', now())";
QueryDatabase($str);
header("location:Board.php?teacher_id=" . $teacher_id);
?>