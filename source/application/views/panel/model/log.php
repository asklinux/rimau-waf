<pre id="plog">

</pre>

<script src="/asset/assets/js/jquery.2.1.1.min.js"></script>


<script>
	$(function() {
    startRefresh();
	});
	
	function startRefresh() {
	    livelog = setTimeout(startRefresh,1000);
	    $.get('panel/load_log',{'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'}, function(data) {
	        $('#plog').html(data);    
	    });
	}
</script>

<script>
$(document).ready(function() {
    clearTimeout(lari);
});
</script>