<div class="page-content">						
	<div class="row">
	<div class="col-md-12">
		<div class="form-group">
	
		Domain : <input id="hosts" type="text" placeholder="Add IP/Domain Name"  />
		Port : <input id="port" type="number" />
		Real Server  : <input id="maklumat" type="text" />
		<button id="addserver" >Add Server</button>	
		<!--
		<div class="pull-right"><i class="fa fa-eye" aria-hidden="true"></i> 
			<a id="ssl">SSL Configurationn</a></div>
		</div>
		-->	

		<div class="pull-right"><i class="fa fa-eye" aria-hidden="true"></i> 
			<a id="ssl">Advance Configurationn</a></div>
		</div>	
   </div>
   <div class="col-md-12" id="viewssl" style='display:none'>
    
	
	<br/>
	
	 <div class="form-group">
	 	<label for="sslengin">	SSLEngine </label>
	 	<select id="sslengin">
	 	<option value="off">OFF</option>
  		<option value="on">ON</option>
  		 
	</select>
	 </div>	
	 
	  <div class="col-md-12" id="sslcert" style='display:none'>
	  <div class="form-group">
    <label for="SSLCertificateFile">SSLCertificateFile</label>
    <input type="text" class="form-control" id="SSLCertificateFile" placeholder="/path/to/your_domain_name.crt">
  </div>
  <div class="form-group">
    <label for="SSLCertificateKeyFile">SSLCertificateKeyFile</label>
    <input type="text" class="form-control" id="SSLCertificateKeyFile" placeholder="/path/to/your_private.key">
  </div>
  
  <div class="form-group">
    <label for="SSLCertificateChainFile">SSLCertificateChainFile</label>
    <input type="text" class="form-control" id="SSLCertificateChainFile" placeholder="/path/to/Digicertcx.crt">
  </div>

	</div>
	
	<div class="form-group">
	 	<label for="lb">	Load Balancer </label>
	 	<select id="lb">
	 	<option value="0">No</option> 
  		<option value="1">Yes</option>
	</select>
	 </div>	
	
	<div class="form-group" id="lbtype" style='display:none'>
	 	<label for="lbmethod">	lbmethod </label>
	 	<select id="lbmethod">
  		<option value="bytraffic">bytraffic</option>
  		<option value="byrequests">byrequests</option> 
	</select>
	 </div>	
	 
	</div>	 
	 
	<script>
		$("#ssl").click(function(){
			$("#viewssl").slideDown('show');
		});
		$("#sslengin").change(function(){
			if($(this).val() === 'on'){
			  $("#sslcert").slideDown('show');
			}else{
			  $("#sslcert").slideUp('hide');
			}
		});
		
		$("#lb").change(function(){
			if($(this).val() === '1'){
			  $("#lbtype").slideDown('show');
			}else{
			  $("#lbtype").slideUp('hide');
			}
		});
	</script>
	</div>
	<hr />
	<div class="col-md-12">
	<table id="listhost" class="table table-striped table-bordered" width="100%" cellspacing="0">
		<thead>
			<tr>
				
				<th>Domain</th>
				<th>Port</th>
				<th>Real Server</th>
				<th>Action</th>
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
				<td width="30%">
					<button onclick="editserver(<?=$s->id?>);" data-toggle="modal" data-target="#myModal">Edit</button> 
					<button onclick="confserver(<?=$s->id?>)" >Advance Conf</button>
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

<div class="modal fade" id="confx" tabindex="-1" role="dialog" aria-labelledby="confxLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Configure Web Server</h4>
      </div>
      <div class="modal-body" >
        <div id="popedit2">
        	
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
		SSLCertificateFile:$("#SSLCertificateFile").val(),
		SSLCertificateKeyFile:$("#SSLCertificateKeyFile").val(),
		SSLCertificateChainFile:$("#SSLCertificateChainFile").val(),
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
    break;		
});
</script>