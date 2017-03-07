<div class="container starter-template">
<h4>Alterar senha</h4>
</div>
<div class="container">
<div class="col-sm-4 col-md-offset-4">
	<?php 
	echo $msg;
	echo form_open('', 'method="post"');
	$attInput = 'class="form-control"';
	$attLabel = 'class="control-label"';
	echo '<br>';
	echo form_label('Digite sua senha atual', 'password', $attLabel);
	echo form_password('password', ($reset) ? "" : set_value('password'), $attInput );
	echo form_error('password');
	echo '<br>';
	echo form_label('Nova senha', 'new_password');
	echo form_password('new_password', ($reset) ? "" : set_value('new_password'), $attInput);
	echo form_error('new_password');
	echo '<br>';
	echo form_label('Repita a nova senha', 'repeat_new_password');
	echo form_password('repeat_new_password', ($reset) ? "" : set_value('repeat_new_password'), $attInput);
	echo form_error('repeat_new_password');
	echo '<br>';
	echo form_submit('submit', 'Alterar', 'class="btn btn-primary pull-right"');
	echo '<br><br><br>';
	?>
</div>
</div>
