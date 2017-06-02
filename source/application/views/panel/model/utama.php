				<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!--
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
									
									<i class="ace-icon fa fa-check green"></i>
									
									<strong class="green">
										
										<small>(v0.01 Beta)</small>
									</strong>
									
								</div>
-->
								<div class="row">

									
								
								</div><!-- /.row -->


								<div class="row">
									
								<div class="col-sm-12">
										<div class="panel panel-default">
  <div class="panel-heading">SERVER STATUS</div>
  <div class="panel-body">
    <div id="live"></div>
  </div>
</div>
										
									
								
								</div><!-- /.row -->

								<div class="hr hr32 hr-dotted"></div>

								<!-- PAGE CONTENT ENDS -->
								</div><!-- /.col -->
						</div><!-- /.row -->
<script src="/asset/assets/js/jquery.2.1.1.min.js"></script>
<script>


$(document).ready(function() {
    startRefresh();
});
	

function startRefresh() {
	    
	    lari = setTimeout(startRefresh,4000);
	    
	    $.post('panel/live_cpu',{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'}, function(data) {
	        //$('#plog').html(data); 
	        $("#live").html(data).show();
	        //$("#testx").html(data);   
	    });
	    
	    
}

</script>


