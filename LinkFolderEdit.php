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

$login_user = login($PAGE_AUTHENTICATE_USER["LINK"]["EDIT"]);

if ($folder_id == 0){
	echo("<script language=javascript>");
	echo("alert('連結區為最上層資料夾，無法修改。');");
	echo("history.back();");
	echo("</script>");
	exit();
}else{
	$str = "Select folder_name, folder_explain From link_folder Where teacher_id = '" . $teacher_id . "' And folder_id = '" . $folder_id . "'";
	$result = QueryDatabase($str);
	if (!(list($folder_name, $folder_explain) = mysql_fetch_row($result))) exit();
}
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 連結區 → 修改資料夾</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">修 . 改 . 資 . 料 . 夾</font></TD>
	<TD>
	<a href="Link.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><IMG SRC="Images/LinkReturnButton.gif" BORDER=0 ALT="回資料夾"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<FORM METHOD=POST ACTION="LinkFolderEditDB.php">
<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">資料夾名稱：</TD>
	<TD><INPUT TYPE="text" NAME="folder_name" size="40" value="<? echo($folder_name); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">資料夾說明：</TD>
	<TD><TEXTAREA NAME="folder_explain" ROWS="8" COLS="40"><? echo($folder_explain); ?></TEXTAREA></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<INPUT TYPE="hidden" name="folder_id" value="<? echo($folder_id); ?>">
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="送出"><INPUT TYPE="reset" value="重置"></TD>
</TR>
</TABLE>

</FORM>

</BODY>
</HTML>