<?
//require====================
require("PublicParameter.php");
require("PublicFunction.php");

//parameter==================
$teacher_id = intval($_POST["teacher_id"]);
$password = StripSlashes($_POST["password"]);

if (empty($teacher_id)) exit();

//page=======================
NoCache();

if ($password != $MANAGE_PASSWORD){
	include("PublicPassword.php");
	exit();
}

LinkDatabase();

GetThemeTitle();
?>
<HTML>
<HEAD><TITLE>�ק�Ѯv�K�X</TITLE>
</HEAD>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground0.gif">

<TABLE border="0" align="center"><TR><TD>

<form METHOD="POST" action="SystemChangePasswordDB.php">

<? display_frame(0, 0); ?>

		<TABLE border="0" width="100%">
		<TR>
			<TD width="100%"><font color="#FFFFFF" size="2">�� . �� . �� . �v . �K . �X</font></TD>
		</TR>
		</TABLE>


<? display_frame(0, 1); ?>

		<TABLE border="0" cellspacing="5">
		<TR>
			<TD colspan=2><font color=#FF0000 size=2><B>�i<? echo($homepage_title); ?>�j<BR>�I�п�J�s���Ѯv�K�X...</B></font>
			</TD>
		</TR>
		<TR>
			<TD>
			<INPUT TYPE="password" NAME="teacher_password" value="<? echo($teacher_password); ?>" size="15">
			<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
			<INPUT TYPE="hidden" name="password" value="<? echo($password); ?>">
			<INPUT TYPE="submit" value="�e�X">
			<INPUT TYPE="reset" value="���m">
			<INPUT TYPE="button" value="�W�@��" onclick="javascript:history.back()">
			</TD>
		</TR>
		</TABLE>

<? display_frame(0, 2); ?>

</form>

</TD></TR></TABLE>

</BODY>
</HTML>