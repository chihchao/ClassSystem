<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$author = StripSlashes($_POST["author"]);
$content = StripSlashes($_POST["content"]);
$year = intval($_POST["year"]);
$month = intval($_POST["month"]);
$day = intval($_POST["day"]);

if (empty($teacher_id)) exit();
if (empty($year) || empty($month) || empty($day)) exit();
$year = (int) $year;
$month = (int) $month;
$day = (int) $day;

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["CALENDAR"]["POST"]);

if (!checkdate($month, $day, $year)){
	echo("<script language=javascript>");
	echo("alert('�A�ҿ�J��������O���Ī�����A�Э��s��ܤ���C');");
	echo("history.back();");
	echo("</script>");
	exit();
}

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

$str = "insert into calendar (teacher_id, year, month, day, author, content, date_time) Values ('" . func_escape_string($teacher_id) . "', '" . func_escape_string($year) . "', '" . func_escape_string($month) . "', '" . func_escape_string($day) . "', '" . func_escape_string($author) . "', '" . func_escape_string($content) . "', now())";
QueryDatabase($str);
header("location:Calendar.php?teacher_id=" . $teacher_id . "&year=" . $year . "&month=" . $month);
?>