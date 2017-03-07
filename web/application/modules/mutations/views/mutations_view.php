<div class="container">
<br><br>
<h3>Faça sua busca <small> (em inglês)</small></h3>
<br><br>
<?php 
echo $form;
?>
  <div class="form-group">
    <label class="control-label col-sm-2" for="name">Gene:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="name" placeholder="Ex: CYBB" autofocus>
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-sm-2" for="type">Type of mutation:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="type" placeholder="Ex: Splicing">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="inheritance">Inheritance:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="inheritance" placeholder="Ex: XL">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="disease">Disease:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="disease" placeholder="Ex: Chronic granulomatous disease">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="origin">Country:</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="origin" placeholder="Ex: Brazil">
    </div>
  </div>
  <br><br>
  <div class="pull-center">
    <button type="reset" class="btn btn-default" value="true">Limpar</button>
    <button type="submit" class="btn btn-primary" target="_blank">Filtrar</button>
  </div>
  <br><br><br>
</form>
</div>