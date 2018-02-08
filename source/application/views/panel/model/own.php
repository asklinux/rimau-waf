
					
	<div class="page-content">						
	

       
    
          <div class="row">   
          	<h3>Write Own Rules</h3>
          	<hr/>
              <div class="col-md-12">
                
                	<form class="form-horizontal" role="form">

					<div class="form-group">
						<label class="col-sm-3 control-label " for="form-field-1-1"> Rules Name </label>

						<div class="col-sm-9">
							<input type="text" id="form-field-1-1" placeholder="Text Field" class="form-control" />
						</div>
					</div>
                	<div class="form-group">
						<label class="col-sm-3 control-label  " for="form-field-1-1"> Rules </label>

						<div class="col-sm-9">
						<textarea class="form-control"></textarea>	
						</div>
						
						
					</div>
					<div class="form-group">
						<button class="pull-right" id="waddurl">Add</button>
					</div>
                	
                	
                	</form>
           

                   
              </div>
          </div>
   
          <div class="row">
              <div class="col-md-12">
                <table  id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
              <thead>
              <tr>
                  <th>Rules ID</th>
                  <th width="50%">Rules</th>
                  <th>Status</th>
                  
                  <th>Function</th>
              </tr>
              </thead>
              <tfoot>
          
              </tfoot>
              <tbody>
              <?php if (count($listid) == 0) { ?>
              	<tr>
              		<td colspan="4" align="center">No Rules</td>
              	</tr>
              <?php } else {?>
         	  <?php foreach ($listid as $b) { ?>
              <tr>
                  <td><?=$b->orid?></td>
                  <td width="50%"><?=$b->rules?></td>
                  <td width="3%"><?=$b->status?></td>
                  <td width="5%">
                  	<button onclick="editrules(<?=$b->orid?>)" data-toggle="modal" data-target="#myRule">Edit</button> 
                  	<button onclick="padamrules(<?=$b->orid?>)">Delete</button>
                  	</td>  
              </tr>
              <?php } ?>
          	  <?php } ?>
              </tbody>
          </table>
              </div>
          </div>
          </p>
      
  </div>

</div><!-- /.page-content -->

<div class="modal fade" id="myRule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit White Rule</h4>
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
$(document).ready(function() {
    clearTimeout(lari);
    clearTimeout(livelog);
    break;		
});

$("#waddurl").click(function(){
	
	
	if ($('#wdurl').val() === ''){
	
		alert("please enter the url information");
	
	}
	else {
		
		$.post('myrules/whitelist',{url:$('#wdurl').val(),jenis:0},function(data){
		
			var link = $('li.active a[data-toggle="tab"]');
			link.parent().removeClass('active');
			var tabLink = link.attr('href');
			
			$('#paparx').load('panel/white',{stab:tabLink}).show();
		}); 
	}
	
});

$("#waddip").click(function(){
	
	if ($('#wdip').val() === ''){
	
		alert("please enter the url information");
	
	}
	else {
		$.post('myrules/whitelist',{url:$('#wdip').val(),jenis:1},function(data){
				
				var link = $('li.active a[data-toggle="tab"]');
				link.parent().removeClass('active');
				var tabLink = link.attr('href');
				
				$('#paparx').load('panel/white',{stab:tabLink}).show();
		});
	}
});

function padamrules(id){
	
	if(confirm("Are you sure you want to delete this?")){
		
		$.post('panel/padamrules',{id:id,jenis:2},function(data){
		
		$('#paparx').load('panel/white').show();
		
		});		

	}
	else {
		
	}
}
function editrules(id){
	
	$.post('panel/editrules',{id:id,jenis:2},function(data){
		
		
		$("#popedit").html(data);
		
	});	
}
function saveedit(){
	
	var dataserver = {
		id:$("#id2").val(),
		host:$("#rules").val(),
		jenis:2
		};
	
	$.post('panel/editrulessimpan',dataserver,function(data){

		$('#paparx').load('panel/white').show();
	});
	
}


</script>