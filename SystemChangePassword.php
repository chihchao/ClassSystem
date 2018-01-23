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
<HEAD><TITLE>修改老師密碼</TITLE>
</HEAD>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground0.gif">

<TABLE border="0" align="center"><TR><TD>

<form METHOD="POST" action="SystemChangePasswordDB.php">

<? display_frame(0, 0); ?>

		<TABLE border="0" width="100%">
		<TR>
			<TD width="100%"><font color="#FFFFFF" size="2">修 . 改 . 老 . 師 . 密 . 碼</font></TD>
		</TR>
		</TABLE>


<? display_frame(0, 1); ?>

		<TABLE border="0" cellspacing="5">
		<TR>
			<TD colspan=2><font color=#FF0000 size=2><B>【<? echo($homepage_title); ?>】<BR>！請輸入新的老師密碼...</B></font>
			</TD>
		</TR>
		<TR>
			<TD>
			<INPUT TYPE="password" NAME="teacher_password" value="<? echo($teacher_password); ?>" size="15">
			<INPUT TYPE="hidden" name="teacher_id" value="<? echo($teacher_id); ?>">
			<INPUT TYPE="hidden" name="password" value="<? echo($password); ?>">
			<INPUT TYPE="submit" value="送出">
			<INPUT TYPE="reset" value="重置">
			<INPUT TYPE="button" value="上一頁" onclick="javascript:history.back()">
			</TD>
		</TR>
		</TABLE>

<? display_frame(0, 2); ?>

</form>

</TD></TR></TABLE>

</BODY>
</HTML>