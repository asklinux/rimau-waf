	
		<table id="listhost" class="table table-striped table-bordered" width="100%" cellspacing="0">
		<thead>
			<tr>
				
				<th>Date</th>
				<th>Time</th>
				<th>Source</th>
				<th>Dest</th>
				<th>Message</th>
			</tr>
		</thead>
		<tbody>
			<?php

foreach ($attack as $a) {
?>
			<tr>
				<td><?=$a['date']?></td>
				<td><?=$a['time']?></td>
				<td><?=$a['source_ip']?></td>
				<td><?=$a['dest_ip']?></td>
				<td><?=$a['message']?></td>
			</tr>
<?php
	/*	
	echo $a['date'];
	echo $a['time'];
	echo $a['source_ip'];
	echo $a['source_port'];
	echo $a['dest_ip'];
	echo $a['dest_port'];
	echo $a['message'];
	echo $a['detailed_message'];
	
	echo "<br/><br/>";
	 * 
	 */
}

?>
		</tbody>
		</table>

	


