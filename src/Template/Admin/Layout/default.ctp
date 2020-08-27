<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="application-name" content="<?= APP_NAME ?>">
    <meta name="description" content="">
    <meta name="author" content="Syloper">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <!-- No poner links externos -->
    <?= $this->Asset->css([
        'bootstrap.min.css',
        'iziToast.min.css',
        'fontawesome_all.min.css',
        'flatpickr.min.css',
        'select2.min.css'
    ]) ?>

    <?= $this->Html->css([
        'admin/style.min.css',
        'admin/components.min.css',
        'summernote.min.css'
    ]) ?>


    <!-- POR FAVOR, "NO" CARGAR CSS SUELTOS ACA -->

    <script type="text/javascript">
        const HOST = "<?= $this->Url->build('/') ?>";

    </script>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <?= $this->element('navbar') ?>

            <?= $this->element('sidebar') ?>


            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= $this->request->getParam('controller') ?></h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="<?= $this->Url->build('/admin/') ?>">Admin</a></div>
                            <div class="breadcrumb-item">
                                <a href="<?= $this->Url->build('/admin/'.$this->request->getParam('controller').'/index') ?>">
                                    <?= $this->request->getParam('controller') ?>
                                </a>
                            </div>
                            <div class="breadcrumb-item"><?= $this->request->getParam('action') ?></div>
                        </div>
                    </div>

                    <!-- Your content goes here -->
                    <div class="section-body">
                        <!-- <h2 class="section-title">This is Example Page</h2>
                        <p class="section-lead">This page is just an example for you to create your own page.</p> -->
                        <!-- Your content goes here -->
                        <?= $this->fetch('content') ?>
                    </div>
                </section>
            </div>

            <?= $this->element('footer') ?>
        </div>
    </div>

    <!-- No poner links externos -->
    <?= $this->Asset->script([
        "jquery.min.js",
        "bootstrap.bundle.min.js",
        "jquery.nicescroll.min.js",
        "moment.min.js",
        "iziToast.min.js",
        "select2.min.js",
        "flatpickr.min.js",
        "es.flatpickr.js",
        "pwstrength.min.js",
        "admin/stisla.min.js",
    ]) ?>

    <?= $this->Html->script([
        'admin/scripts.js',
        'admin.min.js',
        'summernote.min.js'
    ]) ?>

    <?= $this->fetch('script') ?>
    <?= $this->Flash->render() ?>

    <!-- POR FAVOR, "NO" CARGAR SCRIPTS SUELTOS ACA -->
</body>

</html>