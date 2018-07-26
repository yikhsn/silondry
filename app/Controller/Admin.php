<?php
namespace Acme\Controller;

use Acme\Engine\Util;
use Acme\Auth\Session;
use Acme\Model\Admin as Model;
use Helper\Input;

class Admin
{
  public function __construct()
  {
    if (empty($_SESSION))
      @session_start();
    
    $this->util = new Util;
    $this->model = new Model;
  }

  public function login()
  {
    if( Session::exists('username') )
      header('location: ?p=home');

    $errors = array();

    if ( Input::get('submit') ){

      $username = array('username' => Input::get('username'));
      
      if( $this->model->cek_nama($username) )
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

      if( $this->model->register_user($data) )
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

  public function change()
  {
    $errors = array();    

    if ( Input::get('submit') )
    {  
      $pass = array ('password' => password_hash(Input::get('new_pass'), PASSWORD_DEFAULT));
      $user = array ('username' => $_SESSION['username'] );
       
      if( $this->model->CheckPassword( Input::get('old_pass'), $user ) )
        if ( Input::get('new_pass') == Input::get('confirm_pass') )
          if ( $this->model->update_password( $pass, $user ) )
            header('location: ?p=admin&a=logout');

      else
        $errors = "Kesalahan mengubah password, periksa dan ulangi lagi!";
    }
                        
    $this->util->errors = $errors;
    $this->util->getView('change_password');
  }

  public function logout()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    session_destroy();
    header('location: ?p=admin&a=login');
  }

  public function notFound()
  {
    exit('Halaman yang anda cari tidak ada');
  }
}