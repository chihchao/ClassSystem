<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$calendar_id = intval($_POST["calendar_id"]);
$author = StripSlashes($_POST["author"]);
$content = StripSlashes($_POST["content"]);
$year = intval($_POST["year"]);
$month = intval($_POST["month"]);

if (empty($teacher_id)) exit();
if (empty($calendar_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["CALENDAR"]["EDIT"]);

$check_ltrim = ltrim($author);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('�i�K���H�S��άO�u��ťաA�o�˵L�k�[�J�A���O�Ƥ��e�C');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$check_ltrim = ltrim($content);
if (empty($check_ltrim)){
	echo("<script language=javascript>");
	echo("alert('�A���O�Ƥ��e�S��άO�u��ťաA�o�˵L�k�[�J�A���O�Ƥ��e�C');");
	echo("history.back();");
	echo("</script>");
	exit();
}

$str = "Update calendar Set author = '" . func_escape_string($author) . "', content = '" . func_escape_string($content) . "', date_time = now() Where teacher_id = '" . $teacher_id . "' And calendar_id = '" . $calendar_id . "'";
QueryDatabase($str);
header("location:Calendar.php?teacher_id=" . $teacher_id . "&year=" . $year . "&month=" . $month);
?>