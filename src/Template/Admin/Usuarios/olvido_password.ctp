<div class="card card-primary">
    <div class="card-header"><h4>Olvide la contraseña</h4></div>

    <div class="card-body">
        <p class="text-muted">Le enviaremos un enlace para restablecer su contraseña</p>
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
                <div class="invalid-feedback">
                    Por favor complete su correo electrónico
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Enviar
                </button>
            </div>
           
            
        <?= $this->Form->end() ?>

    </div>
</div>