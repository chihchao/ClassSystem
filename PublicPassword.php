<HTML>
<HEAD><TITLE>���ұK�X</TITLE>
</HEAD>
<BODY BGCOLOR="#FFFFFF" background="Images/PublicBackground0.gif">

<TABLE border="0" align="center"><TR><TD>

<form METHOD="POST">
<? display_frame(0, 0); ?>

		<TABLE border="0" width="100%">
		<TR>
			<TD width="100%"><font color="#FFFFFF" size="2">�� . �� . �K . �X</font></TD>
		</TR>
		</TABLE>

<? display_frame(0, 1); ?>

		<TABLE border="0" cellspacing="5">
		<TR>
			<TD colspan=2><font color=#FF0000 size=2><B>
			<?
			if (empty($password)){
				echo("�I�п�J�K�X...");
			}else{
				echo("�I�K�X���~�A�нT�{�K�X�᭫�s��J...");
			}
			?>
			</B></font>
			</TD>
		</TR>
		<TR>
			<TD>
			<INPUT TYPE="password" NAME="password" size="15">
			<INPUT TYPE="submit" value="�e�X">
			<INPUT TYPE="reset" value="�M��">
			</TD>
		</TR>
		</TABLE>

<? display_frame(0, 2); ?>
</form>

</TD></TR></TABLE>

</BODY>
</HTML>