	<div class="row">
		
		<div class="col-xs-12" >
		
			<div class="form-horizontal">
				


				
				<div class="form-group">
				
				<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Elasticsearch Server</label>

				<div class="col-sm-9">
					<input type="text" id="elastic" placeholder="localhost:9200" class="col-xs-10 col-sm-5" />
				</div>
				</div>
				<div class="space-4">
					
				</div>

				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-3"> Kabana Server</label>

				<div class="col-sm-9">
					<input type="text" id="kibana" placeholder="localhost:5601" class="col-xs-10 col-sm-5" />
				</div>
				
				</div>
				
				
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-3"></div>
			<div class="col-xs-9">
				<div class="form-group">
					<button id="changepass">Update Configure</button>
				</div>
			</div>
		</div>
	</div>
<script>


$('#changepass').click(function(){
	$.post('panel/ubahpassword',{old:$('#oldpass').val(),new:$('#newpass').val()},function(data){
		
		if(data == 'hoi'){
			alert('Wrong Old Password')
		}
		else{
			$('#paparx').html('<div class="alert alert-success" role="info">The Password Succes Change</div>').fadeIn();
		}
		
	});
});

$(document).ready(function() {
    clearTimeout(lari);
    clearTimeout(livelog);		
});
</script>