<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$calendar_id = intval($_POST["calendar_id"]);

if (empty($teacher_id)) exit();
if (empty($calendar_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["CALENDAR"]["DELETE"]);

$str = "Select year, month From calendar Where teacher_id = '" . $teacher_id . "' And calendar_id = '" . $calendar_id . "'";
$result = QueryDatabase($str);
if (!(list($year, $month) = mysql_fetch_row($result))) exit();

$str = "Delete From calendar Where teacher_id = '" . $teacher_id . "' And calendar_id = '" . $calendar_id . "'";
QueryDatabase($str);

header("location:Calendar.php?teacher_id=" . $teacher_id . "&year=" . $year . "&month=" . $month);
?>