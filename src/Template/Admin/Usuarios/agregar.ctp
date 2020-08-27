<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <!-- <h4 class="card-title"> Nuevo Usuario</h4> -->
            <h4 class=""> Nuevo Usuario</h4>
        </div>
        <div class="card-body">

            <?= $this->Form->create($usuario, ['class' => 'form-horizontal', 'type' => 'file' ]) ?>
            <div class="form-group">
                <label for="nombre" class="control-label">Nombre</label>
                <?= $this->Form->control('nombre', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
            </div>
            
            <div class="form-group">
                <label for="apellido" class="control-label">Apellido</label>
                <?= $this->Form->control('apellido', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
            </div>

            <div class="form-group">
                <label for="contenido" class="control-label">Contenido</label>
                <?= $this->Form->textarea('contenido', ['class' => 'form-control summernote', 'label' => false, 'rows' => 8, 'cols' => 8]); ?>
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
                <label for="rol" class="control-label">Rol</label>
                <?= $this->Form->control('rol', [
                    'class' => 'form-control', 
                    'label' => false, 
                    'required' => true, 
                    'options' => $roles, 
                    'empty' => false
                ]); ?>
            </div>

        </div>

        <div class="card-footer">
            <?= $this->Form->button(__('Agregar'), ["class" => "btn btn-primary float-right"]) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>