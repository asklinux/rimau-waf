


<img src="/asset/image/ntop.png" />
<button onclick="startnt();">Start Ntopng</button> <button onclick="stopnt();"> Stop Ntopng</button>
<button onclick="statusnt();">Status</button> 
<button id="ntview" onclick="viewnt();" >View Ntop Panel</button>

<div id="ntstatus"></div>
<script>
	$(document).ready(function() {
	clearTimeout(lari);
    clearTimeout(livelog);		
	});
	function startnt(){
		
		$.post('panel/ntopng',{jenis:1},function(data){
			$("#ntstatus").html(data);
		});
	}
	function stopnt(){
		
		$.post('panel/ntopng',{jenis:0},function(data){
			$("#ntstatus").html(data);
		});
	}
	function statusnt(){
		
		$.post('panel/ntopng',{jenis:3},function(data){
			$("#ntstatus").html("<pre>"+data+"</pre>");
		});
	}
	function viewnt(){
		 //$('#paparx').load('http://10.21.187.128:3000').show();
		 var url = 'http://<?=$_SERVER['SERVER_ADDR']?>:3000';
		 window.open(url,'_blank');
	}
	
</script>