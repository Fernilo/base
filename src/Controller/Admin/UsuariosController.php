<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\Email;

/**
 * Usuarios Controller
 *
 * @property \App\Model\Table\UsuariosTable $Usuarios
 *
 * @method \App\Model\Entity\Usuario[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsuariosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $usuarios = $this->Usuarios->find();

        if ($this->request->getQuery('search')) {
            $usuarios->where([
                'OR' => [
                    ['Usuarios.id' => (int) $this->request->getQuery('search')],
                    ['Usuarios.nombre LIKE' => $this->request->getQuery('search').'%'],
                    ['Usuarios.apellido LIKE' => $this->request->getQuery('search').'%'],
                    ['Usuarios.email LIKE' => $this->request->getQuery('search').'%'],
                ]
            ]);
        }
        
        $usuarios = $this->paginate($usuarios);
        $this->set(compact('usuarios'));
    }

    /**
     * Ver method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException Cuando no se encuentra el registro.
     */
    public function ver($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => []
        ]);

        $this->set('usuario', $usuario);
        $this->set('roles', $this->Usuarios->roles);
    }


    /**
     * Perfil method
     *
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException Cuando no se encuentra el registro.
     */
    public function perfil()
    {
        $usuario = $this->Usuarios->get($this->Auth->user('id'), [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            try {
                if ($this->request->getData('actual_pass')) {
                    $hasher = new DefaultPasswordHasher();
                    if ($hasher->check($this->request->getData('actual_pass'), $usuario->password)) {
                        if (!$this->request->getData('nuevo_pass')) throw new \Exception(__("Debe completar una nueva clave."));
                        if (!$this->request->getData('repetir_pass')) throw new \Exception(__("Debe completar una nueva clave."));
                        if ($this->request->getData('nuevo_pass') === $this->request->getData('repetir_pass')) {
                            $this->request->data('password', $this->request->getData('nuevo_pass'));
                        }else {
                            throw new \Exception(__("Las claves no coinciden."));
                        }
                    }else {
                        throw new \Exception(__("Su contraseña actual no es correcta."));
                    }
                }
    
                $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
                if ($this->Usuarios->save($usuario)) {
                    $this->Flash->success(__('Se guardó con éxito.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('No se pudo guardar usuario. Por favor, intente nuevamente.'));
                
            } catch (\Throwable $th) {
                $this->Flash->error($th->getMessage());
            }
        }

        $this->set('usuario', $usuario);
        $this->set('roles', $this->Usuarios->roles);
    }

    /**
     * Agregar method
     *
     * @return \Cake\Http\Response|null Redirige en la edición exitosa, vuelve a la vista de lo contrario
     */
    public function agregar()
    {
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Se guardó con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar usuario. Por favor, intente nuevamente.'));
        }
        $this->set(compact('usuario'));
        $this->set('roles', $this->Usuarios->roles);
    }

    /**
     * Editat method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirige en la edición exitosa, vuelve a la vista de lo contrario.
     * @throws \Cake\Network\Exception\NotFoundException uando no se encuentra el registro.
     */
    public function editar($id = null)
    {
        $usuario = $this->Usuarios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
		
			 try {
			 if ($this->request->getData('actual_pass')) {
                    $hasher = new DefaultPasswordHasher();
                    if ($hasher->check($this->request->getData('actual_pass'), $usuario->password)) {
                        if (!$this->request->getData('nuevo_pass')) throw new \Exception(__("Debe completar una nueva clave."));
                        if (!$this->request->getData('repetir_pass')) throw new \Exception(__("Debe completar una nueva clave."));
                        if ($this->request->getData('nuevo_pass') === $this->request->getData('repetir_pass')) {
                            $this->request->data('password', $this->request->getData('nuevo_pass'));
                        }else {
                            throw new \Exception(__("Las claves no coinciden."));
                        }
                    }else {
                        throw new \Exception(__("Su contraseña actual no es correcta."));
                    }
                }
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->getData());
		   
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Se editó con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo editar usuario. Por favor, intente nuevamente.'));
			} catch (\Throwable $th) {
                $this->Flash->error($th->getMessage());
            }
        }
        $this->set(compact('usuario'));
        $this->set('roles', $this->Usuarios->roles);
    }

    /**
     * Delete method
     *
     * @param string|null $id Usuario id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function eliminar($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usuario = $this->Usuarios->get($id);
        if ($this->Usuarios->delete($usuario)) {
            $this->Flash->success(__('Se eliminó con éxito.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar usuario. Por favor, intente nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }



    public function login()
    {
        $this->viewBuilder()->setLayout('login');

        if ($this->request->getSession()->check('Auth.Admin')) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                if(!empty($this->request->getData('remember_me'))){
                    $this->Cookie->write('Admin', [
                        'email' => $this->request->getData('email'),
                        'password' => $this->request->getData('password')
                    ]);
                }
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Usuario ó contraseña incorrecta.');
        }

        // Login con cookies
        if(!$this->Auth->user() && $this->Cookie->check('Admin')){
            $cookie = $this->Cookie->read('Admin');
            $this->request->data('email', $cookie['email']);
            $this->request->data('password', $cookie['password']);
            if(!empty($this->request->getData())){
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    $this->Cookie->write('Admin', [
                        'email' => $cookie['email'],
                        'password' => $cookie['password']
                    ]);
                    return $this->redirect($this->Auth->redirectUrl());
                }
            }
        }
    }


    public function logout(){
        $this->Cookie->delete('Admin');
        return $this->redirect($this->Auth->logout());
    }



    public function olvidoPassword()
    {
        $this->viewBuilder()->layout('login');
        if($this->request->is('post')){
            try {
                if(!($this->request->getData('email'))) throw new \Exception(__("El campo 'E-mail', no puede estar vacio."));
                $usuario = $this->Usuarios->find()->where(['email' => $this->request->getData('email')])->first();
                if (!$usuario) throw new \Exception(__('El email que ingresaste no esta registrado, por favor intenta otra vez.'));

                $texto = json_encode(['email' => $this->request->getData('email'), 'fecha' => date('d-m-Y')]);
                $hash = hash('ripemd256', $texto);
                $link = json_encode(['email' => $this->request->getData('email'), 'hash' => $hash]);
                $link = base64_encode($link);

                $usuario->olvido_password = 1;
                $usuario->hash = $hash;

                if(!$this->Usuarios->save($usuario)) 
                    throw new \Exception(__('No pudimos enviar el correo. Por favor, intente nuevamente mas tarde.'));
                

                $email = new Email('default');
                $email->from(['soporte@syloper.com.ar' => 'Syloper'])
                    ->template('recuperar_password', 'default')
                    ->emailFormat('html')
                    ->to($usuario->email)
                    ->subject('Cambio de contraseña.')
                    ->viewVars(['link' => $link])
                    ->send();
                
                $this->Flash->info('Te enviamos un correo, por favor revisa tu email (verifica también en spam)');
                return $this->redirect(['action' => 'login']);
            } catch (\Exception $e) {
                $this->Flash->error($e->getMessage(), ['escape' => false]);
            }
        }
    }


    public function resetPassword()
    {
        $this->viewBuilder()->layout('login');
        $estado = false;
        try {
            if(!empty($this->request->getQuery('token'))){
                try {
                    $token = base64_decode($this->request->getQuery('token'));
                    $array = json_decode($token);
                    $usuario = $this->Usuarios->find()->where(['email' => $array->email])->first();
                    if(!$usuario) 
                        throw new \Exception("Ups.. no se pudo identificar. Puede que no este registrado, pruebe cambiando la contraseña nuevamente.");
                    if($usuario->hash != $array->hash) throw new \Exception("El link es corrupto.");
                    $texto = json_encode(['email' => $usuario->email, 'fecha' => date('d-m-Y')]);
                    $hash = hash('ripemd256', $texto);

                    if($usuario->hash == $hash){
                        $estado = true;
                        $this->request->getSession()->write('usuario_id', $usuario->id);
                        $this->set(compact('estado'));
                    }else{
                        throw new \Exception("El link ha expirado.");
                    }
                } catch (\Exception $e) {
                    $this->Flash->error($e->getMessage());
                    return $this->redirect('/');
                }  
            }else{
                if($this->request->getSession()->check('usuario_id')) $this->request->getSession()->delete('usuario_id');
                return $this->redirect(['action' => 'logout']);
            }

            if($this->request->is('post')) {
                try {
                    if(!($this->request->getData('nuevo_pass'))) 
                        throw new \Exception("El campo 'Nueva contraseña', no puede estar vacio.");
                    if(!($this->request->getData('repetir_pass'))) 
                        throw new \Exception("El campo 'Repetir contraseña', no puede estar vacio.");
                    if($this->request->getData('nuevo_pass') != $this->request->getData('repetir_pass')) 
                        throw new \Exception("Las contraseñas no coinciden.");
                    if(!$this->request->getSession()->check('usuario_id')) 
                        throw new \Exception("Ups.. no se pudo identificar. Puede que no este registrado, pruebe cambiando la contraseña nuevamente.");
                    if($this->request->getData('email') != $array->email) 
                        throw new \Exception("El e-mail no coinciden.");

                    $usuario = $this->Usuarios->get($this->request->getSession()->read('usuario_id'));
                    $usuario->password = $this->request->getData('nuevo_pass');
                    $usuario->olvido_password = 0;
                    $usuario->hash = null;
                    if (!$this->Usuarios->save($usuario)) throw new \Exception("La contraseña no se pudo cambiar. Intente nuevamente.");

                    if($this->request->getSession()->check('usuario_id')) $this->request->getSession()->delete('usuario_id');
                    
                    $this->Flash->success('La contraseña ha sido cambiada.');
                    return $this->redirect('/');

                } catch (\Exception $e) {
                    $this->set(compact('estado')); 
                    $this->Flash->error($e->getMessage());
                    return $this->redirect('/');
                }
            }
        } catch (\Exception $e) {
            $this->Flash->error($e->getMessage());
            return $this->redirect('/');
        }
    }
    
    
    public function registro()
    {
        $usuario = $this->Usuarios->newEntity();
        $usuario->rol = 'usuario';
        $this->viewBuilder()->layout('login');

        $this->set('usuario', $usuario);
    }
}
