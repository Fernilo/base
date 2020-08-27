<!-- Sidebar outter -->
<div class="main-sidebar">
    <!-- sidebar wrapper -->
    <aside id="sidebar-wrapper">
        <!-- sidebar brand -->
        <div class="sidebar-brand">
            <a href="<?= $this->Url->build('/admin/') ?>"><?= APP_NAME ?></a>
        </div>
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <!-- menu header -->
            <li class="menu-header">Menu</li>

            <!-- menu item -->
            <li class="pages">
                <a href="<?= $this->Url->build('/admin/') ?>"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <!-- <li class="usuarios">
                <a href="<?php //= $this->Url->build(['controller' => 'Usuarios', 'action' => 'index']) ?>" class="nav-link nav-link-lg">
                    <i class="fas fa-user"></i>Usuarios
                </a>
            </li> -->

            <li class="dropdown usuarios">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i> <span>Usuarios</span></a>
                <ul class="dropdown-menu">
                    <li class="index"><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Usuarios', 'action' => 'index']) ?>">Listado</a></li>
                    <li class="agregar"><a class="nav-link" href="<?= $this->Url->build(['controller' => 'Usuarios', 'action' => 'agregar']) ?>">Nuevo</a></li>
                </ul>
            </li>
        </ul>
    </aside>
</div>


<script>
    var AdminOpciones = {
        controlador: "<?= strtolower($this->request->getParam('controller'))?>",
        accion: "<?= strtolower($this->request->getParam('action'))?>",
    };

</script>