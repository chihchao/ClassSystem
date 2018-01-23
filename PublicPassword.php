<HTML>
<HEAD><TITLE>驗證密碼</TITLE>
</HEAD>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground0.gif">

<TABLE border="0" align="center"><TR><TD>

<form METHOD="POST">
<? display_frame(0, 0); ?>

		<TABLE border="0" width="100%">
		<TR>
			<TD width="100%"><font color="#FFFFFF" size="2">驗 . 證 . 密 . 碼</font></TD>
		</TR>
		</TABLE>

<? display_frame(0, 1); ?>

		<TABLE border="0" cellspacing="5">
		<TR>
			<TD colspan=2><font color=#FF0000 size=2><B>
			<?
			if (empty($password)){
				echo("！請輸入密碼...");
			}else{
				echo("！密碼錯誤，請確認密碼後重新輸入...");
			}
			?>
			</B></font>
			</TD>
		</TR>
		<TR>
			<TD>
			<INPUT TYPE="password" NAME="password" size="15">
			<INPUT TYPE="submit" value="送出">
			<INPUT TYPE="reset" value="清除">
			</TD>
		</TR>
		</TABLE>

<? display_frame(0, 2); ?>
</form>

</TD></TR></TABLE>

</BODY>
</HTML>