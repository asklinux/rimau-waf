<div class="page-content">						
	<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	<?php
		//print_r($server);
	?>
		<h2> Domain : <?=$server[0]['hosts']?> </h2><br />
		Ssl Status :  <?=$server[0]['SSLEngine']?><br />
		
 

		
   </div>

	<script>
		$("#ssl").click(function(){
			$("#viewssl").slideDown('show');
		});
	</script>
	</div>
	<hr />
	<div class="col-md-12">
	<table id="listhost" class="table table-striped table-bordered" width="100%" cellspacing="0">
		<thead>
			<tr>
				
				<th>Real Server</th>
				<th>Port</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			
			<tr>
				<td><?=$server[0]['description']?></td>
				<td><?=$server[0]['port']?></td>
				
				<td width="30%">
		
					</td>
			</tr>
			<!--
			<?php
			foreach ($list as $s) {
			?>
			<tr>
				
				<td><?=$s->hosts?></td>
				<td><?=$s->port?></td>
				<td><?=$s->description?></td>
				<td width="30%">
					<button onclick="editserver(<?=$s->id?>);" data-toggle="modal" data-target="#myModal">Edit</button> 
					<button onclick="confserver(<?=$s->id?>)" >Advance Conf</button>
					<button onclick="padamserver(<?=$s->id?>)" >Delete</button></td>
			</tr>
			<?php	
			}
			?>
			-->
		</tbody>
	</table>
	<button onclick="addserverlb(<?=$server[0]['id']?>);" data-toggle="modal" data-target="#myModal">Add New Server</button> 

	</div>
	
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New Web Server</h4>
      </div>
      <div class="modal-body" >
        <div id="popedit">
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="saveedit();" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script>

function addserverlb(id){
	
	
	$.post('panel/addserverlb',{id:id},function(data){
		
		
		$("#popedit").html(data);
		
	});	
	
}


function padamserver(id){
	
	if(confirm("Are you sure you want to delete this?")){
		
		$.post('panel/padamserver',{id:id},function(data){
		$('#paparx').load('panel/web_server').show();
		
		});		

	}
	else {
		
	}
}
function editserver(id){
	
	
	$.post('panel/editserver',{id:id},function(data){
		
		
		$("#popedit").html(data);
		
	});	
	
}
function confserver(id){
	//$.post('panel/confserver',{id:id},function(data){
		
		$('#dimana').text("Web Server > Advance Configure > "+id).show();	
		$('#paparx').load('panel/confadvance',{id:id}).show();
		//$("#popedit2").html(data);
		
	//});	
}
function saveedit(){
	
	var dataserver = {
		id:$("#id2").val(),
		host:$("#domain").val(),
		port:$("#port2").val(),
		maklumat:$("#url2").val(),
		SSLCertificateFile:$("#SSLCertificateFile2").val(),
		SSLCertificateKeyFile:$("#SSLCertificateKeyFile2").val(),
		SSLCertificateChainFile:$("#SSLCertificateChainFile2").val(),
		SSLEngine:$("#sslengin2").val(),
		};
	
	$.post('panel/editserversimpan',dataserver,function(data){

		$('#paparx').load('panel/web_server').show();
	});
	
}


$(document).ready(function() {
    clearTimeout(lari);
    clearTimeout(livelog);
    break;		
});
</script>