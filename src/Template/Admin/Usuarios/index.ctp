<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> Usuarios</h4>
            <div class="card-header-form">
                <form>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search" 
                            value="<?=($this->request->getQuery('search'))? $this->request->getQuery('search') : ''?>">
                        <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>E-mail</th>
                            <th>Creado</th>
                            <th>Actualizado</th>
                            <th colspan="3"></th>
                        </tr>
                    </thead>

                    <?php foreach($usuarios as $usuario): ?>
                        <tbody>
                            <tr>
                                <td><?= $usuario->id ?></td>
                                <td><?= $usuario->nombre ?></td>
                                <td><?= $usuario->apellido ?></td>
                                <td><?= $usuario->email ?></td>
                                <td><?= $usuario->created ?></td>
                                <td><?= $usuario->modified ?></td>
                                <td class="">
                                    <?= $this->Html->link(
                                        '<i class="fas fa-eye"></i>', 
                                        ['controller' => 'Usuarios', 'action' => 'ver', $usuario->id],
                                        ['escape' => false, 'class' => 'btn btn-sm btn-primary']) 
                                    ?>
                                </td>
                                <td class="">
                                    <?= $this->Html->link(
                                        '<i class="fas fa-edit"></i>', 
                                        ['controller' => 'Usuarios', 'action' => 'editar', $usuario->id],
                                        ['escape' => false, 'class' => 'btn btn-sm btn-primary']) 
                                    ?>
                                </td>
                                <td>
                                    <?= $this->Form->postLink(
                                        '<i class="fas fa-trash"></i>', 
                                        ['controller' => 'Usuarios', 'action' => 'editar', $usuario->id],
                                        [
                                            'escape' => false, 
                                            'class' => 'btn btn-sm btn-danger', 
                                            'confirm' => 'Se eliminar el usuario. ¿Desea continuar?'
                                        ]) ?>
                                </td>
                            </tr>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
            
        </div>

        <div class="card-footer text-right">
            <?= $this->element('paginador') ?>
        </div>
    </div>
</div>