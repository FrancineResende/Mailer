<div class="container starter-template">
	<h3>Registro para administração</h3><br>
<div class="col-md-4 col-xs-offset-4">	
<?php
$class = 'class="form-control"';
echo form_open('index.php/admin/save_admin', 'method = "post"');

echo '<div class="form-group">';
echo form_label('Nome', 'first_name', 'class="control-label col-sm-4"');
echo '<div class="col-sm-8 pull-right">';
echo form_input('first_name', '', $class);
echo '</div></div>';

echo '<div class="form-group">';
echo form_label('Sobrenome', 'last_name', 'class="control-label col-sm-4"');
echo '<div class="col-sm-8 pull-right">';
echo form_input('last_name', '', $class);
echo '</div></div>';

echo '<div class="form-group">';
echo form_label('E-mail', 'email', 'class="control-label col-sm-4"');
echo '<div class="col-sm-8 pull-right">';
echo form_input('email', '', $class);
echo '</div></div>';

echo '<div class="form-group">';
echo form_label('Senha', 'password', 'class="control-label col-sm-4"');
echo '<div class="col-sm-8 pull-right">';
echo form_password('password', '', $class);
echo '</div></div>';

echo '<br>';

echo form_submit('submit', 'Enviar', 'class="btn btn-default"');
?>
</div>
</div>

 <!-- <div class="form-group">
    <label class="control-label col-sm-2" for="name">Gene:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="name" placeholder="Ex: CYBB" autofocus>
    </div>
</div> -->