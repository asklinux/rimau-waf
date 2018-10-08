
					
	<div class="page-content">						
	

          <h3>Disable Rules</h3>
          <p>
          <div class="row">
              <div class="col-md-12">
                <div class="pull-left">RULES ID : <input type="text" name="url" id="ruleid" />  <button id="addidx">Add</button></div>
              
              <div class="pull-right">
              	<!--
              	<i class="fa fa-eye" aria-hidden="true"></i> 
              	
              	<a href="view.php">
                      View Whitelist-URL Configurationn</a>
                -->
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
                  <td><?=$b->rules_id?></td>
                  
                  <td width="15%">
                  	<button onclick="editrules(<?=$b->id?>)" data-toggle="modal" data-target="#myRule">Edit</button> 
                  	<button onclick="padamrules(<?=$b->id?>)">Delete</button>
                  	</td>  
              </tr>
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

$("#addidx").click(function(){
	
	
	if ($('#ruleid').val() === '') {
	
		alert("please enter the id information");
	
	}
	else {
		
		$.post('myrules/disable',{url:$('#ruleid').val(),status:0},function(data){
		
			var link = $('li.active a[data-toggle="tab"]');
			link.parent().removeClass('active');
			var tabLink = link.attr('href');
			
			$('#paparx').load('panel/disablerules',{stab:tabLink}).show();
		}); 
	}
	
});


function padamrules(id){
	
	if(confirm("Are you sure you want to delete this?")){
		
		$.post('panel/padamrules',{id:id,jenis:3},function(data){
		
		$('#paparx').load('panel/disablerules').show();
		
		});		

	}
	else {
		
	}
}
function editrules(id){
	
	$.post('panel/editrules',{id:id,jenis:3},function(data){
		
		
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

		$('#paparx').load('panel/disablerules').show();
	});
	
}


</script>