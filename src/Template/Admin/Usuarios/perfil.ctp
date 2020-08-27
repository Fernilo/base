<?= $this->Html->css('bootstrap-social.min.css') ?>
<h2 class="section-title">Mi cuenta</h2>
<p class="section-lead">
    Cambie la información sobre usted en esta página.
</p>

<div class="row mt-sm-4">
    <div class="col-12 col-md-12 col-lg-5">
        <div class="card profile-widget">
            <div class="profile-widget-header">
                <?= $this->Html->image('avatar/avatar-1.png', ['class' => 'rounded-circle profile-widget-picture']) ?>
                <div class="profile-widget-items">
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Posts</div>
                        <div class="profile-widget-item-value">187</div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Followers</div>
                        <div class="profile-widget-item-value">6,8K</div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Following</div>
                        <div class="profile-widget-item-value">2,1K</div>
                    </div>
                </div>
            </div>
            <div class="profile-widget-description">
                <div class="profile-widget-name"><?= $usuario->fullname ?> <div class="text-muted d-inline font-weight-normal">
                        <div class="slash"></div> <?= $roles[$usuario->rol] ?>
                    </div>
                </div>
                <b>Sobre Syloper:</b>
                <br>
                Somos un equipo de jóvenes profesionales, apasionados por el desarrollo y convencidos de que el éxito de nuestros clientes es el nuestro. 
                Desde 2010 apoyamos la innovación en todos los ámbitos, y brindamos soluciones que le agreguen valor al negocio de las personas que nos contratan.
            </div>
            <div class="card-footer text-center">
                <div class="font-weight-bold mb-2">Follow <a href="https://www.syloper.com/" target="_blank">Syloper</a></div>
                <a href="https://es-la.facebook.com/syloper/" class="btn btn-social-icon btn-facebook mr-1" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/Syloper" class="btn btn-social-icon btn-twitter mr-1" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://github.com/Syloper" class="btn btn-social-icon btn-github mr-1" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
                <a href="https://www.instagram.com/syloper/" class="btn btn-social-icon btn-instagram" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
            <?= $this->Form->create($usuario, []) ?>
                <div class="card-header">
                    <h4>Editar Perfil</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label>Nombre </label>
                            <?= $this->Form->control('nombre', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
                            <div class="invalid-feedback">
                                Por favor complete el nombre
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Apellido </label>
                            <?= $this->Form->control('apellido', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
                            <div class="invalid-feedback">
                                Por favor complete el apellido
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12 col-12">
                            <label>E-mail</label>
                            <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
                            <div class="invalid-feedback">
                                Por favor complete el email
                            </div>
                        </div>
                    </div>

                    <hr>

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
                </div>
                <div class="card-footer text-right">
                    <?= $this->Form->button(__('Guardar Cambios'), ["class" => "btn btn-primary"]) ?>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
