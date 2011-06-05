<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		
		<title>$print[SITENAME] - $print[TITLE]</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="{U_style.php?login_box}" type="text/css" media="screen" />
		
	</head>
	
	
	<body>
		<div id="box">
			<h2>$print[SITENAME] <span class="light">Login</span></h2>
			
			<form method="post" action="{U_login.php}">
				<ul>
					<li>
						<label for="username">Username:</label>
						<div><input class="max text" type="text" name="username" maxlength="50" value="" id="username" /></div>
					</li>
					
					<li>
						<label for="password">Password:</label>
						<div><input class="max text" type="password" name="password" value="" id="password" /></div>
					</li>
					
					<li>
						<input class="button" type="submit" name="submit" value="Accedi" />
					</li>
				</ul>
				
				<ul>
					<li>
						<div><em>&copy;2009-$print[CURRENT_YEAR] $print[SITENAME]. Tutti i diritti riservati.<br />SA:MP GC Panel by <a href="http://www.nextsearch.net/">Next Network</a>.</em></div>
					</li>
				</ul>
			</form>
		</div>
	</body>

</html>