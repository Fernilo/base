<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class=""> Editar Usuario</h4>
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
                <label for="email" class="control-label">Email</label>
                <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
            </div>
			
			<div class="form-group">
                        <label for="actual_pass" class="col-sm-2 control-label">Clave anterior</label>
                        <?= $this->Form->control('actual_pass', ['class' => 'form-control', 'type' => 'password', 'label' => false]); ?>
            </div>

            <div class="form-group">
                        <label for="nuevo_pass" class="col-sm-2 control-label">Nueva clave</label>
                        <?= $this->Form->control('nuevo_pass', ['class' => 'form-control pwstrength', 'type' => 'password', 'label' => false, 'data-indicator' => 'pwindicator', 'style' => 'width:100%']); ?>
           </div>
           <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
          </div>

          <div class="form-group">
                        <label for="repetir_pass" class="col-sm-2 control-label">Repetir clave</label>
                        <?= $this->Form->control('repetir_pass', ['class' => 'form-control', 'type' => 'password', 'label' => false]); ?>
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
            <?= $this->Form->button(__('Guardar'), ["class" => "btn btn-success float-right"]) ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>