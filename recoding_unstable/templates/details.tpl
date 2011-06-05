
					<h1>$print[S_NAME]</h1>
					<h4 align="right"><a href="{U_details.php?server_id=$print[SERVER_ID]}"><i>Dettagli</i></a> | <a href="{U_restart.php?server_id=$print[SERVER_ID]}">Riavvia</a> | <a href="{U_cfg.php?server_id=$print[SERVER_ID]}">CFG</a> | <a href="{U_logs.php?server_id=$print[SERVER_ID]}">Logs</a></h4>
					
					<div id="details_container">
						<table width="100%">
							<tbody>
							
								<tr>
									<td><img src="{U_images/network22x22.png}" />&nbsp;<b>IP</b></td>
									<td>$print[S_IP]:$print[S_PORT]</td>
								</tr>
								
								<tr>
									<td><img src="{U_images/chardevice.png}" height="22" width="22" />&nbsp;<b>STATO</b></td>
									<td><span class="<?php echo (($var[S_STATUS] == 1) ? 'active' : (($var[S_STATUS] == 2 || $var[S_STATUS] == 3 || $var[S_STATUS] == 4) ? 'pending' : 'closed')) ?>"><b><?php echo (($var[S_STATUS] == 1) ? 'Avviato' : (($var[S_STATUS] == 2 || $var[S_STATUS] == 3 || $var[S_STATUS] == 4) ? 'Caricamento' : 'Fermato')) ?></b></span></td>
								</tr>
								
								<tr>
									<td><img src="{U_images/www.png}" />&nbsp;<b>HOSTNAME</b></td>
									<td>$print[S_NAME]</td>
								</tr>
								
								<tr>
									<td><img src="{U_images/memory.png}" />&nbsp;<b>RAM USATA</b></td>
									<td>$print[S_RAM] KB</td>
								</tr>
								
								<tr>
									<td><img src="{U_images/ksim_cpu.png}" height="22" width="22" />&nbsp;<b>CPU USATA</b></td>
									<td>$print[S_CPU]%</td>
								</tr>
								
								<tr>
									<td><img src="{U_images/traffic.jpeg}" height="22" width="22" />&nbsp;<b>PLAYERS / SLOTS</b></td>
									<td>$print[S_PLAYER] / $print[S_SLOTS]</td>
								</tr>
								
								<tr>
									<td><img src="{U_images/pipe.png}" height="22" width="22" />&nbsp;<b>E' PROTETTO DA PASSWORD</b></td>
									<td><span class="<?php echo (($var[S_PASSWORD] == 1) ? 'closed' : (($var[S_PASSWORD] == 0) ? 'active' : 'pending')) ?>"><b><?php echo (($var[S_PASSWORD] == 1) ? 'S&igrave;' : (($var[S_PASSWORD] == 0) ? 'No' : $var[S_PASSWORD])) ?></b></span></td>
								</tr>
								
								<tr>
									<td><img src="{U_images/pipe.png}" height="22" width="22" />&nbsp;<b>GAME MODE</b></td>
									<td>$print[S_GAMEMODE]</td>
								</tr>
								
								<tr>
									<td><img src="{U_images/pipe.png}" height="22" width="22" />&nbsp;<b>NOME MAPPA</b></td>
									<td>$print[S_MAPNAME]</td>
								</tr>
								
								<tr>
									<td><img src="{U_images/cons.png}" height="22" width="22" />&nbsp;<b>VERSIONE</b></td>
									<td>SA-MP 0.3a R3 Linux Server (x86)</td>
								</tr>
								
							</tbody>
						</table>
					</div>
