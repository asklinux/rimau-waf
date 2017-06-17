<div class="col-sm-12" >

			<div class="row">
				<div class="col-xs-12 col-sm-4">
				</div>
										<div class="col-xs-12 col-sm-4">
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="widget-title">ADMINISTRATOR</h4>

													<img src="/asset/image/rimauwaf.jpg" width="400" />
												</div>

												<div class="widget-body">
													<div class="widget-main">
														<div>
															<label for="form-field-8">User ID</label>
															<input class="form-control input-mask-date" type="text" id="username" name="username" />
														</div>


														<div>
															<label for="form-field-9">Password</label>
															<input class="form-control input-mask-date" type="password" id="password" name="password" />

														</div>
														<div align="right" >
															<br />
															<button id="makelogin" >LOGIN</button>
														</div>

														<hr />

													</div>
												</div>
											</div>
										</div><!-- /.span -->

		</div>
					
		
</div>
<script src="/asset/assets/js/jquery.2.1.1.min.js"></script>
<script>
	$('#makelogin').click(function(){
		
		//alert('test');
		
		$.post('/index.php/welcome/checklogin',{user:$('#username').val(),pass:$('#password').val(),'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},function(data){
			
			if (data == 'ok'){
			
			url = "/panel";
      		$( location ).attr("href", url);
			
			}
			else {
				alert("The Username Or Password is Wrong !!!");
			}
		})
	})
</script>