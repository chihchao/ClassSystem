<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$calendar_id = intval($_GET["calendar_id"]);

if (empty($teacher_id)) exit();
if (empty($calendar_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["CALENDAR"]["DELETE"]);
?>
<FORM METHOD=POST ACTION="CalendarDeleteDB.php" name="dform" id="dform">
<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
<INPUT TYPE="hidden" name="calendar_id" value="<? echo($calendar_id); ?>">
<p align="center">
你真的要刪除這項記事嗎？
<br />
<input type="submit" value="確定" /><input type="button" value="取消" onclick="javascript:history.back();"/>
</p>
</FORM>
