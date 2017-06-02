<div class="form-group">
	<input type="hidden" id="id2" value="<?=$server[0]['id']?>" />
    <label for="exampleInputEmail1">Domain</label>
    <input type="domain" class="form-control" id="domain" value="<?=$server[0]['hosts']?>" >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Port</label>
    <input type="number" class="form-control" id="port2" value="<?=$server[0]['port']?>">
  </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Url</label>
    <input type="text" class="form-control" id="url2" value="<?=$server[0]['description']?>" >
  </div>
  <!--

    <div class="form-group">
    <label for="exampleInputPassword1">SSLCertificateFile </label>
    <input type="text" class="form-control" id="ssl2" value="<?=$server[0]['SSLCertificateFile']?>" >
  </div>
  -->

<?php
	if ($server[0]['SSLEngine'] == 'on'){
		$paparsslon = 'selected="selected"';
		$paparssloff = '';
	}
	else{
		$paparsslon = '';
		$paparssloff = 'selected="selected"';
	}

?>
<!--

<div class="form-group">
    <label for="sslengin">SSLCertificateFile : </label>
    <select id="sslengin2">
  		<option value="on" <?=$paparsslon?> >ON</option>
  		<option value="off" <?=$paparssloff?> >OFF</option> 
	</select>
  </div>
 -->
