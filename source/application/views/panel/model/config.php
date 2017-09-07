<?php

switch ($statusx) {
	case 'cbb2ab9c3f39443865a5ccd063413ccd' :
		$papar = '<img src="/asset/image/onwaf.jpg" />';
		$ion = 'checked="checked"';
		$ioff = '';
		$ido = '';
		break;
	case '218ae5144a248d152ba5d64e9a80eb9e' :
		$papar = '<img src="/asset/image/logwaf.jpg" />';
		$ioff = '';
		$ion = '';
		$ido = 'checked="checked"';
		break;
	default :
		$papar = '<img src="/asset/image/offwaf.jpg" />';
		$ido = '';
		$ioff = 'checked="checked"';
		$ion = '';
		break;
}
?>
<div class="page-content">						
	<div class="row">
		<div class="col-md-3" >
		
		</div>
		<div class="col-md-3" >
		
		
			<div class="control-group">
				<h4>Select Mode:</h4> <br />
				<div class="radio">
					<label>
						<input <?=$ido?>  name="form-field-radio" id="do"  type="radio" class="ace input-lg" />
						<span class="lbl bigger-120">DetectionOnly</span> </label>
				</div>
				
				<div class="radio">
					<label>
						<input <?=$ion?>  name="form-field-radio" id="on" type="radio" class="ace input-lg" />
						<span class="lbl bigger-120"> On</span> </label>
				</div>
				
				<div class="radio">
					<label>
						<input <?=$ioff?>  name="form-field-radio" id="off" type="radio" class="ace input-lg" />
						<span class="lbl bigger-120"> Off</span> </label>
				</div>


			</div>
		</div>
		<div class="col-md-6">
						
							<h4>Mod Security Status:</h4> <br />
							<?=$papar?>	
		</div>
	</div>
	<hr/>
</div>
<script src="/asset/assets/js/jquery.2.1.1.min.js"></script>

<script>
$(document).ready(function() {
    clearTimeout(lari);
    clearTimeout(livelog);
    break;		
});


$('#do').change(function() {
       
       $.post('panel/conf_change',{mod:'DetectionOnly','<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},function(data){
		$('#paparx').load('panel/config').show();
	   });
       
});
$('#on').change(function() {
       $.post('panel/conf_change',{mod:'On','<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},function(data){
		$('#paparx').load('panel/config').show();
	   });
});
$('#off').change(function() {
       
       $.post('panel/conf_change',{mod:'Off','<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},function(data){
		$('#paparx').load('panel/config').show();
	   });
});

</script>