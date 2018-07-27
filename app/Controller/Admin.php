<?php
namespace Acme\Controller;

use Acme\Engine\Util;
use Acme\Auth\Session;
use Acme\Model\Admin as Model;
use Helper\Input;

class Admin
{
    /**
   * the constructor method 
   * load and define all the instances of model and engine that needed
   * start session 
   */
  public function __construct()
  {
    if (empty($_SESSION))
      @session_start();
    
    $this->util = new Util;
    $this->model = new Model;
  }

  /**
   * login into the app
   * @return View login
   */
  public function login()
  {
    if( Session::exists('username') )
      header('location: ?p=home');

    $errors = array();

    if ( Input::get('submit') ){
      
      $username = array('username' => Input::get('username'));
      
      if( $this->model->checkName($username) )
      {  
        if( $this->model->checkPassword(Input::get('password'), $username) )
        {
          Session::set('username', Input::get('username') );
          header('location: ?p=home');  
        }
        else
          $errors[] = 'Password salah';
      }
      else      
        $errors[] = "Username tidak terdaftar";
    }
    $this->util->errors = $errors;
    $this->util->getView('login');
  }

  /**
   * registering the new user to the app
   * @return View register
   */
  public function register()
  {
    if( Session::exists('username') )
      header('location: ?p=index');

    $errors = array();    

    if ( Input::get('submit') )
    {  
      $data = array(
        'username' => Input::get('username'),
        'password' => password_hash( Input::get('password'), PASSWORD_DEFAULT),
        'id_pegawai' => Input::get('id_pegawai')
      );

      if( $this->model->registerUser($data) )
      {
        Session::set('username', Input::get('username'));  
        header('location: ?p=home');
      }

      else
        $errors = "Kesalahan saat melakukan register, periksa dan ulangi lagi!";
    }

    $this->util->id_pegawai = $this->model->getNextId();
    $this->util->errors = $errors;
    $this->util->getView('register');
  }

  /**
   * change password of the existing and active session user
   * @return View change_password
   */
  public function change()
  {
    $errors = array();    

    if ( Input::get('submit') )
    {  
      $pass = array ('password' => password_hash(Input::get('new_pass'), PASSWORD_DEFAULT));
      $user = array ('username' => $_SESSION['username'] );
       
      if( $this->model->checkPassword( Input::get('old_pass'), $user ) )

        if ( Input::get('new_pass') == Input::get('confirm_pass') )

          if ( $this->model->updatePassword( $pass, $user ) )
            header('location: ?p=admin&a=logout');

      else
        $errors = "Kesalahan mengubah password, periksa dan ulangi lagi!";
    }
                        
    $this->util->errors = $errors;
    $this->util->getView('change_password');
  }

  /**
   * logout and and destroy session of the the logging in user
   */
  public function logout()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    session_destroy();
    header('location: ?p=admin&a=login');
  }

  /**
   * page to return for the user who accesing not available url
   * @return View not_found
   */
  public function notFound()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    $this->util->getView('index');
  }
}