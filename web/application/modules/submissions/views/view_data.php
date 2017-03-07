<div class="container">
<div class="col-sm-8 col-md-offset-2">
<br><br><h4 style="text-align:center"> Meus dados</h4><br><br>
<div class="col-sm-6">
<?php

echo form_open(site_url('submissions/edit_data'), 'method="post"');

$att = array('class' => 'form-control');
echo form_label('Nome', 'first_name');
echo form_input('first_name', ($reset) ? $first_name : set_value('first_name'), $att);
echo form_error('first_name');
echo '<br>';
echo form_label('Sobrenome', 'last_name');
echo form_input('last_name', ($reset) ? $last_name : set_value('last_name'), $att);
echo form_error('last_name');
echo '<br>';
echo form_label('E-mail', 'email');
echo form_input('email', $email, 'class = "form-control" disabled = "disabled"');
echo '<br>';
echo form_label('Telefone', 'phone');
echo form_input('phone', ($reset) ? $phone : set_value('phone'), $att);
echo form_error('phone');
echo '<br>';
$profiles = array('Estudante (graduação)' => 'Estudante (graduação)', 'Estudante (pós-graduação)' => 'Estudante (pós-graduação)',
'Pesquisador(a)' => 'Pesquisador(a)', 'Professor(a)' => 'Professor(a)');
echo form_label('Perfil', 'profiles');
echo '<br>';
echo form_dropdown('profile', $profiles, $profile);
echo '<br>';
echo form_hidden('luser_id', $luser_id);
?>
</div>
<div class="col-sm-6">
<?php
echo form_label('Área de estudo', 'field_study');
echo form_input('field_study', ($reset) ?  $field_study : set_value('field_study'), $att);
echo form_error('field_study');
echo '<br>';
echo form_label('Instituição', 'institution');
echo form_input('institution', ($reset) ? $institution : set_value('institution'), $att);
echo form_error('institution');
echo '<br>';
echo form_label('Cidade', 'city');
echo form_input('city', ($reset) ? $city : set_value('city'), $att);
echo form_error('city');
echo '<br>';
$countries = array('Argentina' => 'Argentina', 'Belize' => 'Belize', 'Bolívia' => 'Bolívia', 'Brasil' => 'Brasil', 'Chile' => 'Chile',
'Colômbia' => 'Colômbia', 'Costa Rica' => 'Costa Rica', 'Cuba' => 'Cuba', 'El Salvador' => 'El Salvador', 'Equador' => 'Equador',
'Guadalupe' => 'Guadalupe', 'Guatemala' => 'Guatemala', 'Guiana Francesa' => 'Guiana Francesa', 'Haiti' => 'Haiti', 'Honduras' => 'Honduras',
'México' => 'México', 'Nicarágua' => 'Nicarágua', 'Panamá' => 'Panamá', 'Paraguai' => 'Paraguai', 'Peru' => 'Peru', 
'República Dominicana' => 'República Dominicana', 'Uruguai' => 'Uruguai', 'Venezuela' => 'Venezuela');
echo form_label('País', 'country');
echo '<br>';
echo form_dropdown('country', $countries, $country);
echo '<br>';
echo form_hidden('contrib_id', $contrib_id);
echo form_submit('submit', 'Atualizar', 'class="btn btn-primary pull-right"');
?>

</div>
<?php echo form_close(); ?> 
</div>
</div>
<div class="container"> <?php echo '<br><br>' . $msg; ?> </div>
<br><br>