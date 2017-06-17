<div class="page-content">						
	<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	
		Host : <input id="hosts" type="text" placeholder="Add IP/Domain Name"  />
		Port : <input id="port" type="number" />
		Url  : <input id="maklumat" type="text" />
		<button id="addserver" >Add Server</button>	
		<!--
		<div class="pull-right"><i class="fa fa-eye" aria-hidden="true"></i> 
			<a id="ssl">SSL Configurationn</a></div>
		</div>
		-->	

		<div class="pull-right"><i class="fa fa-eye" aria-hidden="true"></i> 
			<a id="ssl">SSL Configurationn</a></div>
		</div>	
   </div>
   <div class="col-md-12" id="viewssl" style='display:none'>
   	SSLCertificateFile : <input  id="sslcert" type="text" placeholder="Ssl Cert Location" />
	SSLEngine : 
	<select id="sslengin">
  		<option value="on">ON</option>
  		<option value="off">OFF</option> 
	</select>
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
				
				<th>Host</th>
				<th>Port</th>
				<th>Url</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($list as $s) {
			?>
			<tr>
				
				<td><?=$s->hosts?></td>
				<td><?=$s->port?></td>
				<td><?=$s->description?></td>
				<td width="15%"><button onclick="editserver(<?=$s->id?>);" data-toggle="modal" data-target="#myModal">Edit</button> 
					<button onclick="padamserver(<?=$s->id?>)" >Delete</button></td>
			</tr>
			<?php	
			}
			?>
		</tbody>
	</table>
	</div>
	
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Web Server</h4>
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
$("#addserver").click(function(){
	
	if ($("#hosts").val() == '' || $("#port").val() == '' || $("#maklumat").val() == '' ){
		alert("Please Insert All Infomation ")
	}
	else {
	var addserver = {
		host:$("#hosts").val(),
		port:$("#port").val(),
		maklumat:$("#maklumat").val(),
		SSLCertificateFile:$("#sslcert").val(),
		SSLEngine:$("#sslengin").val(),
		};
	$.post('panel/addserver',addserver,function(data){
		
		
		$('#paparx').load('panel/web_server').show();
		
	});
	}
});



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
function saveedit(){
	
	var dataserver = {
		id:$("#id2").val(),
		host:$("#domain").val(),
		port:$("#port2").val(),
		maklumat:$("#url2").val(),
		SSLCertificateFile:$("#ssl2").val(),
		SSLEngine:$("#sslengin2").val(),
		};
	
	$.post('panel/editserversimpan',dataserver,function(data){

		$('#paparx').load('panel/web_server').show();
	});
	
}


$(document).ready(function() {
    clearTimeout(lari);
    clearTimeout(livelog);		
});
</script>