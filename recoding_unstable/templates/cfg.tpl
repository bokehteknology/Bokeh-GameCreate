
					<h1>$print[S_NAME]</h1>
					<h4 align="right"><a href="{U_details.php?server_id=$print[SERVER_ID]}">Dettagli</a> | <a href="{U_restart.php?server_id=$print[SERVER_ID]}">Riavvia</a> | <a href="{U_cfg.php?server_id=$print[SERVER_ID]}"><i>CFG</i></a> | <a href="{U_logs.php?server_id=$print[SERVER_ID]}">Logs</a></h4>
					
					<div id="details_container">
						<textarea style="width: 98%;" rows="20" readonly>$print[CFG_CONTENT]</textarea>
					</div>
