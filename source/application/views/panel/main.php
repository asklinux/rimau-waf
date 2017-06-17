


		<div class="main-container" id="main-container">
			

			<div id="sidebar" class="sidebar responsive">
				

	

				<ul class="nav nav-list " id="menu">
                                        <li>
                                            
					<img src="/asset/image/rimauwaf.jpg" width="190" />
                                        </li>
					<li class="">
						<a href="/index.php/panel/utama">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

					</li>

					<li class="" id="pakage">
						<a href="/index.php/panel/config">
							<i class="menu-icon fa fa-gear"></i>
							<span class="menu-text"> Configure </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="/index.php/panel/web_server">
							<i class="menu-icon fa fa-eye"></i>
							<span class="menu-text"> Web Server </span>
						</a>

					</li>
                           
					<li class="">
						<a href="/index.php/panel/rules">
							<i class="menu-icon fa fa-bars"></i>
							<span class="menu-text" name="Base_Rules" >Base Rules </span>
						</a>

						<b class="arrow"></b>
					</li>

<!--
					<li class="">
						<a href="/index.php/panel/crules">
							<i class="menu-icon fa fa-shield"></i>
							<span class="menu-text">Custom Rules </span>
						</a>

						<b class="arrow"></b>
					</li> 
-->
                                        <li class="">
						<a href="/index.php/panel/disablerules">
							<i class="menu-icon fa fa-filter"></i>
							<span class="menu-text">Disable Rules</span>
						</a>

						<b class="arrow"></b>
					</li>
                                        
                
                                        <li class="">
						<a href="/index.php/panel/ownrules">
							<i class="menu-icon fa fa-pencil"></i>
							<span class="menu-text">Own Rules</span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="/index.php/panel/white">
							<i class="menu-icon fa fa-eraser"></i>
							<span class="menu-text"> White Rules </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="/index.php/panel/black">
							<i class="menu-icon fa fa-ban"></i>
							<span class="menu-text"> Black Rules </span>
						</a>

						<b class="arrow"></b>
					</li>

					<!--
					<li class="">
					
						<a href="/index.php/panel/exclude">
							<i class="menu-icon fa fa-arrows-h"></i>
							<span class="menu-text"> Exclude List </span>
						</a>

						<b class="arrow"></b>

					</li>
					-->

					</li-->
					<li class="">
						<a href="/index.php/panel/mlog">
							<i class="menu-icon fa fa-exchange"></i>
							<span class="menu-text"> log </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="/index.php/panel/about">
							<i class="menu-icon fa fa-info"></i>
							<span class="menu-text"> About </span>
						</a>

						<b class="arrow"></b>
					</li>
				</ul><!-- /.nav-list -->

				<br />
				<center><button id="restart" ><i class="ace-icon fa fa-power-off"></i>
Check</button>
<button id="reload" ><i class="ace-icon fa fa-refresh"></i>
Restart</button></center>
				
				<div id="msg"></div>

			
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active" id="dimana">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						
					</div>

					<div class="page-content">
						

						<div id="paparx" ></div>

		
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
<script src="/asset/assets/js/jquery.2.1.1.min.js"></script>

<script>
	$(document).ready(function() {

				var page_url = '/index.php/panel/utama';
				$('#paparx').text('Looding  ...').show();
				$('#paparx').load(page_url).show();
	
	});	
	
	$('#menu li a').on('click', function(e){
        		
	        	
	        		e.preventDefault();
	        		var nama = $(this).text();
			       	var page_url=$(this).prop('href');
			        $('#paparx').text('Loading  ...').show();
			        $('#dimana').text(nama).show();
			        
			        $('#paparx').load(page_url).show();
			
	});
	
	$('#reload').click(function (){
			
		var url = 'panel/reload'
		$.post(url,{'<?=$this->security->get_csrf_token_name()?>':'<?=$this->security->get_csrf_hash()?>'},function(data){
				
				
					$('#paparx').html('<div class="alert alert-info" role="alert" aligh="center"> Reload Server'+data+'</div>').fadeOut(1000).next().delay(1000).fadeIn();
				
				
		});
	});
	$('#restart').click(function (){
			
		var url = 'panel/check'
		$.post(url,{'<?=$this->security->get_csrf_token_name()?>':'<?=$this->security->get_csrf_hash()?>'},function(data){
				
				
			$('#paparx').html('<div class="alert alert-warning" role="alert">'+data+'</div>').fadeIn();
				
		});
	});
				
	$("#cpass").click(function(){
		
			       	var page_url='panel/changepass';
			        $('#paparx').text('Loading  ...').show();
			        $('#dimana').text("Change Password").show();			        
			        $('#paparx').load(page_url).show();
	});
	
	$("#tools").click(function(){
		
			       	var page_url='panel/tools';
			        $('#paparx').text('Loading  ...').show();
			        $('#dimana').text("Change Password").show();			        
			        $('#paparx').load(page_url).show();
	});
</script>
<script>
$(document).ready(function() {
    clearTimeout(livelog);		
});
</script>


			