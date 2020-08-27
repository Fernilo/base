<div class="card card-primary">
    <div class="card-header">
        <h4>Registro</h4>
    </div>

    <div class="card-body">
        <?= $this->Form->create($usuario, ['class' => 'form-horizontal']) ?>
            <div class="form-group">
                <label for="nombre" class="control-label">Nombre</label>
                <?= $this->Form->control('nombre', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
            </div>
            
            <div class="form-group">
                <label for="apellido" class="control-label">Apellido</label>
                <?= $this->Form->control('apellido', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
            </div>
            
            <div class="form-group">
                <label for="email" class="control-label">Email</label>
                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
            </div>

            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    <?= $this->Form->password('password', ['class' => 'form-control pwstrength', 'label' => false, 'required' => true,
                        'data-indicator' => 'pwindicator', 'style' => 'width:100%']); ?>
                </div>
                <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                    <label class="custom-control-label" for="agree">Acepto los términos y condiciones</label>
                </div>
            </div>

            <div class="form-group">
                <?= $this->Form->button(__('Registrarme'), ["class" => "btn btn-primary btn-lg btn-block"]) ?>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>
