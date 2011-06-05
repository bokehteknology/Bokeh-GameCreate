
					<h1>I miei servers</h1>
					<br/>
					
					<table cellpadding="0" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>NOME</th>
								<th>SLOTS</th>
								<th>RAM</th>
								<th>CPU</th>
								<th>IP</th>
								<th>PORTA</th>
								<th>STATO</th>
								<th class="actions"></th>
							</tr>
						</thead>
						
						<?php foreach($this->tpl_var['SERVERS_LIST'] as $server) { ?>
						<tr class="odd">
							<td><b><a href="{U_details.php?server_id=<?php echo $server['id']; ?>}"><?php echo $server['name']; ?></a></b></td>
							<td><?php echo $server['player']; ?>/<?php echo $server['slots']; ?></td>
							<td><?php echo $server['ram']; ?> KB</td>
							<td><?php echo $server['cpu']; ?>%</td>
							<td><?php echo $server['ip']; ?></td>
							<td><?php echo $server['port']; ?></td>
							<td><span class="<?php echo (($server['status'] == 1) ? 'active' : (($server['status'] == 2 || $server['status'] == 3 || $server['status'] == 4) ? 'pending' : 'closed')) ?>"><b><?php echo (($server['status'] == 1) ? 'Avviato' : (($server['status'] == 2 || $server['status'] == 3 || $server['status'] == 4) ? 'Caricamento' : 'Fermato')) ?></b></span></td>
							<td width="90px" class="actions">
								<a href="{U_details.php?server_id=<?php echo $server['id']; ?>}"><img src="{U_images/viewmag.png}" alt="Dettagli" /></a>
								<a href="{U_index.php?act=start&server_id=<?php echo $server['id']; ?>}"><img src="{U_images/player_play.png}" alt="Start" title="Start" /></a>
								<a href="{U_index.php?act=stop&server_id=<?php echo $server['id']; ?>}"><img src="{U_images/exit.png}" alt="Stop" title="Stop" /></a>
							</td>
						</tr>
						<?php } ?>
					</table>
					
					<p>In tutti i tuoi servers ci sono $print[T_PLAYERS] players, su un totale di $print[T_SLOTS] slots. Ci sono $print[T_SERVERS_ON] servers avviati e $print[T_SERVERS_OFF] servers fermati.<br />La memoria RAM in uso dai tuoi servers corrisponde a $print[T_RAM] KB, ed utilizzano il $print[T_CPU]% della CPU.</p>
