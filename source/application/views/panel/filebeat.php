<div class="panel panel-default">	
	  <div class="panel-heading">FILEBEAT STATUS</div>
  <div class="panel-body">
    <div id="status">
		<?=$status?>

		<?php 
		$snow = substr($status,11,17); 
		
		?>
		<br/><br/>
		<?php if ($snow == "active (running) "){ ?>
		<button class="btn btn-sm btn-danger" onclick="fbstat(0);" >Disable filebeat</button>
		<?php }else{  ?>
		<button class="btn btn-sm btn-success" onclick="fbstat(1);">Enable filebeat</button>
		<?php } ?>
	</div>
  </div>
</div>
  <hr/>
	<div class="row">
		
		<div class="col-xs-12" >
		
			<div class="form-horizontal">
				


				
				<div class="form-group">
				
				<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Elasticsearch Server</label>

				<div class="col-sm-9">
					<input type="text" id="elastic" value="<?=$es?>" placeholder="localhost:9200" class="col-xs-10 col-sm-5" />
				</div>
				</div>
				<div class="space-4">
					
				</div>

				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-3"> Kabana Server</label>

				<div class="col-sm-9">
					<input type="text" id="kibana" value="<?=$kabana?>" placeholder="localhost:5601" class="col-xs-10 col-sm-5" />
				</div>
				
				</div>
				
				
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-3"></div>
			<div class="col-xs-9">
				<div class="form-group">
					<button id="updateserver">Update Configure</button>
				</div>
			</div>
		</div>
	</div>
<script>


$('#updateserver').click(function(){
	$.post('panel/updatelog',{elastic:$('#elastic').val(),kibana:$('#kibana').val()},function(data){
		

	});
});
function fbstat(stat){

	$.post('/panel/fbstat',{stat:stat},function(data){
		$('#paparx').load('panel/filebeat').show();
	});

}
$(document).ready(function() {
    clearTimeout(lari);
    clearTimeout(livelog);		
});
</script>