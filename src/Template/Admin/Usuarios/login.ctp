<div class="card card-primary">
    <div class="card-header"><h4>Ingreso</h4></div>

    <div class="card-body">

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
                <div class="d-block">
                    <label for="password" class="control-label">Contraseña</label>
                    <div class="float-right">
                        <a href="<?=$this->Url->build(['action' => 'olvido_password'])?>" class="text-small"> ¿Olvidó su contraseña?</a>
                    </div>
                </div>
                <?= $this->Form->control('password', 
                    [
                        'class' => 'form-control', 
                        'label' => false,
                        'required' => true,
                        'tabindex' => '2'
                    ]) ?>
                <div class="invalid-feedback">
                    Por favor complete su contraseña
                </div>
            </div>


            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Recuérdame</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Iniciar Sesión
                </button>
            </div>
           
            
        <?= $this->Form->end() ?>

    </div>
</div>


<div class="mt-5 text-muted text-center">
    ¿No tienes una cuenta? <a href="<?=$this->Url->build(['action' => 'registro'])?>">Registrarme</a>
</div>