	<?php
	
	   if ( $mytab == "#disable"){
	   	 $atasdisable = 'class="active"';
	   	 $tabdisable = "active";
		 $atashome = '';
		 $tabhome = '';
		 $ataslb = '';
		 $tablb = '';
		 $atasdomain = '';
		 $tabdomain = '';
		 $atasblack = '';
		 $tabblack = '';
		 $ataswhite = '';
	  	 $tabwhite = '';
	   }
	   else if ($mytab == "#lbtab"){
		 $atashome = '';
		 $tabhome = '';
		 $ataslb = 'class="active"';
		 $tablb = 'active';
		 $atasdomain = '';
		 $tabdomain = '';
		 $atasdisable = '';
	   	 $tabdisable = '';
		 $atasblack = '';
		 $tabblack = '';
		 $ataswhite = '';
	  	 $tabwhite = '';
	   
	   }
	   else if ($mytab == "#domain"){
	   	$atashome = '';
		 $tabhome = '';
		 $ataslb = '';
		 $tablb = '';
		 $atasdomain = 'class="active"';
		 $tabdomain = 'active';
		 $atasdisable = '';
	   	 $tabdisable = '';
		 $atasblack = '';
		 $tabblack = '';
		 $ataswhite = '';
	  	 $tabwhite = '';
	   }
	   else if ($mytab == "#black"){
	   	$atashome = '';
		 $tabhome = '';
		 $ataslb = '';
		 $tablb = '';
		 $atasdomain = '';
		 $tabdomain = '';
		 $atasdisable = '';
	   	 $tabdisable = '';
		 $atasblack = 'class="active"';
		 $tabblack = 'active';
		 $ataswhite = '';
	  	 $tabwhite = '';
	   }
	   else if ($mytab == "#white"){
	   	$atashome = '';
		 $tabhome = '';
		 $ataslb = '';
		 $tablb = '';
		 $atasdomain = '';
		 $tabdomain = '';
		 $atasdisable = '';
	   	 $tabdisable = '';
		 $atasblack = '';
		 $tabblack = '';
		 $ataswhite = 'class="active"';
	  	 $tabwhite = 'active';
	   }
	   else{
	   	 $atashome = 'class="active"';
		 $tabhome = 'active';
		 $ataslb = '';
		 $tablb = '';
		 $atasdomain = '';
		 $tabdomain = '';
		 $atasdisable = '';
	   	 $tabdisable = '';
		 $atasblack = '';
		 $tabblack = '';
		 $ataswhite = '';
	  	 $tabwhite = '';
	   }
	
	?>
		<h2> Domain : <?=$server[0]['hosts']?> </h2>

	  <ul class="nav nav-tabs" role="tablist" id="mainTabs">
    <li role="presentation" <?=$atashome?>><a href="#home" aria-controls="home" role="tab" data-toggle="tab">SSL engin</a></li>
    <li role="presentation" <?=$ataslb?>><a href="#lbtab" aria-controls="lbtab" role="tab" data-toggle="tab">Load Balancer</a></li>
    <li role="presentation" <?=$atasdomain?> > <a href="#domain" aria-controls="domain" role="tab" data-toggle="tab">Domain Rules</a></li>
	<li role="presentation" <?=$atasdisable?> > <a href="#disable" aria-controls="disable" role="tab" data-toggle="tab">Disable Rules</a></li>
	<li role="presentation" <?=$atasblack?>> <a href="#black" aria-controls="black" role="tab" data-toggle="tab">Black List</a></li>
	<li role="presentation" <?=$ataswhite?>> <a href="#white" aria-controls="white" role="tab" data-toggle="tab">White List</a></li>

  </ul>	
  
    <div class="tab-content">
    <div role="tabpanel"  class="tab-pane <?=$tabhome?>" id="home">
    	   	<?php
   		if($server[0]['SSLEngine'] == 'on'){
   			$pilih = 'selected="selected"';
			$papar = '';
   		}
		else {
			$pilih = '';
			$papar = "style='display:none'";
		}
   	?>
	<div class="form-group">
                <label for="modsec">WAF ON/OFF</label>
                <select  id="modsec" onchange="updatemod()">

                <option value="off">OFF</option>
                <option <?php if($server[0]['modsec'] == 'on')  echo 'selected="selected"' ?> value="on">ON</option>

        </select>

         </div>	
   	<div class="form-group">
	 	<label for="sslengin">SSLEngine</label>
	 	<select  id="sslengin" onchange="updatessl()">
	 	<option value="off">OFF</option>
  		<option <?=$pilih?> value="on">ON</option>
  		 
	</select>

	 </div>	
	 
	 <div id="sslcert" <?=$papar?> >
	  <div class="form-group">
    <label for="SSLCertificateFile">SSLCertificateFile</label>
    <input type="text" class="form-control" id="SSLCertificateFile" value="<?=$server[0]['SSLCertificateFile']?>" placeholder="/path/to/your_domain_name.crt">
  </div>
  <div class="form-group">
    <label for="SSLCertificateKeyFile">SSLCertificateKeyFile</label>
    <input type="text" class="form-control" id="SSLCertificateKeyFile" value="<?=$server[0]['SSLCertificateKeyFile']?>" placeholder="/path/to/your_private.key">
  </div>
  
  <div class="form-group">
    <label for="SSLCertificateChainFile">SSLCertificateChainFile</label>
    <input type="text" class="form-control" id="SSLCertificateChainFile" value="<?=$server[0]['SSLCertificateChainFile']?>" placeholder="/path/to/Digicertcx.crt">
  </div>

	<button onclick="updatesslkey()">Update</button></td>

	</div>
	

	</div>	


