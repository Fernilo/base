<?php
use Cake\Core\Configure;

/*Definiciones de configuracion de cakephp bootstrap*/ 
define("APP_NAME", Configure::read('App.name'));
define("VERSION", Configure::read('App.version'));
define("HOST", Configure::read('App.host'));

if (Configure::check('Google')) {
    define("API_KEY_GOOGLE", Configure::read('Google.api_key'));
}

?>