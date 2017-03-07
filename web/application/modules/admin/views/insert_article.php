<br><br>
<div class="container">
<p><a href="<?= base_url('index.php/admin/home')?>"> <span class="glyphicon glyphicon-arrow-left"></span> Painel Administrativo </a></p><br>
<?php
echo $msg;
$attributes = array('class' => 'form-horizontal', 'id' => 'myform', 'method' => 'POST');
echo form_open('index.php/admin/set_article', $attributes);
?>

<div class="row">
<div class="form-group col-sm-6"><?php
$lab = array('class' => "control-label");
echo form_label('Title', 'title', $lab);
$input = array('class' => 'form-control');
echo form_input('title', set_value('title'), $input);
echo form_error('title');
?></div>

<div class="form-group col-sm-6 pull-right"><?php
echo form_label('Authors', 'authors', $lab);
echo form_input('authors', set_value('authors'), $input);
echo form_error('authors');
?></div>
</div>

<div class="row">
<div class="form-group col-sm-6"><?php
echo form_label('Year of publication', 'publication_year', $lab);
echo form_input('publication_year', set_value('publication_year'), $input);
echo form_error('publication_year');
?></div>

<div class="form-group col-sm-6 pull-right"><?php
echo form_label('Doi', 'doi', $lab);
echo form_input('doi', set_value('doi'), $input);
echo form_error('doi');
?></div>
</div>

<div class="row">
<div class="form-group col-sm-6"><?php
echo form_submit('submit', 'Submit', 'class="btn btn-primary"');
echo form_reset('reset', 'Reset', 'class="btn btn-default"');
?></div>
</div>


<?php
echo form_close();
?>
<br><br>
</div>