<div role="tabpanel"  class="tab-pane <?=$tablb?>" id="lbtab">
		<?php
   		if($server[0]['lb'] == '1'){
			$paparlb = '';
   		}
		else {
			$paparlb = "style='display:none'";
		}
   	  ?>	
   	<div class="form-group">
	 	<label for="lb">	Load Balancer </label>
	 		<select id="lb" onchange="activelb()">
	 			<option <?php if($server[0]['lb'] == '0') echo 'selected="selected' ?> value="0">No</option> 
  				<option <?php if($server[0]['lb'] == '1') echo 'selected="selected' ?>  value="1">Yes</option>
			</select>
	 </div>	
	<div class="form-group" id="lbtype" <?=$paparlb?> >
	 	<label for="lbmethod">	lbmethod </label>
	 	<select id="lbmethod" onchange="mlb()">
	 	<option>Select Method</option>	
  		<option <?php if($server[0]['lbmethod'] == 'bytraffic')  echo 'selected="selected"' ?>  value="bytraffic">bytraffic</option>
  		<option <?php if($server[0]['lbmethod'] == 'byrequests')  echo 'selected="selected"' ?>value="byrequests">byrequests</option>
  		<option <?php if($server[0]['lbmethod'] == 'bybusyness')  echo 'selected="selected"' ?>value="bybusyness">bybusyness</option>
  		<option <?php if($server[0]['lbmethod'] == 'heartbeat')  echo 'selected="selected"' ?>value="heartbeat">heartbeat</option>
  		
	</select>
	 </div>	



	<table id="listhost" class="table table-striped table-bordered" width="100%" cellspacing="0">
		<thead>
			<tr>
				
				<th>Real Server</th>
				<th>Port</th>
				<th>host #tag</th>
				<th width="15%">Action</th>
			</tr>
		</thead>
		<tbody>
			
			<tr>
				<td><?=$server[0]['description']?></td>
				<td><?=$server[0]['port']?></td>
				
				<td >
		
					</td>
			</tr>
			
			<?php
			foreach ($list as $s) {
			?>
			<tr>
				
				<td><?=$s->ip?></td>
				<td><?=$s->port?></td>
				<td><?=$s->name?></td>
				<td >
					<button onclick="editserverlb(<?=$s->host_id?>);" data-toggle="modal" data-target="#myModal">Edit</button> 
					<button onclick="padamserverlb(<?=$s->host_id?>)" >Delete</button></td>
			</tr>
			<?php	
			}
			?>
		
		</tbody>
	</table>
	<button id="addlb" <?php if($server[0]['lb'] == '0') echo "style='display:none'" ?>   onclick="addserverlb(<?=$server[0]['id']?>);" data-toggle="modal" data-target="#myModal">Add New Server</button> 
	<button onclick="updateserver(<?=$server[0]['id']?>)">Update</button></td>


