<?php
namespace Acme\Auth;

class Validation{
  private $_passed = false,
          $_errors = array();

  public function check($items = array()){
    foreach($items as $item => $rules){
      foreach($rules as $rule => $rule_value){
        
        switch ($rule) {
          // MENGUJI APAKAH DATA KOSONG
          case 'required':
            if ( trim( Input::get($item) ) == false && $rule_value == true ){
              $this->addError($item . "wajib diisi");
            }
            break;

          // MENGUJI SYARAT MINIMAL DATA
          case 'min':
            if ( strlen(Input::get($item) ) < $rule_value ){
              $this->addError($item . "minimal $rule_value huruf");
            }
            break;
          
          // MENGUJI SYARAT MAKSIMAL DATA
          case 'max':
          if ( strlen(Input::get($item) ) > $rule_value ){
              $this->addError($item . "maksimal $rule_value huruf");
            }
            break; 
          
          default:
            break;

        }//ENDSWITCH
      }//ENDFOREACH1
    }//ENDFOREACH1

    //MENGUJI ERROR UNTUK APAKAH KOSONG UNTUK BERHASIL MELAKUKAN VALIDASI
    if(empty($this->_errors)){
      $this->_passed = true;
    }

    return $this;
  }

  //MENAMBAHKAN ERROR KE ARRAY ERROR
  private function addError($error){
    $this->_errors[] = $error;
  }

  // MENGIRIM DATA ERROR
  public function errors(){
    return $this->_errors;

  }

  // MENGIRIM NILAI PASSED HASIL VALIDASI
  public function passed(){
    return $this->_passed;
  }
}