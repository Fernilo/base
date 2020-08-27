<!DOCTYPE html>
<html lang="es">

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="application-name" content="<?= APP_NAME ?>">
    <meta name="description" content="">
    <meta name="author" content="Syloper">
    <title> <?= $this->fetch('title') ?> </title>

    <?= $this->fetch('meta') ?>
    <?= $this->Html->meta('icon') ?>

    <!-- No poner links externos -->
    <?= $this->Asset->css([
            'bootstrap.min.css',
            'iziToast.min.css',
        ]) ?>

    <?= $this->Html->css([
            'fontawesome_all.min.css',
            'admin/style.min.css',
            'admin/components.min.css',
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
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <?= $this->Html->image('logos/syloper.svg', ['alt' => 'logo', 'width' => '200']) ?>
                            <!-- <img src="/img/logos/syloper.svg" alt="logo" width="200"
                                class="shadow-light rounded-circle"> -->
                        </div>
                        <?= $this->fetch('content') ?>

                        <div class="simple-footer">
                            Copyright &copy; Stisla 2018
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <?= $this->Asset->script([
        "jquery.min.js",
        "bootstrap.bundle.min.js",
        "jquery.nicescroll.min.js",
        "moment.min.js",
        "iziToast.min.js",
        "pwstrength.min.js",
        "admin/stisla.min.js",
    ]) ?>
    <?= $this->Html->script([
        'admin.min.js',
        'admin/scripts.min.js'
    ]) ?>

    <?= $this->fetch('script') ?>
    <?= $this->Flash->render() ?>

    <!-- POR FAVOR, "NO" CARGAR SCRIPTS SUELTOS ACA -->
</body>

</html>
