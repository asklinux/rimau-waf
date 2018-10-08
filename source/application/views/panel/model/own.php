
					
	<div class="page-content">						
	

       
    
          <div class="row">   
          	<h3>Write Own Rules</h3>
          	<hr/>
              <div class="col-md-12">
                
                	<form class="form-horizontal" role="form">

					<div class="form-group">
						<label class="col-sm-3 control-label " for="form-field-1-1"> Rules Name </label>

						<div class="col-sm-9">
							<input type="text" id="name" name="rules" placeholder="Rules Name" class="form-control" />
						</div>
					</div>
                	<div class="form-group">
						<label class="col-sm-3 control-label  " for="form-field-1-1"> Rules </label>

						<div class="col-sm-9">
						<textarea class="form-control" id="rules" name="rules"></textarea>	
						</div>
						
						
					</div>
					<div class="form-group">
						<button class="pull-right" id="addrules">Add</button>
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
                  <th width="50%">Rules Name</th>
                  
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
                  <td><?=$b->rid?></td>
                  <td width="50%"><?=$b->name?></td>
                  <td width="15%">
                  	<button onclick="editrules(<?=$b->rid?>)" data-toggle="modal" data-target="#myRule">Edit</button> 
                  	<button onclick="padamrules(<?=$b->rid?>)">Delete</button>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Own Rule</h4>
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

$('form').submit(false);

$("#addrules").click(function(e){
	e.preventDefault()
	
	if ($('#rules').val() === ''){
	
		alert("please enter the url information");
	
	}
	else {
		
		$.post('myrules/ownlist',{name:$('#name').val(),rules:$('#rules').val()},function(data){
		
			var link = $('li.active a[data-toggle="tab"]');
			link.parent().removeClass('active');
			//var tabLink = link.attr('href');
			
			$('#paparx').load('panel/ownrules').show();
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
		
		$.post('panel/padamownrules',{id:id},function(data){
		
			$('#paparx').load('panel/ownrules').show();
		
		});		

	}
	
}
function editrules(id){
	
	$.post('panel/editownrules',{id:id,jenis:2},function(data){
		
		
		$("#popedit").html(data);
		
	});	
}
function saveedit(){
	
	var dataserver = {
		id:$("#id2").val(),
		name:$("#namee").val(),
		rules:$("#rulese").val()
		};
	
	$.post('panel/editownsimpan',dataserver,function(data){

		$('#paparx').load('panel/ownrules').show();
	});
	
}

$(document).ready(function() {
    clearTimeout(lari);
    clearTimeout(livelog);
    //break;		
});
</script>