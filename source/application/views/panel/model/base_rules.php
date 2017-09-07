


<?php

	
	if ($mytab == "#anomaly" ){
		$ptap_anomaly = 'class="active"';
		$itap_anomaly = 'active';
		
		$ptap_home = '';
		$itap_home = '';
		
		$ptap_profile = '';
		$itap_profile = '';
		$ptap_comodo = '';
		$itap_comodo = '';
		$ptap_messages = '';
		$itap_messages = '';
		
	}
	else if ($mytab == "#profile" ){
		
		$ptap_profile = 'class="active"';
		$itap_profile = 'active';
		
		$ptap_anomaly = '';
		$itap_anomaly = '';
		
		$ptap_home = '';
		$itap_home = '';
		$ptap_comodo = '';
		$itap_comodo = '';
		$ptap_messages = '';
		$itap_messages = '';
		

	}
	else if ($mytab == "#messages" ){
		
		$ptap_profile = '';
		$itap_profile = '';
		
		$ptap_anomaly = '';
		$itap_anomaly = '';
		
		$ptap_home = '';
		$itap_home = '';
		$ptap_comodo = '';
		$itap_comodo = '';
		$ptap_messages = 'class="active"';
		$itap_messages = 'active';
		

	}
        else if ($mytab == "#comodo" ){
		
		$ptap_profile = '';
		$itap_profile = '';
		
		$ptap_anomaly = '';
		$itap_anomaly = '';
		
		$ptap_home = '';
		$itap_home = '';
		
                $ptap_messages = '';
		$itap_messages = '';
                
		$ptap_comodo = 'class="active"';
		$itap_comodo = 'active';
		

	}
	else{
		$ptap_home = 'class="active"';
		$itap_home = 'active';
	
		$ptap_anomaly = '';
		$itap_anomaly = '';
		
		$ptap_profile = '';
		$itap_profile = '';
		$ptap_messages = '';
		$itap_messages = '';
                $ptap_comodo = '';
		$itap_comodo = '';
	}

?>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist" id="mainTabs">
    <li role="presentation" <?=$ptap_home?>    ><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Base Rules</a></li>
    <li role="presentation" <?=$ptap_anomaly?> ><a href="#anomaly" aria-controls="anomaly" role="tab" data-toggle="tab">Anomaly Protocol</a></li>
    <li role="presentation" <?=$ptap_profile?> > <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Experimental Rules</a></li>
    <li role="presentation" <?=$ptap_comodo?> ><a href="#comodo" aria-controls="comodo" role="tab" data-toggle="tab">Comodo Rules</a></li>
    <li role="presentation" <?=$ptap_messages?> ><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Create Rules</a></li>
    <li role="presentation"><a href="#aktif" aria-controls="aktif" role="tab" data-toggle="tab">Activated Rules</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane <?=$itap_home?>" id="home">
    	

		
		<table class='table table-bordered'>
			<tr>
				<th>Mod Security Config Files</th><th>Status</th>
			</tr>
			<?php
			foreach($baseRules as $file) {
			?>
			<tr >
                            <td onclick="readfile('a','<?=$file?>');"><?=str_replace('_',' ',substr($file,19,-5))?></td>
				<td width="5%">
				<?php if (in_array($file, $activatedRules)){ ?>
		
			
				   	<div class="widget-toolbar">
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('a','<?=$file?>',1)" id="skip-validation" type="checkbox" checked="true"  class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
		
				<?php } else { ?> 
					
					<div class="widget-toolbar">
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('a','<?=$file?>',0)" id="skip-validation" type="checkbox"   class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
				<?php } ?>
				

				</td>
			</tr>
			<?php } ?>
			
		</table>