</div>

<div role="tabpanel"  class="tab-pane <?=$tabdomain?>" id="domain">
<!-- rulse exp -->

		
		<table class='table table-bordered'>
			<tr>
				<th>Mod Security Config Files</th><th>Status</th>
			</tr>
			<?php
			
			foreach($baseRules as $file) {
			?>
			<tr >

				<td><?=str_replace('_',' ',substr($file,19,-5))?></td>
				<td width="5%">
								<!---muiz-->
				
						

				<?php if (in_array($file, $activatedRules)){ ?>
		
		
				   	
				   	<div class="widget-toolbar">
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('c','<?=$file?>',1)" id="skip-validation" type="checkbox" checked="true"  class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
		
				<?php } else { ?> 
	
		    			
		    		<div class="widget-toolbar">
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('c','<?=$file?>',0)" id="skip-validation" type="checkbox" class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
				<?php } ?>
				
				<input type="checkbox" class="ace ace-switch ace-switch-3" />

				</td>
			</tr>
			<?php } ?>
			
		</table>
		
</div>
<div role="tabpanel"  class="tab-pane <?=$tabdisable?>" id="disable">

 <div class="row">
              <div class="col-md-12">
                <div class="pull-left">RULES ID : 
				<input type="text" name="url" id="ruleidh" />  <button onclick="addnewrules('1')" id="addidx">Add</button></div>
              
              <div class="pull-right">

                 </div>
                   
              </div>
          </div>
          <hr />
          <div class="row">
              <div class="col-md-12">
                <table  id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
              <thead>
              <tr>
                  <th>Rules ID</th>
                  
                  <th>Action</th>
              </tr>
              </thead>
              <tfoot>
          
              </tfoot>
              <tbody>
              <?php if (count($listid) == 0) {
              ?>		
              <tr>
              	<td colspan="2" align="center"> No Rules Display </td>
              </tr>
              <?php	
              } ?>	
         	  <?php foreach ($listid as $b) { ?>
              <tr>
                  <td><?=$b->rules?></td>
                  
                  <td width="15%">
                  	<button onclick="editrules(<?=$b->vrulesd_id?>,'1')" data-toggle="modal" data-target="#myModal">Edit</button> 
                  	<button onclick="padamrules(<?=$b->vrulesd_id?>,'1')">Delete</button>
                  	</td>  
              </tr>
              <?php } ?>
          
              </tbody>
          </table>
              </div>
          </div>


</div>
<div role="tabpanel"  class="tab-pane <?=$tabblack?>" id="black">
	
          
              Add Domain/IP : <input type="text" name="burlh" id="burlh" />  
              <button id="addurl" onclick="addnewrules('2')">Add</button>
              <hr />
             <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
				<th>ID</th>
                <th>Name</th>
               
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
     
        </tfoot>
        <tbody>
           <?php foreach ($blacklist as $b) { ?>
              <tr>
                  <td><?=30000+$b->vrulesb_id?></td>
                  <td><?=$b->rules?></td>
                  
                  <td width="15%">
                  	<button onclick="editrules(<?=$b->vrulesb_id?>,'2')" data-toggle="modal" data-target="#myModal">Edit</button> 
                  	<button onclick="padamrules(<?=$b->vrulesb_id?>,'2')">Delete</button></td>
              </tr>
              <?php } ?>
           
        </tbody>
    </table> 
              
