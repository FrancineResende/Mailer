<div class="container">
<br><h3 style="text-align:center">Cadastre-se e seja um de nossos colaboradores!</h3>
<br>
<p class="alert alert-info">O cadastro somente é necessário para pessoas que desejam colaborar com o ImunoDB 
através do compartilhamento de material científico. Se você deseja apenas obter informações do ImunoDB em seu 
email, basta deixar alguns dados aqui: *link*</p>
<?php
$attributes = array('role' => "form", 'method' => "post");

echo form_open('users/register', $attributes);
echo $msg; //somente tem conteúdo para avisar o usuário do que aconteceu;
?>
<div class="row">
<div class="col-sm-6">
<div class="form-group">
<?php
$lab = array('class' => 'control-label');
$input = array('class' => 'form-control');

echo form_label('<span style="color:red">*</span> Nome', 'first_name', $lab);
echo form_input('first_name', ($reset) ? "" : set_value('first_name'), $input);
echo form_error('first_name');
?>
</div>

<div class="form-group">
<?php
echo form_label('<span style="color:red">*</span> Sobrenome', 'last_name');
echo form_input('last_name', ($reset) ? "" : set_value('last_name'), $input);
echo form_error('last_name');
?>
</div>

<div class="form-group">
<?php
echo form_label('<span style="color:red">*</span> E-mail', 'email');
echo form_input('email', ($reset) ? "" : set_value('email'), $input);
echo form_error('email');
?>
</div>

<div class="form-group">
<?php
echo form_label('Telefone <small style="color:gray">(Número completo com espaços, incluindo código do país)<br>Exemplo: 55 41 999999999</small>', 'phone');
echo form_input('phone', ($reset) ? "" : set_value('phone'), $input);
echo form_error('phone');
?>
</div>

<div class="form-group">
<?php
echo form_label('<span style="color:red">*</span> Cidade', 'city');
echo form_input('city', ($reset) ? "" : set_value('city'), $input);
echo form_error('city');
?>
</div>

<div class="form-group">
<?php
$countries = array('Argentina' => 'Argentina', 'Belize' => 'Belize', 'Bolívia' => 'Bolívia', 'Brasil' => 'Brasil', 'Chile' => 'Chile',
'Colômbia' => 'Colômbia', 'Costa Rica' => 'Costa Rica', 'Cuba' => 'Cuba', 'El Salvador' => 'El Salvador', 'Equador' => 'Equador',
'Guadalupe' => 'Guadalupe', 'Guatemala' => 'Guatemala', 'Guiana Francesa' => 'Guiana Francesa', 'Haiti' => 'Haiti', 'Honduras' => 'Honduras',
'México' => 'México', 'Nicarágua' => 'Nicarágua', 'Panamá' => 'Panamá', 'Paraguai' => 'Paraguai', 'Peru' => 'Peru', 
'República Dominicana' => 'República Dominicana', 'Uruguai' => 'Uruguai', 'Venezuela' => 'Venezuela');
echo form_label('<span style="color:red">*</span> País', 'country');
echo '<br>';
echo form_dropdown('country', $countries, 'Brasil');
// echo form_input('country', ($reset) ? "" : set_value('country'), $input);
// echo form_error('country');
?>
</div>
</div> <!-- /col -->

<div class="col-sm-6">
<div class="form-group">
<?php
$profiles = array('Estudante (graduação)' => 'Estudante (graduação)', 'Estudante (pós-graduação)' => 'Estudante (pós-graduação)',
'Pesquisador(a)' => 'Pesquisador(a)', 'Professor(a)' => 'Professor(a)');
echo form_label('<span style="color:red">*</span> Perfil', 'profiles');
echo '<br>';
echo form_dropdown('profile', $profiles, 'Pesquisador(a)');
// echo form_input('country', ($reset) ? "" : set_value('country'), $input);
// echo form_error('country');
?>
</div>

<div class="form-group">
<?php
echo form_label('<span style="color:red">*</span> Área de estudo', 'field_study');
echo form_input('field_study', ($reset) ? "" : set_value('field_study'), $input);
echo form_error('field_study');
?>
</div>

<div class="form-group">
<?php
echo form_label('<span style="color:red">*</span> Instituição', 'institution');
echo form_input('institution', ($reset) ? "" : set_value('institution'), $input);
echo form_error('institution');
?>
</div>

<div class="form-group">
<?php
echo form_label('<span style="color:red">*</span> Senha', 'password');
echo form_password('password', ($reset) ? "" : set_value('password'), $input);
echo form_error('password');
?>
</div>

<div class="form-group">
<?php
echo form_label('<span style="color:red">*</span> Repita a senha', 'repassword');
echo form_password('repassword', ($reset) ? "" : set_value('repassword'), $input);
echo form_error('repassword');
?>
</div>
<?php
echo form_checkbox('newsletter', 'accept', TRUE) . "Desejo receber mensagens periódicas por email *";
echo '<p class="text-warning">* Informamos que nosso serviço de e-mail está inoperante no momento. 
Por esse motivo, não poderemos fazer a confirmação do seu endereço de e-mail e você ainda não poderá 
se logar em nosso sistema, mesmo que tenha se cadastrado.<br>
Pedimos desculpas pelo transtorno. Solucionaremos esse problema o mais rápido possível.</p>';

echo '<br>' . form_submit('submit', 'Enviar', 'class="btn btn-primary" style="background-color:#337ab7;color:white;border-color:#2e6da4"');
echo form_reset('reset', 'Limpar', "class='btn btn-default'");
?>
<br><br>

</div>
</div> <!-- /row -->

</div>