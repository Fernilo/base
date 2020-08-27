<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Asset->css([
        'bootstrap.min.css',
        'iziToast.min.css',
        'fontawesome_all.min.css',
        'admin/style.min.css',
        'admin/components.min.css',
    ]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="page-error">
                    <div class="page-inner">
                        <?= $this->Flash->render() ?>
                        <?= $this->fetch('content') ?>
                        
                        <div class="page-search">
                            <form>
                                <div class="form-group floating-addon floating-addon-not-append">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">                          
                                        <i class="fas fa-search"></i>
                                    </div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-append">
                                    <button class="btn btn-primary btn-lg">
                                        Search
                                    </button>
                                    </div>
                                </div>
                                </div>
                            </form>
                            <div class="mt-3">
                                <?= $this->Html->link(__('Volver al Inicio'), 'javascript:history.back()') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simple-footer mt-5">
                    <a href="https://www.syloper.com/contacto/" target="_blank">Syloper <?= date('Y') ?></a>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
