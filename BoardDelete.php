<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$board_id = intval($_GET["board_id"]);

if (empty($teacher_id)) exit();
if (empty($board_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["BOARD"]["DELETE"]);
?>
<FORM METHOD=POST ACTION="BoardDeleteDB.php" name="dform" id="dform">
<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
<INPUT TYPE="hidden" name="board_id" value="<? echo($board_id); ?>">
<p align="center">
�A�u���n�R���o�g���i�ܡH
<br />
<input type="submit" value="�T�w" /><input type="button" value="����" onclick="javascript:history.back();"/>
</p>
</FORM>
