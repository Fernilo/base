<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $helpers = [
        'Paginator' => ['templates' => 'paginator-templates']
    ];

    /**
     * Respuesta estandar de API
     */
    public $respuesta = [
        'estado'     => false,
        'mensaje'    => '', //'Ocurrió un error, por favor intentá nuevamente.',
        'resultados' => [],
        'errores'    => []
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->loadComponent('Utiles');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');


        $this->loadComponent('Auth', [
            'loginRedirect' => [ 'controller' => '/', 'action' => '/'],
            'logoutRedirect' => [ 'controller' => '/', 'action' => 'login'],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password'],
                    'userModel' => 'Usuarios'
                ]
            ],
            'storage' => ['className' => 'Session', 'key' => 'Auth.Admin'],
            'loginAction' => [ 'controller' => '/', 'action' => 'login'],
            'unauthorizedRedirect' => $this->referer(),
            'authorize' => 'Controller',
            'authError' => false,
        ]);
        
        $this->Auth->__set('sessionKey', 'Auth.Admin');
    }



    /**
     * isAuthorized method
     *
     * @param array $user
     * @return boolean
     */
    public function isAuthorized($user){
        
        if( ($user['rol'] != 'admin' ) ){
            $this->Flash->error(__('Usuario y/o contraseña incorrectos!.'));
            return $this->redirect(['controller' => 'Users', 'action' => 'login','prefix' => false]);
        }
        return true;
    }



    public function beforeFilter(Event $event){
        $this->Auth->allow(['login', 'logout', 'olvidoPassword', 'resetPassword', 'registro']);
        
        if ($this->request->getSession()->check('Auth.Admin')) {
            // $this->loadModel('Users');
            // $cu = $this->Users->get($this->request->getSession()->read('Auth.Admin')['id']);
            $cu = $this->request->getSession()->read('Auth.Admin');
            unset($cu['password']);
            
            $this->set('current_user', $cu);
            // $this->set('current_user', $this->request->getSession()->read('Auth.Admin'));
        }


        $this->Cookie->configKey('Admin', 'path', '/');
        $this->Cookie->configKey('Admin', [
            'expires' => '+10 days',
            'httpOnly' => true
        ]);
    }
}
