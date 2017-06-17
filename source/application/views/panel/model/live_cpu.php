

										

<div class="col-sm-10">
<div class="col-sm-12">										
<div class="col-sm-4">
	
  <div class="GaugeMeter" id="nice" data-percent="<?=$cpu["cpu0"]["nice"]?>" data-prepend="<font style='color:blue;font-size:35px;margin-left:-15px'>&ndash;</font>" data-size="200" data-theme="blue" data-back="RGBa(0,0,255,.1)" data-animate_gauge_colors="1" data-animate_text_colors="1" data-width="2" data-label="sys" data-label_color="#000"></div>
</div>
<div class="col-sm-4">
 <div class="GaugeMeter" id="cpu" data-percent="<?=$cpu["cpu0"]["user"]?>" data-append="%" data-size="200" data-theme="red" data-back="RGBa(0,0,225,.1)" data-animate_gauge_colors="1" data-animate_text_colors="1" data-width="15" data-label="CPU Usage" data-style="Arch" data-label_color="#000"></div>
</div>
<div class="col-sm-4">
<div class="GaugeMeter" id="sys" data-percent="	<?=$cpu["cpu0"]["sys"]?>" data-append="%" data-size="200" data-theme="blue" data-back="RGBa(0,0,255,.1)" data-animate_gauge_colors="1" data-animate_text_colors="1" data-width="15" data-label="nice" data-label_color="#000" data-stripe="2"></div>
</div>
</div>
<div class="col-sm-12" align="center">	
										
								
								
										

<div class="infobox infobox-green infobox-small infobox-dark">
	<div class="infobox-progress">
		<div class="easy-pie-chart percentage" data-percent="<?php echo $cpu["cpu0"]["idle"]?>" data-size="39">
			<span class="percent"><?php echo $cpu["cpu0"]["idle"]?></span>%
						</div>
						</div>
								<div class="infobox-data">
										<div class="infobox-content">Idle</div>
										<div class="infobox-content">CPU</div>
								</div>
						</div>

	</div>
</div>
<div class="col-sm-2">

									
									<div class="col-sm-12" align="center">

<?php 
if ($cpu_avg[0] >= '0.7') { 
    
    $lbl_avg = 'danger blink_me';
}
else{
    $lbl_avg = 'default';
}
?>										
<h4>Load average:</h4> <br />
<span class="label label-<?=$lbl_avg?>">
    1 minute (<?=$cpu_avg[0]?>)
</span>
<?php 
if ($cpu_avg[1] >= '0.7') { 
    
    $lbl_avg5 = 'danger blink_me';
}
else{
    $lbl_avg5 = 'primary';
}
?>
<span class="label label-<?=$lbl_avg5?>">5 minute (<?=$cpu_avg[1]?>)</span>
<?php 
if ($cpu_avg[2] >= '0.7') { 
    
    $lbl_avg15 = 'danger blink_me';
}
else{
    $lbl_avg15 = 'success';
}
?>
<span class="label label-<?=$lbl_avg15?>">15 minite (<?=$cpu_avg[2]?>)</span>



						
							<?php 
							
							switch ($statusx) {
								case 'cbb2ab9c3f39443865a5ccd063413ccd':
									 $papar = '<img src="/asset/image/onwaf.jpg" />';
									break;
								case '218ae5144a248d152ba5d64e9a80eb9e':
									 $papar = '<img src="/asset/image/logwaf.jpg" />';
									break;
								default:
									
									$papar = '<img src="/asset/image/offwaf.jpg" />';
									break;
							}
							
							?>
							<h4>Mod Security Status:</h4> <br />
							<?=$papar?>
								

									</div><!-- /.col -->
</div>




									
<script src="/asset/assets/js/jquery.2.1.1.min.js"></script>
<script src="/asset/assets/js/jquery.AshAlom.gaugeMeter-2.0.0.min.js"></script> 
<script>
$(".GaugeMeter").gaugeMeter();
</script>

