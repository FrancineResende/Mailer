<br><br>
<div class="container">
<p><a href="<?= base_url('index.php/admin/home')?>"> <span class="glyphicon glyphicon-arrow-left"></span> Painel Administrativo </a></p><br><br>

<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'method' => 'POST');
$lab 		= array('class' => "control-label");
$input 		= array('class' => 'form-control');

echo $msg;
echo form_open('index.php/admin/set_mutation', $attributes);
?>

<div class="row">
<div class="col-sm-4">
<?php
echo form_label('Gene name', 'gene_name', $lab);
echo form_input('gene_name', set_value('gene_name'), $input);
echo form_error('gene_name');

echo form_label('Type of mutation', 'type', $lab);
echo form_input('type', set_value('type'), $input);
echo form_error('type');

echo form_label('Inheritance', 'inheritance', $lab);
echo form_input('inheritance', set_value('inheritance'), $input);
echo form_error('inheritance');

echo form_label('Site', 'site', $lab);
echo form_input('site', set_value('site'), $input);
echo form_error('site');
?>
</div>

<div class="col-sm-4">
<?php
echo form_label('c_DNA', 'c_dna', $lab);
echo form_input('c_dna', set_value('c_dna'), $input);
echo form_error('c_dna');

echo form_label('Protein', 'protein', $lab);
echo form_input('protein', set_value('protein'), $input);
echo form_error('protein');

echo form_label('Disease', 'disease_name', $lab);
echo form_input('disease_name', set_value('disease_name'), $input);
echo form_error('disease_name');
?>
</div>

<div class="col-sm-4">
<?php
echo form_label('Country', 'country_name', $lab);
echo form_input('country_name', set_value('country_name'), $input);
echo form_error('country_name');

echo form_label('OMIM phenotype', 'omim_phenotype', $lab);
echo form_input('omim_phenotype', set_value('omim_phenotype'), $input);
echo form_error('omim_phenotype');

echo form_label("Article's DOI", 'doi', $lab);
echo form_input('doi', set_value('doi'), $input);
echo form_error('doi');

echo '<br>';

echo form_submit('submit', 'Submit', 'class="btn btn-primary pull-right"');
echo form_reset('reset', 'Reset', 'class="btn btn-default pull-right"');
?>
</div>
</div>

<?php
echo form_close();
?>
<br><br>
</div>