</div>
<div role="tabpanel"  class="tab-pane <?=$tabwhite?>" id="white">
<p>
              Add Domain/IP : <input type="text" name="wurlh" id="wurlh" /> 
               <button id="addurl" onclick="addnewrules('3')">Add</button>
              <hr />
             <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
				<th>ID</th>
                <th>Name</th>
               
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
     
        </tfoot>
        <tbody>
           <?php foreach ($whitelist  as $b) { ?>
              <tr>
                  <td><?=40000+$b->vrulesw_id?></td>
                  <td><?=$b->rules?></td>
                  
                  <td width="15%">
                  	<button onclick="editrules(<?=$b->vrulesw_id?>,'3')" data-toggle="modal" data-target="#myModal">Edit</button> 
                  	<button onclick="padamrules(<?=$b->vrulesw_id?>,'3')">Delete</button></td>
              </tr>
              <?php } ?>
           
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
        <h4 class="modal-title" id="myModalLabel"> </h4>
      </div>
      <div class="modal-body" >
        <div id="popedit">
        	
        </div>
      </div>
      <div id="savebtn" class="modal-footer">
        
        
        
      </div>
    </div>
  </div>
</div>

<script>
		$("#ssl").click(function(){
			$("#viewssl").slideDown('show');
		});
		$("#sslengin").change(function(){
			if($(this).val() == 'on'){
			  $("#sslcert").slideDown('show');
			}else{
			  $("#sslcert").slideUp('hide');
			}
		});
		$("#lb").change(function(){
			if($(this).val() == '1'){
			 
			  $("#lbtype").slideDown('show');
			  $("#addlb").slideDown('show');
			}else{
			  $("#lbtype").slideUp('hide');
			  $("#addlb").slideUp('hide');
			}
		});

