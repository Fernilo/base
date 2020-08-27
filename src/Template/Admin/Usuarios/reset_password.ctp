<?php if(!$estado){ if($this->request->getSession()->check('usuario_id')) $estado = true; } ?>
<?php if (!empty($estado) AND ($estado)): ?>
<div class="card card-primary">
    <div class="card-header"><h4>Restablecer la contraseña</h4></div>

    <div class="card-body">
        <!-- <p class="text-muted">Le enviaremos un enlace para restablecer su contraseña</p> -->
        <?= $this->Form->create(null) ?>
        <div class="form-group">
                <?= $this->Form->control('email', 
                    [
                        'class' => 'form-control', 
                        'label' => 'E-mail',
                        'required' => true, 
                        'autofocus' => true,
                        'tabindex' => '1'
                    ]) ?>
            </div>

            <div class="form-group">
                <label for="nuevo-pass" class="control-label">Nueva Contraseña</label>
                <?= $this->Form->control('nuevo_pass', 
                    [
                        'class' => 'form-control pwstrength', 
                        'label' => false,
                        'required' => true,
                        'tabindex' => '2',
						'type'=>'password',
                        'data-indicator' => 'pwindicator'
                    ]) ?>
                <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div>
            </div>


            <div class="form-group">
                <label for="repetir-pass" class="control-label">Confirmar Contraseña</label>
                <?= $this->Form->control('repetir_pass', 
                    [
                        'class' => 'form-control', 
                        'label' => false,
                        'required' => true,
						'type'=>'password',
                        'tabindex' => '2'
                    ]) ?>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Enviar
                </button>
            </div>
           
            
        <?= $this->Form->end() ?>

    </div>
</div>
<?php endif ?>


<script>
    document.getElementById('formChangePassword').onsubmit = function() { return passIguales(); };
    function passIguales() {
        var pass = document.getElementById('nuevo-pass').value;
        var repass = document.getElementById('repetir-pass').value;
        if(pass.trim() != repass.trim()){
            alert("Las contraseñas no coinciden");
            return false;
        }
        return true;
    }
</script>