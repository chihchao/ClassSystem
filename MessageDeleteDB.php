<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$message_id = intval($_POST["message_id"]);

if (empty($teacher_id)) exit();
if (empty($message_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["MESSAGE"]["DELETE"]);

$str = "Delete From message Where teacher_id = '" . $teacher_id . "' And message_id = '" . $message_id . "'";
QueryDatabase($str);
header("location:Message.php?teacher_id=" . $teacher_id);
?>