<div class="container">
    <div class="starter-template">
        <h3>Aqui você encontra todos os artigos que foram utilizados para construir a nossa base de dados.</h3>
    </div>
</div>
<div class ="container table-responsive">
    <table class="table table-hover table-condensed">
    <thead>
    <tr>
      	<th>#</th>
        <th>Título</th>
        <th>Autoria</th>
        <th>Ano de Publicação</th>
    </tr>
    </thead>

    <?php
    $i=1;
    
    foreach ($query as $row){
    ?>
    <tr>
       	<td><?php  echo $i++; ?></td>
        <td><?php  echo $row->title; ?></td>
        <td><?php  echo $row->authors; ?></td>
        <td><?php  echo $row->publication_year; ?></td>
    </tr>
    <?php } ?>

    </table>
    <hr><br><br><br>
</div>
