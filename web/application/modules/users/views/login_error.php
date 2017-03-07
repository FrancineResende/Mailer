<?php echo $space ?>
<div class="container">
<div class="col-sm-8 col-md-offset-2">
<!-- <div class="row"> -->
<div class="col-sm-5">
<form class="form" action="<?= base_url('index.php/users/redirect') ?>" method="post">
    <div class="form-group">
        <?php echo $error ?>
        <div class="input-group">
            <input type="text" name="email" placeholder="E-mail" value="<?php echo $this->input->post('email')?>" class="form-control">
            <div class="input-group-addon"><i class="fa fa-envelope-o"></i></div>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <input type="password" name="password" placeholder="Senha" class="form-control">
            <div class="input-group-addon"><i class="fa fa-unlock"></i></div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary " name='login' value='TRUE'> Entrar </button>
    
</form>
</div>
<div class="col-sm-5 pull-right">
<?php echo $msg ?>
</div>
<!-- </div> -->
</div> 
</div>
<?php echo $space ?>