</div>
    <div role="tabpanel" class="tab-pane <?=$itap_anomaly?>" id="anomaly"> 
    	
    	<!-- rulse exp -->

		
		<table class='table table-bordered'>
			<tr>
				<th>Mod Security Config Files</th><th>Status</th>
			</tr>
			<?php
			foreach($anomalyProtocol as $file) {
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
    <div role="tabpanel" class="tab-pane <?=$itap_profile?>" id="profile">
    	
    	<!-- rulse exp -->

		
		<table  class="table table-bordered">
			<tr>
				<th>Mod Security Config Files</th><th>Status</th>
			</tr>
			
			<?php foreach($experimentalRules as $file) { ?>
			
			<tr>
				<td><?=str_replace('_',' ',substr($file,19,-5))?></td>
				<td width="5%">
				<?php if (in_array($file, $activatedRules)){ ?> 
			
				<div class="widget-toolbar">
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('b','<?=$file?>',1)" id="skip-validation" type="checkbox" checked="true"   class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
				<?php } else { ?> 
					
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('b','<?=$file?>',0)" id="skip-validation" type="checkbox"   class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
				<?php } ?>
				</td>
			</tr>
			<?php } ?>
			
		</table>


	</div>
  <div role="tabpanel" class="tab-pane <?=$itap_comodo?>"   id="comodo">
    	
    	<table class='table table-bordered'>
			<tr>
				<th>Mod Security Config Files</th><th>Status</th>
			</tr>
			<?php
			foreach($comodoRules as $file) {
			?>
			<tr >
				<td><?=str_replace('_',' ',substr($file,3,-5))?></td>
				<td width="5%">
				<?php if (in_array($file, $activatedRules)){ ?>
		
			
				   	<div class="widget-toolbar">
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('e','<?=$file?>',1)" id="skip-validation" type="checkbox" checked="true"  class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
		
				<?php } else { ?> 
					
					<div class="widget-toolbar">
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('e','<?=$file?>',0)" id="skip-validation" type="checkbox"   class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
				<?php } ?>
				

				</td>
			</tr>
			<?php } ?>
			
		</table>
    	
    </div>
    <div role="tabpanel" class="tab-pane <?=$itap_messages?>"   id="messages">
    	
    	<table class='table table-bordered'>
			<tr>
				<th>Mod Security Config Files</th><th>Status</th>
			</tr>
			<?php
			foreach($rimauRules as $file) {
			?>
			<tr >
				<td><?=str_replace('_',' ',substr($file,19,-5))?></td>
				<td width="5%">
				<?php if (in_array($file, $activatedRules)){ ?>
		
			
				   	<div class="widget-toolbar">
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('d','<?=$file?>',1)" id="skip-validation" type="checkbox" checked="true"  class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
		
				<?php } else { ?> 
					
					<div class="widget-toolbar">
					<label> <small class="green"> <b>Filter</b> </small>
						<input onclick="aktif('d','<?=$file?>',0)" id="skip-validation" type="checkbox"   class="ace ace-switch ace-switch-4" />
						<span class="lbl middle"></span> </label>
					</div>
				<?php } ?>
				

				</td>
			</tr>
			<?php } ?>
			
		</table>
    	
    </div>
    <div role="tabpanel" class="tab-pane " id="aktif">
    	
		
		
		<table class='table table-bordered'>
			<tr>
				<th>Mod Security Config Files</th><th>Status</th>
			</tr>
			<?php foreach($activatedRules as $file) { ?>
			
			<tr>
				<td><?=str_replace('_',' ',substr($file,3,-5))?></td><td>Enabled</td>
			</tr>
			<?php } ?>
			
		</table>
    	
    </div>
  </div>

</div>

<script>
	function aktif(id,fail,ack){
		
		var url = 'panel/actif_rules'
		
                    $.post(url,{id:id,fail:fail,ack:ack},function(data){
			
			var link = $('li.active a[data-toggle="tab"]');
			link.parent().removeClass('active');
			var tabLink = link.attr('href');
			
			$('#paparx').load('panel/rules',{stab:tabLink}).show();
			

			

			

		});
	}
        function readfile(id,file){
            $('#paparx').load('panel/rulesfail',{id:id,file:file}).show();
        }
	
	
</script>

<script>
$(document).ready(function() {
    clearTimeout(lari);
    clearTimeout(livelog);
    break;		
});
</script>

		