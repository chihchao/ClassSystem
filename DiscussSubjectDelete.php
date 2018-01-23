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

$login_user = login($PAGE_AUTHENTICATE_USER["DISCUSS"]["DELETE"]);
?>
<FORM METHOD=POST ACTION="DiscussSubjectDeleteDB.php" name="dform" id="dform">
<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
<INPUT TYPE="hidden" name="subject_id" value="<? echo($subject_id); ?>">
<p align="center">
你真的要刪除這篇討論主題嗎？
<br />
<input type="submit" value="確定" /><input type="button" value="取消" onclick="javascript:history.back();"/>
</p>
</FORM>
