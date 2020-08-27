<?= $this->Html->css('bootstrap-social.min.css') ?>
<h2 class="section-title">Detalle de usuario</h2>
<p class="section-lead">
    Aquí puede ver información sobre un usuario página.
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

                <div class="card-body">
                    <?= $this->Form->create($usuario, ['class' => 'needs-validation', 'type' => 'file', 'novalidate' => '']) ?>
                    <div class="form-group">
                        <label>Nombre</label>
                        <?= $this->Form->control('nombre', ['class' => 'form-control', 'label' => false, 'disabled' => true]); ?>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <?= $this->Form->control('apellido', ['class' => 'form-control', 'label' => false, 'disabled' => true]); ?>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <?= $this->Form->control('email', ['class' => 'form-control', 'label' => false, 'disabled' => true]); ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
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
</div>