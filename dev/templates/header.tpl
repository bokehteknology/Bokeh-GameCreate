<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		
		<title>$print[SITENAME] - $print[TITLE]</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="{U_style.php}" type="text/css" media="screen" />
		
	</head>
	
	
	<body>
		<div id="header">
			<h1><a href="{U_index.php}">$print[SITENAME]</a></h1>
			<div class="menu">Benvenuto <b>$print[USERNAME]</b>! | <b>$print[USER_IP]</b> | <a href="{U_logout.php}">Logout</a></div>
		</div>
		
		<div id="wrapper">
			
			<div id="flashmsg"></div>
			
			<div id="sidebar">
				<div class="title"></div>
				
				<div class="navigation">
					<ul>
						<li>
							
							<span>Principale</span>
							
							<ul>
								<li><img src="{U_images/server.png}" alt="" align="left" /><a href="{U_index.php}">&nbsp;I miei servers ($print[SERVERS_NUMBER])</a></li>
							</ul>
							
						</li>
					</ul>
				</div>
				
				<div class="title">		
					<h2>Annunci</h2>
				</div>
				
				<div class="box">
					<ul id="blog">
						<li><h4><a title="Iniziato sviluppo">Iniziato sviluppo</a> <abbr title="2010-02-22">22-02-2010</abbr></h4><p>E' iniziato lo sviluppo del pannello <strong>SA:MP GC Panel</strong>.</p></li>
					</ul>
				</div>
				
			</div>
			
			<div id="content">
				
				<div class="title">		
					<!-- TITLE -->
				</div>
				
				<div id="panel" class="box">