function updatessl(){
	$.post('panel/pilihssl',{serverid:<?=$server[0]['id']?>,SSLEngine:$("#sslengin").val()},function(data){

		var link = $('li.active a[data-toggle="tab"]');
		link.parent().removeClass('active');
		var tabLink = link.attr('href');
		$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
	});
}
function updatemod(){
	$.post('panel/pilihmod',{serverid:<?=$server[0]['id']?>,modsec:$("#modsec").val()},function(data){

                var link = $('li.active a[data-toggle="tab"]');
                link.parent().removeClass('active');
                var tabLink = link.attr('href');
                $('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
        });
}
function updatesslkey(){
	var dataserver = {
		serverid:<?=$server[0]['id']?>,
		SSLCertificateFile:$("#SSLCertificateFile").val(),
		SSLCertificateKeyFile:$("#SSLCertificateKeyFile").val(),
		SSLCertificateChainFile:$("#SSLCertificateChainFile").val()
		};
	
	$.post('panel/editserversimpanssl',dataserver,function(data){
		var link = $('li.active a[data-toggle="tab"]');
		link.parent().removeClass('active');
		var tabLink = link.attr('href');
		$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
	});
}

function addserverlb(id){
	
	
	$.post('panel/addserverlb',{id:id},function(data){
		$("#myModalLabel").html("New Server");
		$("#savebtn").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" onclick="savenewlb();" class="btn btn-primary">Add new</button>');
		$("#popedit").html(data);
		
	});	
	
}
function activelb(){
	
	var pdata = {
		lb : $("#lb").val(),
		serverid : <?=$server[0]['id']?>
	}
	$.post('panel/pilihlb',pdata,function(data){

		var link = $('li.active a[data-toggle="tab"]');
		link.parent().removeClass('active');
		var tabLink = link.attr('href');
		$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
	});
}
function mlb(){
	var pdata = {
		lbmethod : $("#lbmethod").val(),
		serverid : <?=$server[0]['id']?>
	}
	$.post('panel/lbmethod',pdata,function(data){

		var link = $('li.active a[data-toggle="tab"]');
		link.parent().removeClass('active');
		var tabLink = link.attr('href');
		$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
	});
}
function savenewlb(){
	
	var sdata = {
		name : $("#tag").val(),
		serverid : <?=$server[0]['id']?>,
		ip : $("#ip").val(),
		port : $("#port2").val(),
		route : $("#route").val(),
		loadfactor : $("#loadfactor").val(),
		timeout : $("#timeout").val(),
		lblset : $("#lblset").val(),
		status : $("#status").val(),
	}
	$.post('panel/newlbhost',sdata,function(data){

		var link = $('li.active a[data-toggle="tab"]');
		link.parent().removeClass('active');
		var tabLink = link.attr('href');
		$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
	});
}
function saveeditlb(id){
	
	var sdata = {
		id : id,
		name : $("#tag").val(),
		serverid : <?=$server[0]['id']?>,
		ip : $("#ip").val(),
		port : $("#port2").val(),
		route : $("#route").val(),
		loadfactor : $("#loadfactor").val(),
		timeout : $("#timeout").val(),
		lblset : $("#lblset").val(),
		status : $("#status").val(),
	}
	$.post('panel/editlbhost',sdata,function(data){

		var link = $('li.active a[data-toggle="tab"]');
		link.parent().removeClass('active');
		var tabLink = link.attr('href');
		$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
	});
}
function padamserverlb(id){
	
	if(confirm("Are you sure you want to delete this?")){
		
		$.post('panel/padamserverlb',{id:id},function(data){
			
			var link = $('li.active a[data-toggle="tab"]');
			link.parent().removeClass('active');
			var tabLink = link.attr('href');
			$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
		
		});		

	}
	else {
		
	}
}
function editserverlb(id){
	
	
	$.post('panel/editserverlb',{id:id},function(data){
		$("#myModalLabel").html("Edit Server");
        $("#savebtn").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" onclick="saveeditlb('+id+');" class="btn btn-primary">Save Change</button>');

		$("#popedit").html(data);
		
	});	
	
}


function addnewrules(type){
	
	if(type == 1){
		rueles = $('#ruleidh').val();
	}	
	if(type == 2){
		rueles = $('#burlh').val();
	}
	if(type == 3){
		rueles =  $('#wurlh').val();
	}
	
	
	
	$.post('myrules/addrules',{id:<?=$server[0]['id']?>,url:rueles,type:type},function(data){
				
				var link = $('li.active a[data-toggle="tab"]');
				link.parent().removeClass('active');
				var tabLink = link.attr('href');
				$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
				//$('#paparx').load('panel/white',{stab:tabLink}).show();
	});
	
}
function editrules(id,type){
   
	if(type == 1){
		$("#myModalLabel").html("Edit Disable Rules");
	}	
	if(type == 2){
		$("#myModalLabel").html("Edit Black Rules");
	}
	if (type == 3){
		$("#myModalLabel").html("Edit White Rules");
	}
	$.post('panel/editvrules',{id:id,jenis:type},function(data){
				
		
		$("#savebtn").html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" onclick="saveeditrules('+id+','+type+');" class="btn btn-primary">Save Rules</button>');
		$("#popedit").html(data);
	});
}
function saveeditrules(id,type){
	
			$.post('myrules/editvrules',{id:id,type:type,rules:$('#vrules').val()},function(data){

			var link = $('li.active a[data-toggle="tab"]');
			link.parent().removeClass('active');
			var tabLink = link.attr('href');
			$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
	});
}
function padamrules(id,type){
	
	
	$.post('myrules/padamrules',{id:id,type:type},function(data){

			var link = $('li.active a[data-toggle="tab"]');
			link.parent().removeClass('active');
			var tabLink = link.attr('href');
			$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
	});

}
function aktif(type,rules,status){

   $.post('myrules/domainrules',{id:<?=$server[0]['id']?>,type:type,rules:rules,status:status},function(data){
			var link = $('li.active a[data-toggle="tab"]');
			link.parent().removeClass('active');
			var tabLink = link.attr('href');
			$('#paparx').load('panel/confadvance',{id:<?=$server[0]['id']?>,stab:tabLink}).show();
	});
}

</script>
