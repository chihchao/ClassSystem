<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$subject_id = intval($_POST["subject_id"]);

if (empty($teacher_id)) exit();
if (empty($subject_id)) header("location:Discuss.php?teacher_id=" . $teacher_id);

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DISCUSS"]["DELETE"]);

$str = "Delete From discuss_reply Where teacher_id = '" . $teacher_id . "' And subject_id = '" . $subject_id . "'";
QueryDatabase($str);
$str = "Delete From discuss_subject Where teacher_id = '" . $teacher_id . "' And subject_id = '" . $subject_id . "'";
QueryDatabase($str);
header("location:Discuss.php?teacher_id=" . $teacher_id);
?>