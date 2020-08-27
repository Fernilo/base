<p>Este es un email de cambio de contraseña, ingrese al siguiente link y siga los pasos.</p>

<p>
    <?= $this->Html->link(
        '<singleline>
            <span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;Cambiar contraseña &nbsp;&nbsp;&nbsp;&nbsp;</span>
        </singleline>', 
        ['controller' => 'Usuarios', 'action' => 'resetPassword',  'token' => $link, '_full' => true], 
        [
            "escape" => false,
            "class" => "button-a",
            "style" => "background: #26a4d3; border: 15px solid #26a4d3; font-family: 'Montserrat', sans-serif; font-size: 14px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 50px; font-weight: bold;"
        ]) ?>
</p>
