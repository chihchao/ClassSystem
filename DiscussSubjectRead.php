<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$subject_id = intval($_GET["subject_id"]);

if (empty($teacher_id)) exit();
if (empty($subject_id)) header("location:Discuss.php?teacher_id=" . $teacher_id);

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$str = "Update discuss_subject Set subject_read = subject_read + 1 Where teacher_id = '" . func_escape_string($teacher_id) . "' And subject_id = '" . func_escape_string($subject_id) . "'";
QueryDatabase($str);
header("location:DiscussSubject.php?teacher_id=" . $teacher_id . "&subject_id=" . $subject_id);
?>