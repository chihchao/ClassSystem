<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_GET["teacher_id"]);
$document_id = intval($_GET["document_id"]);

if (empty($teacher_id)) exit();
if (empty($document_id)) exit();

//page=======================
NoCache();

LinkDatabase();

GetThemeTitle();

$login_user = login($PAGE_AUTHENTICATE_USER["LINK"]["EDIT"]);

$str = "Select folder_id, document_title, document_content From link_document Where teacher_id = '" . $teacher_id . "' And document_id = '" . $document_id . "'";
$result = QueryDatabase($str);
if (!(list($folder_id, $document_title, $document_content) = mysql_fetch_row($result))) exit();

if ($folder_id == 0){
	$folder_name = "連結區";
}else{
	$str = "Select folder_name From link_folder Where teacher_id = '" . $teacher_id . "' And folder_id = '" . $folder_id . "'";
	$result = QueryDatabase($str);
	if (!(list($folder_name) = mysql_fetch_row($result))) exit();
}
$folder_name = htmlspecialchars($folder_name);
?>
<HTML>
<HEAD>
<TITLE><? echo($homepage_title); ?> → 連結區 → 編輯連結</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground<? echo($homepage_theme); ?>.gif">

<? function_bar($homepage_theme, 0); ?>
<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
<TR>
	<TD width="100%"><font color="#FFFFFF">編 . 輯 . 連 . 結</font></TD>
	<TD>
	<a href="Link.php?teacher_id=<? echo($teacher_id); ?>&folder_id=<? echo($folder_id); ?>"><IMG SRC="Images/LinkReturnButton.gif" BORDER=0 ALT="回資料夾"></a></TD>
</TR>
</TABLE>
<? function_bar($homepage_theme, 1); ?>

<FORM METHOD="POST" ACTION="LinkDocumentEditDB.php">
<TABLE border="0" width="100%" bgcolor="<? echo($HOMEPAGE[$homepage_theme]["BGCOLOR1"]); ?>">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicFolder.gif" BORDER=0></TD>
	<TD valign="top" width="100%"><? echo($folder_name); ?></TD>
</TR>
</TABLE>
<TABLE border="0">
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top"><img src="Images/PublicBlankSpace.gif" border="0" width="65" height="0"><BR>連結標題：</TD>
	<TD><INPUT TYPE="text" NAME="document_title" size="40" value="<? echo($document_title); ?>"></TD>
</TR>
<TR>
	<TD valign="top"><IMG SRC="Images/PublicPointer.gif" BORDER=0></TD>
	<TD valign="top">連結網址：</TD>
	<TD><INPUT TYPE="text" NAME="document_content" size="40" value="<? echo($document_content); ?>"></TD>
</TR>
<TR>
	<TD></TD>
	<TD>
	<INPUT TYPE="hidden" name="folder_id" value="<? echo($folder_id); ?>">
	<INPUT TYPE="hidden" name="document_id" value="<? echo($document_id); ?>">
	<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
	</TD>
	<TD><INPUT TYPE="submit" value="送出"><INPUT TYPE="reset" value="重置"></TD>
</TR>
</TABLE>

</FORM>

</BODY>
</HTML>
