<div class="container">
<?php
echo '<br><h4 style="text-align:center">Formulário de submissão de artigo</h4>';
echo '<br><h5 style="text-align:center">Olá, ' . $this->session->first_name . '! Preencha o formulário com as informações do artigo que deseja compartilhar conosco.</h5><br><br>';
echo $msg;

echo form_open(site_url('submissions/submit'), 'method = "post", role="form"');

echo form_input('title', ($reset) ? '' : set_value('title'), 'placeholder = "Título", class = "form-control", maxlength="255"');
echo form_error('title') . '<br>';

echo form_input('publication_year', ($reset) ? '' : set_value('publication_year'), 'placeholder = "Ano de publicação", class = "form-control"');
echo form_error('publication_year') . '<br>';

echo form_input('doi', ($reset) ? '' : set_value('doi'), 'placeholder = "Localizador (DOI)", class = "form-control"');
echo form_error('doi') . '<br>';

echo form_textarea('comment', ($reset) ? '' : set_value('comment'), 'placeholder = "Deixe aqui seus comentários/indicações sobre o artigo submetido. (Max 600 caracteres)", class = "form-control", maxlength="600"');
echo form_error('comment') . '<br>';

echo form_submit('submit', 'Submeter', 'class="btn btn-primary pull-left"');
echo '<p class="pull-right">Dúvidas sobre a submissão de artigos? Envie-nos um e-mail em imunodb@gmail.com</p>';
echo form_close();
?>

</div>
<?php echo '<br><br><br><br>'?>   