<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$folder_id = intval($_GET["folder_id"]);

if (empty($teacher_id)) exit();
if (empty($folder_id) || $folder_id < 0) $folder_id = 0;

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["DOCUMENT"]["DELETE"]);
?>
<FORM METHOD=POST ACTION="DocumentFolderDeleteDB.php" name="dform" id="dform">
<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
<INPUT TYPE="hidden" name="folder_id" value="<? echo($folder_id); ?>">
<p align="center">
�A�u���n�R���o�Ӹ�Ƨ��ܡH
<br />
<input type="submit" value="�T�w" /><input type="button" value="����" onclick="javascript:history.back();"/>
</p>
</FORM>
