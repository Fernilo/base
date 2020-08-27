<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Ejemplo de Modales</h4>
            </div>
            <div class="card-body">
                <p class="mb-2">Check the <code>modal.js</code> code in the <code>dist/js/page</code> folder to get the
                    source code.</p>
                <div class="buttons">
                    <button class="btn btn-primary" id="modal-1">Modal Demo</button>
                    <button class="btn btn-primary" id="modal-2">Modal Center</button>
                    <button class="btn btn-primary" id="modal-3">Buttons</button>
                    <button class="btn btn-primary" id="modal-4">Footer Background</button>
                    <button class="btn btn-primary" id="modal-5">Login</button>
                    <button class="btn btn-primary" id="modal-6">Something in the Footer</button>
                    <button class="btn btn-danger" id="modal-7" data-confirm="Realy?|Do you want to continue?"
                        data-confirm-yes="alert('Deleted :)');">Delete</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">The Bootstrap
                        Way</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    $(document).ready(function () {
        "use strict";

        $("#modal-1").fireModal({
            body: 'Modal body text goes here.'
        });
        $("#modal-2").fireModal({
            body: 'Modal body text goes here.',
            center: true
        });

        let modal_3_body =
            '<p>Object to create a button on the modal.</p><pre class="language-javascript"><code>';
        modal_3_body += '[\n';
        modal_3_body += ' {\n';
        modal_3_body += "   text: 'Login',\n";
        modal_3_body += "   submit: true,\n";
        modal_3_body += "   class: 'btn btn-primary btn-shadow',\n";
        modal_3_body += "   handler: function(modal) {\n";
        modal_3_body += "     alert('Hello, you clicked me!');\n"
        modal_3_body += "   }\n"
        modal_3_body += ' }\n';
        modal_3_body += ']';
        modal_3_body += '</code></pre>';


        $("#modal-3").fireModal({
            title: 'Modal with Buttons',
            body: modal_3_body,
            buttons: [{
                text: 'Click, me!',
                class: 'btn btn-primary btn-shadow',
                handler: function (modal) {
                    alert('Hello, you clicked me!');
                }
            }]
        });


        $("#modal-4").fireModal({
            footerClass: 'bg-whitesmoke',
            body: 'Add the <code>bg-whitesmoke</code> class to the <code>footerClass</code> option.',
            buttons: [{
                text: 'No Action!',
                class: 'btn btn-primary btn-shadow',
                handler: function (modal) {}
            }]
        });


        $("#modal-5").fireModal({
            title: 'Login',
            body: $("#modal-login-part"),
            footerClass: 'bg-whitesmoke',
            autoFocus: false,
            onFormSubmit: function (modal, e, form) {
                // Form Data
                let form_data = $(e.target).serialize();
                console.log(form_data)

                // DO AJAX HERE
                let fake_ajax = setTimeout(function () {
                    form.stopProgress();
                    modal.find('.modal-body').prepend(
                        '<div class="alert alert-info">Please check your browser console</div>'
                        )

                    clearInterval(fake_ajax);
                }, 1500);

                e.preventDefault();
            },
            shown: function (modal, form) {
                console.log(form)
            },
            buttons: [{
                text: 'Login',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function (modal) {}
            }]
        });


        $("#modal-6").fireModal({
            body: '<p>Now you can see something on the left side of the footer.</p>',
            created: function (modal) {
                modal.find('.modal-footer').prepend(
                    '<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>');
            },
            buttons: [{
                text: 'No Action',
                submit: true,
                class: 'btn btn-primary btn-shadow',
                handler: function (modal) {}
            }]
        });

        $('.oh-my-modal').fireModal({
            title: 'My Modal',
            body: 'This is cool plugin!'
        });
    });

</script>
<?php $this->end(); ?>


<form class="modal-part" id="modal-login-part">
    <p>This login form is taken from elements with <code>#modal-login-part</code> id.</p>
    <div class="form-group">
        <label>Username</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <input type="text" class="form-control" placeholder="Email" name="email">
        </div>
    </div>
    <div class="form-group">
        <label>Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
    </div>
    <div class="form-group mb-0">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
            <label class="custom-control-label" for="remember-me">Remember Me</label>
        </div>
    </div>
</form>


<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
