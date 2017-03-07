<div class="container starter-template">
<br><br>
<h4>Esqueceu a senha?<br><small>Informe-nos seu e-mail para que possamos ajudar</small></h4>
<div class="col-sm-4 col-md-offset-4">	
<?php
echo form_open(base_url('index.php/users/recovery_password'), 'method="post" class="form-inline"');
//criar uma row? (para colocar input e subnit na mesma linha) //
echo "<br>";
echo form_input('email', 'Email', 'class="form-control"');
echo form_submit('submit', 'Enviar', 'class="btn btn-primary pull-right"');
// ------- //
echo '<br><br><br>';
?>
</div>
<br><br>
</div>