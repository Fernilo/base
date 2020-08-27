<!-- navbar background color -->
<div class="navbar-bg"></div>
<!-- navbar -->
<nav class="navbar navbar-expand-lg main-navbar">
    <!-- navbar nav left -->
    <form class="form-inline mr-auto">
        <!-- navbar toggler -->
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <!-- navbar search -->
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- navbar right -->
    <ul class="navbar-nav navbar-right">
        <!-- navbar notification toggle -->
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <!-- navbar notification dropdown -->
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notificaciones
                    <div class="float-right">
                        <a href="#">Ver todas</a>
                    </div>
                </div>
                <!-- navbar notification dropdown content -->
                <div class="dropdown-list-content">
                    <!-- navbar notification dropdown item -->
                    <a href="#" class="dropdown-item">
                        <img src="<?=$this->Url->build('/img/avatar/avatar-5.png')?>" class="rounded-circle dropdown-item-img">
                        <div class="dropdown-item-desc">
                            <b>Alfa Zulkarnain</b> has moved task <b>Add logo</b> to <b>Done</b>
                            <div class="time">Yesterday</div>
                        </div>
                    </a>
                    ...
                    ..
                </div>
            </div>
        </li>
        <!-- navbar right item -->
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?=$this->Url->build('/img/avatar/avatar-1.png')?>" width="30" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, <?=$current_user['nombre']?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="<?= $this->Url->build(['controller' => 'Usuarios','action' => 'perfil']) ?>" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Perfil
                </a>
                <a href="<?= $this->Url->build(['controller' => 'Pages','action' => 'actividad']) ?>" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Actividades
                </a>
                <a href="<?= $this->Url->build(['controller' => 'Pages','action' => 'configuraciones']) ?>" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= $this->Url->build(['controller' => 'Usuarios', 'action' => 'logout']) ?>" 
                   class="dropdown-item has-icon text-danger"
                   onclick="if (confirm('Se va a cerrar sesión. ¿Desea continuar?')) { return true; } return false;"
                >
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                </a>
            </div>
        </li>
    </ul>
</nav>
