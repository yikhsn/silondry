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
  $errors = array();

  if( Session::exists('username') )
    header('location: ?p=home');

    if ( Input::get('submit') ){

      // MENGUJI APAKAH USERNAME INPUTAN USER ADA DI DATABASE
      if( $this->model->cek_nama( array('username' => Input::get('username')) ) )
      {  
        // MENGIRIM DATA HASIL INPUT
        if( $this->model->login_user(Input::get('password'), array(
          'username' => Input::get('username')
        ) ) )
        
        {
          Session::set('username', Input::get('username') );
          header('location: ?p=home');  
        }

        else
        {
          $errors[] = 'Password salah';
        }
      }
      else
      {
        $errors[] = "Username tidak terdaftar";
      }
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
      if( $this->model->register_user( array(
        'username' => Input::get('username'),
        'password' => password_hash( Input::get('password'), PASSWORD_DEFAULT),
        'id_pegawai' => Input::get('id_pegawai')
      ) ) )
      {
        Session::set('username', Input::get('username'));  
        header('location: ?p=home');
      }
      else
      {
        $errors = "Kesalahan saat melakukan register, periksa dan ulangi lagi!";
      }
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
      if( $this->model->change_password( 
        array('old_pass' => Input::get('old_pass')), 
        array('username' => $_SESSION['username']) 
      ) )
      {
        if ( Input::get('new_pass') == Input::get('confirm_pass') )
        {
          if ($this->model->update_password(
            array ('password' => password_hash(Input::get('new_pass'), PASSWORD_DEFAULT)),
            array ('username' => $_SESSION['username'] )
          ))
          {
            die('berhasil mengubah password');
          }
        }
      }
      else
      {
        $errors = "Kesalahan mengubah password, periksa dan ulangi lagi!";
      }
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