<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$board_id = intval($_POST["board_id"]);

if (empty($teacher_id)) exit();
if (empty($board_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["BOARD"]["DELETE"]);

$str = "Delete From board Where teacher_id = '" . $teacher_id . "' And board_id = '" . $board_id . "'";
QueryDatabase($str);
header("location:Board.php?teacher_id=" . $teacher_id);
?>