<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$password = StripSlashes($_POST["password"]);

//page=======================
NoCache();

if ($password != $APPLY_PASSWORD){
	include("PublicPassword.php");
	exit();
}
?>
<HTML>
<HEAD><meta http-equiv="content-type" content="text/html; charset=BIG5" />
<TITLE>�Z�ź����t�� �� �ӽЯZ�ź���</TITLE>
</HEAD>
<? require("PublicDhtmlStyle.php"); ?>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground0.gif">

<? function_bar(0, 0); ?>

				<TABLE border="0" cellspacing="1" cellpadding="2" width="100%">
				<TR>
					<TD width="100%"><font color="#FFFFFF">�� . �� . �Z . �� . �� . ��</font></TD>
					<TD>
					<a href="index.php"><IMG SRC="Images/ApplyReturnButton.gif" BORDER=0 ALT="�^�Z�ź����t��"></a></TD>
				</TR>
				</TABLE>

<? function_bar(0, 1); ?>

<FORM METHOD="POST" enctype="multipart/form-data" ACTION="ApplyDB.php">
<TABLE>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top"><IMG SRC="Images/PublicBlankSpace.gif" BORDER="0" width="60" height="0"><BR>�Ѯv�b���G</TD>
	<TD><INPUT TYPE="text" NAME="teacher_account" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�Ѯv�K���G</TD>
	<TD><INPUT TYPE="password" NAME="teacher_password" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�Ѯv�m�W�G</TD>
	<TD><INPUT TYPE="text" NAME="teacher_name" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�Ѯv�H�c�G</TD>
	<TD><INPUT TYPE="text" NAME="teacher_email" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�~�ůZ�šG</TD>
	<TD>
	<select name="grade">
	<?
	reset($GRADE_ARRAY);
	while (list($option_counter) = each($GRADE_ARRAY)){
		echo("<option value=\"" . $option_counter . "\"");
		if ($option_counter == 1) echo(" selected");
		echo(">");
		echo($GRADE_ARRAY[$option_counter]);
		echo("</option>");
	}
	?>
	</select> �~
	<select name="class_number">
	<?
	reset($CLASS_NUMBER_ARRAY);
	while (list($option_counter) = each($CLASS_NUMBER_ARRAY)){
		echo("<option value=\"" . $option_counter . "\"");
		if ($option_counter == 1) echo(" selected");
		echo(">");
		echo($CLASS_NUMBER_ARRAY[$option_counter]);
		echo("</option>");
	}
	?>
	</select> �Z
	</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�޲z�K�X�G</TD>
	<TD><INPUT TYPE="password" NAME="manage_password" size="40"><BR><font color="#FF0000">��</font> �Ъ`�N�A�޲z�K�X���i�M�Ѯv�K�X�ۦP�A�_�h�޲z�̱N�֦��M�Ѯv�@�˪��v���C</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�Z�űK�X�G</TD>
	<TD><INPUT TYPE="password" NAME="class_password" size="40"><BR><font color="#FF0000">��</font> �Ъ`�N�A�Z�űK�X���i�M�Ѯv�K�X�B�޲z�K�X�ۦP�A�_�h�Z�ŨϥΪ̱N�֦��M�Ѯv�B�޲z�̤@�˪��v���C</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�����W�١G</TD>
	<TD><INPUT TYPE="text" NAME="homepage_title" size="40"></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�����Ϥ��G</TD>
	<TD><INPUT TYPE="file" NAME="uploadfile" size="40"><BR><font color="#FF0000">��</font> �i�ϥ��ɮ������]�A JPG�BGIF�BSWF�]Flash�^�C</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">������r�G</TD>
	<TD><TEXTAREA NAME="homepage_describe" ROWS="8" COLS="40"></TEXTAREA></TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�G�������G</TD>
	<TD>
	<INPUT TYPE="radio" NAME="homepage_theme" value="0" checked><img src="Images/PublicTheme0.gif" border="1" align="top">�@�@
	<INPUT TYPE="radio" NAME="homepage_theme" value="1"><img src="Images/PublicTheme1.gif" border="1" align="top"><BR><BR>
	<INPUT TYPE="radio" NAME="homepage_theme" value="2"><img src="Images/PublicTheme2.gif" border="1" align="top">
	</TD>
</TR>
<TR>
	<TD valign="top"><img src="Images/PublicPointer.gif" border="0"></TD>
	<TD valign="top">�_�l�H�ơG</TD>
	<TD><INPUT TYPE="text" NAME="homepage_counter" size="40" value="0"></TD>
</TR>
<TR>
	<TD valign="top"></TD>
	<TD valign="top"></TD>
	<TD><INPUT TYPE="hidden" name="password" value="<? echo($password); ?>"><INPUT TYPE="submit" value="�e�X"><INPUT TYPE="reset" value="�M��"></TD>
</TR>
</TABLE>
</FORM>

</BODY>
</HTML>