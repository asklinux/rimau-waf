
			<div class="col-md-12">
						<fieldset>
							<!-- Tab -->
							<ul class="nav nav-tabs">
								<li class="active"><a href="#search" data-toggle="tab">Search Rules</a></li>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
										Create Custom Rules <span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li><a href="#dropdown1" data-toggle="tab">SecRuleRemoveById</a></li>
										<li><a href="#dropdown2" data-toggle="tab">SecRuleRemoveByMsg</a></li>
										<li><a href="#dropdown3" data-toggle="tab">SecRuleRemoveByTag</a></li>
										<!--<li class="divider"></li>
										<li><a href="#dropdown4" data-toggle="tab">SecRuleUpdateActionById</a></li>-->
									</ul>
								</li>
								<li><a href="#activate" data-toggle="tab">Added Custom Rules</a></li>
								<li><a href="#list" data-toggle="tab">List of Activated Rules</a></li>
							</ul>
							
							<!-- Tab Content -->
							<div id="myTabContent" class="tab-content">
								<!-- Search -->
								<div class="tab-pane fade active in" id="search">
									<br>
										<fieldset>
											<legend>Rules Listing</legend>
											<div class="form-group">
												<div class="col-md-12">
													<table class="table table-striped table-bordered table-hover" id="dataTables-example">
														<thead>
															<tr>
																<th>RULE ID</th>
																<th>RULE MESSAGE</th>
																<th>RULE TAG</th>
															</tr>
														</thead>
														<tbody>
															<?php
															
																  foreach($ruleslist as $r ) {
																	  $rules_id = $r->rules_id;
																	  $rules_msg = $r->rules_msg;
																	  $rules_tag = $r->rules_tag;
																	
																	
																	$rules_id = htmlspecialchars($r->rules_id,ENT_QUOTES);
																	$rules_msg = htmlspecialchars($r->rules_msg,ENT_QUOTES);
																	$rules_tag = htmlspecialchars($r->rules_tag,ENT_QUOTES);
																?> 
																<tr class="active">
																	<td><?php echo "$rules_id";?></td>
																	<td><?php echo "$rules_msg";?></td>
																	<td><?php echo "$rules_tag";?></td>
																</tr>
																<?php  } ?>	 
																
														</tbody>
													</table> 
												</div>
											</div>
										</fieldset>
									</form>
								</div>
								
								<!-- List -->
								<div class="tab-pane fade" id="list">
									<br>
										<fieldset>
											<legend>SecRuleRemoveById</legend>
											<div class="form-group">
												<table class="table table-striped table-hover table-bordered table-responsive">
													<thead>
														<tr>
															<th>Rules ID</th>
															<th>Codes</th>
															<th>Status</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
                                                        <?php
															
															 foreach ($ruleslist_a as $ra ) {
															    	
															    $id = $ra->id;
																$rules_id = $ra->rules_id;
																$codes = $ra->codes;
																$status = $ra->status;
																
																$id = htmlspecialchars($ra->id,ENT_QUOTES);
																$rules_id = htmlspecialchars($ra->rules_id,ENT_QUOTES);
																$codes = htmlspecialchars($ra->codes,ENT_QUOTES);
																$status = htmlspecialchars($ra->status,ENT_QUOTES);
															 
															?>
															<tr class="active">
																<td><?php echo "$rules_id";?></td>
																<td><?php echo "$codes";?></td>
																<td>Active</td>
																
																<td><a  onclick="change_z(<?=$id?>)" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Deactivate Me!</a></td>
																
															</tr>
															<?php } ?>
													</tbody>
												</table> 
												<script>
													function change_z(id){
																	
																	$.post('myrules/pro_secruleremovebyidremove',{id:id},function(data){
																		alert(data);
																	});
																	
													}
												</script>
											</div>
										</fieldset>
										<fieldset>
											<legend>SecRuleRemoveByMsg</legend>
											<div class="form-group">
												<table class="table table-striped table-hover table-bordered table-responsive">
													<thead>
														<tr>
															<th>Message</th>
															<th>Codes</th>
															<th>Status</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														
															  foreach ($ruleslist_a2 as $ra ) {
															    	
															    $id = $ra->id;
																$msg = $ra->msg;
																$codes = $ra->codes;
																$status = $ra->status;
																
																$id = htmlspecialchars($ra->id,ENT_QUOTES);
																$msg = htmlspecialchars($ra->msg,ENT_QUOTES);
																$codes = htmlspecialchars($ra->codes,ENT_QUOTES);
																$status = htmlspecialchars($ra->status,ENT_QUOTES);
															 
															?>
															<tr class="active">
																<td><?php echo "$msg";?></td>
																<td><?php echo "$codes";?></td>
																<td>Active</td>
																
																<td><a onclick="change_y(<?=$id?>)" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Deactivate Me!</a></td>
																
															</tr>
														<?php } ?>
													</tbody>
												</table> 
												<script>
													function change_y(id){
																	
																	$.post('myrules/pro_secruleremovebymsgremove',{id:id},function(data){
																		alert(data);
																	});
																	
													}
												</script>
											</div>
										</fieldset>
										<fieldset>
											<legend>SecRuleRemoveByTag</legend>
											<div class="form-group">
												<table class="table table-striped table-hover table-bordered table-responsive">
													<thead>
														<tr>
															<th>Tag</th>
															<th>Codes</th>
															<th>Status</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														
															  foreach ($ruleslist_a3 as $ra ) {
															    	
															    $id = $ra->id;
																$tag = $ra->tag;
																$codes = $ra->codes;
																$status = $ra->status;
																
																$id = htmlspecialchars($ra->id,ENT_QUOTES);
																$tag = htmlspecialchars($ra->tag,ENT_QUOTES);
																$codes = htmlspecialchars($ra->codes,ENT_QUOTES);
																$status = htmlspecialchars($ra->status,ENT_QUOTES);
															 
															?>
															<tr class="active">
																<td><?php echo "$tag";?></td>
																<td><?php echo "$codes";?></td>
																<td>Active</td>
																
																<td><a onclick="change_x(<?=$id?>)" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Deactivate Me!</a></td>
																
															</tr>
														<?php } ?>
													</tbody>
												</table> 
												<script>
													function change_x(id){
																	
																	$.post('myrules/pro_secruleremovebytagremove',{id:id},function(data){
																		alert(data);
																	});
																	
													}
												</script>
											</div>
										</fieldset>
								</div>
								
								<!-- Activate -->
								<div class="tab-pane fade" id="activate">
									<br>
										<fieldset>
											<legend>Added Custom Rules to Activate</legend>
											<div class="form-group">
												
												<h4>SecRuleRemoveById</h4>
												<table class="table table-striped table-hover table-bordered table-responsive">
													<thead>
														<tr>
															<th>ID</th>
															<th>Rules ID</th>
															<th>Codes</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
															
															  foreach ($ruleslist_b as $r ) {
																	
																$id = $r->id;
																$rules_id = $r->rules_id;
																$codes = $r->codes;
																$status = $r->status;
																
																$id = htmlspecialchars($r->id,ENT_QUOTES);
																$rules_id = htmlspecialchars($r->rules_id,ENT_QUOTES);
																$codes = htmlspecialchars($r->codes,ENT_QUOTES);
																$status = htmlspecialchars($r->status,ENT_QUOTES);
																
															 
															?>
															<tr class="active">
																<td><?php echo "$id";?></td>
																<td><?php echo "$rules_id";?></td>
																<td><?php echo "$codes";?></td>
																
																<?php if ($status == 'A') { ?>
																	<td><a onclick="change_a(<?php echo $id; ?>)" class="btn btn-info btn-sm disabled"><span class="glyphicon glyphicon-ok"></span> Already Activated</a></td>
																	<?php } else { ?>
																	<td><a onclick="change_b(<?php echo $id; ?>)"  class="btn btn-info btn-sm"><span class="glyphicon glyphicon-pencil"></span> Activate Me!</a> 
																		<a onclick="change_c(<?php echo $id; ?>)"  class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-floppy-remove"></span> Delete</a></td>	
																<?php } ?>
																
															</tr>
															<?php } ?>
															<script>
																function change_a(id){
																	
																	$.post('myrules/pro_secruleremovebyidactivate',{id:id},function(data){
																		alert(data);
																	});
																	
																}
																function change_b(id){
																	
																	$.post('myrules/pro_secruleremovebyidactivate',{id:id},function(data){
																		alert(data);
																	});
																	
																}
																function change_c(id){
																	
																	$.post('myrules/pro_secruleremovebyiddelete',{id:id},function(data){
																		alert(data);
																	});
																	
																}
															</script>
													</tbody>
												</table>
												
												<h4>SecRuleRemoveByMsg</h4>
												<table class="table table-striped table-hover table-bordered table-responsive">
													<thead>
														<tr>
															<th>ID</th>
															<th>Message</th>
															<th>Codes</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														
															 foreach ($ruleslist_b2 as $r ) {
																	
																$id = $r->id;
																$msg = $r->msg;
																$codes = $r->codes;
																$status = $r->status;
																
																$id = htmlspecialchars($r->id,ENT_QUOTES);
																$msg = htmlspecialchars($r->msg,ENT_QUOTES);
																$codes = htmlspecialchars($r->codes,ENT_QUOTES);
																$status = htmlspecialchars($r->status,ENT_QUOTES);
																
															?>
															<tr class="active">
																<td><?php echo "$id";?></td>
																<td><?php echo "$msg";?></td>
																<td><?php echo "$codes";?></td>
																
																<?php if ($status == 'A') { ?>
																	<td><a onclick="change_d(<?php echo $id; ?>);" class="btn btn-info btn-sm disabled"><span class="glyphicon glyphicon-ok"></span> Already Activated</a></td>
																	<?php } else { ?>
																	<td><a onclick="change_d(<?php echo $id; ?>);" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-pencil"></span> Activate Me!</a> 
																		<a onclick="change_e(<?php echo $id; ?>);" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-floppy-remove"></span> Delete</a></td>
																<?php } ?>
																
															</tr>
															<?php } ?>
													</tbody>
													<script>
																function change_d(id){
																	
																	$.post('myrules/pro_secruleremovebymsgactivate',{id:id},function(data){
																		alert(data);
																	});
																	
																}
																function change_e(id){
																	
																	$.post('myrules/pro_secruleremovebymsgdelete',{id:id},function(data){
																		alert(data);
																	});
																	
																}
											
															</script>
												</table>
												
												<h4>SecRuleRemoveByTag</h4>
												<table class="table table-striped table-hover table-bordered table-responsive">
													<thead>
														<tr>
															<th>ID</th>
															<th>Tag</th>
															<th>Codes</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
															
														
															 foreach ($ruleslist_b3 as $ra ) {
															    	
															    $id = $ra->id;
																$tag = $ra->tag;
																$codes = $ra->codes;
																$status = $ra->status;
																
																$id = htmlspecialchars($ra->id,ENT_QUOTES);
																$tag = htmlspecialchars($ra->tag,ENT_QUOTES);
																$codes = htmlspecialchars($ra->codes,ENT_QUOTES);
																$status = htmlspecialchars($ra->status,ENT_QUOTES);
															 
															?>
															<tr class="active">
																<td><?php echo "$id";?></td>
																<td><?php echo "$tag";?></td>
																<td><?php echo "$codes";?></td>
																
																<?php if ($status == 'A') { ?>
																	<td><a onclick="change_f(<?php echo $id; ?>)" class="btn btn-info btn-sm disabled"><span class="glyphicon glyphicon-ok"></span> Already Activated</a></td>
																	<?php } else { ?>
																	<td><a onclick="change_f(<?php echo $id; ?>)"  class="btn btn-info btn-sm"><span class="glyphicon glyphicon-pencil"></span> Activate Me!</a> 
																		<a onclick="change_g(<?php echo $id; ?>)"  class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-floppy-remove"></span> Delete</a></td>
																<?php } ?>
																
															</tr>
															<?php } ?>
															<script>
																function change_f(id){
																	
																	$.post('myrules/pro_secruleremovebytagactivate',{id:id},function(data){
																		alert(data);
																	});
																	
																}
																function change_g(id){
																	
																	$.post('myrules/pro_secruleremovebytagdelete',{id:id},function(data){
																		alert(data);
																	});
																	
																}
															</script>
													</tbody>
												</table>
											</div>
										</fieldset>
								</div>
								
								<!-- SecRuleRemoveById -->
								<div class="tab-pane fade" id="dropdown1">
									<br/>
										<fieldset>
											<legend>SecRuleRemoveById</legend>
                                            <h5>Removes the matching rules from the current configuration context (Rule ID).</h5>
                                            <br/>
											<div class="form-group">
												<label for="select" class="col-lg-2 control-label">ID</label>
												<div class="col-lg-8">
													<select class="form-control" id="SecRuleRemoveById_pilih" name="rules_id">
														<?php
															
															 foreach ($ruleslist_c as $ra ) {
															    	
															    $id = $ra->id;
																$rules_id = $ra->rules_id;
																$tag = $row->tag;
																$codes = $row->codes;
																
																$id = htmlspecialchars($ra->id,ENT_QUOTES);
																$rules_id = htmlspecialchars($ra->rules_id,ENT_QUOTES);
																$codes = htmlspecialchars($ra->codes,ENT_QUOTES);
															 
															 
															?>
															<option value="<?php echo "$rules_id";?>"><?php echo "$rules_id";?> - <?php echo "$tag";?></option>
															<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-lg-10 col-lg-offset-10">
													<button id="SecRuleRemoveById" class="btn btn-primary" name="add_btn"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
												</div>
											</div>
										</fieldset>
									
									<script>
										$("#SecRuleRemoveById").click(function(){
											
											$.post('myrules/pro_secruleremovebyid',{id:$("#SecRuleRemoveById_pilih").val()},function(data){
												alert(data);
											});
											
										});
									</script>
								</div>
								
								<!-- SecRuleRemoveByMsg -->
								<div class="tab-pane fade" id="dropdown2">
									<br>
										<fieldset>
											<legend>SecRuleRemoveByMsg</legend>
                                            <h5>Removes the matching rules from the current configuration context (Rule Message).</h5>
                                            <br/>
											<div class="form-group">
												<label for="select" class="col-lg-2 control-label">MESSAGE</label>
												<div class="col-lg-8">
													<select class="form-control" id="SecRuleRemoveByMsg_pilih" name="msg">
														<?php
															
															  foreach ($ruleslist_c2 as $ra ) {
															    	
															   	$id = $ra->id;
																$msg= $ra->msg;
																$codes = $ra->codes;
																
																$id = htmlspecialchars($ra->id,ENT_QUOTES);
																$msg = htmlspecialchars($ra->msg,ENT_QUOTES);
																$codes = htmlspecialchars($ra->codes,ENT_QUOTES);
															 
															?>
															<option value="<?php echo "$msg";?>"><?php echo "$msg";?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-lg-10 col-lg-offset-10">
													<button type="submit" id="SecRuleRemoveByMsg" class="btn btn-primary" name="add_btn1"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
												</div>
											</div>
										</fieldset>
										<script>
										$("#SecRuleRemoveByMsg").click(function(){
											
											$.post('myrules/pro_secruleremovebymsg',{id:$("#SecRuleRemoveByMsg_pilih").val()},function(data){
												alert(data);
											});
											
										});
									</script>
								</div>
								
								<!-- SecRuleRemoveByTag -->
								<div class="tab-pane fade" id="dropdown3">
									<br>
										<fieldset>
											<legend>SecRuleRemoveByTag</legend>
                                            <h5>Removes the matching rules from the current configuration context (Rule Tag).</h5>
                                            <br/>
											<div class="form-group">
												<label for="select" class="col-lg-2 control-label">TAG</label>
												<div class="col-lg-8">
													<select class="form-control" id="SecRuleRemoveByTag_pilih" name="tag">
														<?php
															
															 foreach ($ruleslist_c3 as $ra ) {
															    	
															    $id = $ra->id;
																$tag = $ra->tag;
																$codes = $ra->codes;
																
																$id = htmlspecialchars($ra->id,ENT_QUOTES);
																$tag = htmlspecialchars($ra->tag,ENT_QUOTES);
																$codes = htmlspecialchars($ra->codes,ENT_QUOTES);
															 
															?>
															<option value="<?php echo "$id";?>"><?php echo "$tag";?></option>
															<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<div class="col-lg-10 col-lg-offset-10">
													<button  class="btn btn-primary" id="SecRuleRemoveByTag" name="add_btn2"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
												</div>
											</div>
										</fieldset>
										
										<script>
										$("#SecRuleRemoveByTag").click(function(){
											
											$.post('myrules/pro_secruleremovebytag',{id:$("#SecRuleRemoveByTag_pilih").val()},function(data){
												alert(data);
											});
											
										});
									</script>
								</div>
								
							</fieldset>
						</div>
				
                
		
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<!-- <script src="js/bootstrap.min.js"></script> -->
			<!-- For On/Off Button-->
			<!-- <script src="jquery.js"></script> -->
			<script src="/asset/crules/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
			<!-- DataTables JavaScript -->
			<script src="/asset/crules/datatables/media/js/jquery.dataTables.min.js"></script>
			<script src="/asset/crules/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
			<script>
				$("[name='my-checkbox1[]']").bootstrapSwitch();
				$("[name='my-checkbox2[]']").bootstrapSwitch();
				$("[name='my-checkbox3[]']").bootstrapSwitch();
				
				$('#dataTables-example').DataTable({
					responsive: true
				});
				
			</script>




<script>
$(document).ready(function() {
    clearTimeout(lari);
    clearTimeout(livelog);		
});
</script>