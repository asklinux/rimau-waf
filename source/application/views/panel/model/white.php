
					
	<div class="page-content">						
	<ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#url">URL</a> </li>
        <li><a data-toggle="tab" href="#ip">IP</a> </li>
        <li><a data-toggle="tab" href="#all">All Rules</a> </li>

	</ul>

  <div class="tab-content">
      <div id="url" class="tab-pane fade in active">
          <h3>Whitelist URL</h3>
          <p>
          <div class="row">
              <div class="col-md-12">
                <div class="pull-left">Add URL : <input type="text" name="url" id="wdurl" />  <button id="waddurl">Add</button></div>
              
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
                  <th>ID</th>
                  <th>URL Pattern</th>
                  <th>Status</th>
                  
                  <th>Action</th>
              </tr>
              </thead>
              <tfoot>
          
              </tfoot>
              <tbody>
         	  <?php foreach ($whitelist_url as $u) { ?>
              <tr>
                  <td><?=10000+$u->bid?></td>
                  <td><?=$u->url_pattern?></td>
                  <td width="3%"><?=$u->status?></td>
                  
                  <td width="15%">
                  	<button onclick="editrules(<?=$u->bid?>)" data-toggle="modal" data-target="#myRule">Edit</button> 
                  	<button onclick="padamrules(<?=$u->bid?>)">Delete</button>
                  	</td>  
              </tr>
              <?php } ?>
          
              </tbody>
          </table>
              </div>
          </div>
          </p>
      </div>
      <div id="ip" class="tab-pane fade">
          <h3>Whitelist IP</h3>
          <p>
          <div class="row">
              <div class="col-md-12">
                  <div class="pull-left">Add IP : <input type="text" name="ip" id="wdip" />  <button id="waddip">Add</button></div>
                  <div class="pull-right">
                  	<!--
                  	<i class="fa fa-eye" aria-hidden="true"></i> <a href="view.php">
                          View Whitelist-IP Configuration</a>
                    -->
                  </div>
              </div>
          </div>
          <hr />
          <div class="row">
              <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                       <tr>
                          <th>ID</th>
                          <th>IP</th>
                          <th>Status</th>
                          
                          <th>Action</th>
                       </tr>
                      </thead>
                      <tfoot>
                     
                      </tfoot>
                       <tbody>
                      <?php foreach ($whitelist_ip as $b) { ?>
		              <tr>
		                  <td><?=10000+$b->bid?></td>
		                  <td><?=$b->url_pattern?></td>
		                  <td width="3%"><?=$b->status?></td>
		                  
		                  <td width="15%">
                  	<button onclick="editrules(<?=$b->bid?>)" data-toggle="modal" data-target="#myRule">Edit</button> 
                  	<button onclick="padamrules(<?=$b->bid?>)">Delete</button>
                  	</td>  
		              </tr>
		              <?php } ?>
                    </tbody>
                </table>
              </div>
          </div>
          </p>
      </div>
          <div id="all" class="tab-pane fade">
      <h3>All Rules</h3>
	  <p>
    	<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
				<th>ID</th>
                <th>Name</th>
                <th>Status</th>
               
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
     
        </tfoot>
        <tbody>
           <?php foreach ($whitelist as $b) { ?>
              <tr>
                  <td><?=10000+$b->bid?></td>
                  <td><?=$b->url_pattern?></td>
                  <td width="3%"><?=$b->status?></td>
                  
                  <td width="15%">
                  	<button onclick="editrules(<?=$b->bid?>)" data-toggle="modal" data-target="#myRule">Edit</button> 
                  	<button onclick="padamrules(<?=$b->bid?>)">Delete</button></td>
              </tr>
              <?php } ?>
           
        </tbody>
    </table>
    </p>
    </div>
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