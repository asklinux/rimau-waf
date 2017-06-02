	<div class="row">
		
		<div class="col-xs-12" >
		
			<div class="form-horizontal">
				


				
				<div class="form-group">
				
				<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Old Password </label>

				<div class="col-sm-9">
					<input type="password" id="oldpass" placeholder="Old Password" class="col-xs-10 col-sm-5" />
				</div>
				</div>
				<div class="space-4">
					
				</div>

				<div class="form-group">
				<label class="col-sm-3 control-label no-padding-right" for="form-field-3"> New Password </label>

				<div class="col-sm-9">
					<input type="password" id="newpass" placeholder="New Password" class="col-xs-10 col-sm-5" />
				</div>
				
				</div>
				
				
			</div>
		</div>
		<div class="col-xs-12">
			<div class="col-xs-3"></div>
			<div class="col-xs-9">
				<div class="form-group">
					<button id="changepass">Change Password</button>
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