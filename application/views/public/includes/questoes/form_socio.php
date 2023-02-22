<div class="panel panel-danger" id="panel_email">
    <div class="panel-heading">
        <?php echo form_label(' ', 'nome', array('class' => 'col-sm-2 control-label')); ?>  
        <div class="form-group">
            <div class="col-sm-6">Nome Completo
                <?php echo form_input($nome); ?>
            </div>
             <div class="col-sm-2">Data de Nascimento
                <?php echo form_input($datanasc); ?>
            </div>
        </div>
        <?php echo form_label(' ', 'nome', array('class' => 'col-sm-2 control-label')); ?>  
        <div class="form-group">
            <div class="col-sm-6">Email
                <?php echo form_input($email); ?>
            </div>
            <div class="col-sm-2">CPF
                <?php echo form_input($cpf); ?>
            </div>
        </div>
        
        <?php echo form_label(' ', 'nome', array('class' => 'col-sm-2 control-label')); ?>  
        <div class="form-group">
            <div class="col-sm-6">Endereço
                <?php echo form_input($endereco); ?>
            </div>
            <div class="col-sm-2">Telefone
                <?php echo form_input($telefone); ?>
            </div>

        </div>

    </div>
</div>