<div class="container starter-template">
<h3>Login administrativo</h3>

<div class="col-sm-4 col-md-offset-4">
<?php

echo form_open('index.php/admin/login', 'method="post"');
echo '<div class="input-group-lg">';
echo form_input('email', set_value('email'), 'placeholder="E-mail" class="form-control"');
echo form_error('email');
echo '<br>';
echo form_password('password', set_value('password'), 'placeholder="Senha" class="form-control"');
echo form_error('password');
echo '</div><br>';
echo form_submit('submit', 'Entrar', 'class="btn btn-lg btn-default"');
echo form_close();

?>
</div>
</div>