<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function check_captcha($val) 
{
    $CI =& get_instance();
    
    if ($CI->recaptcha->check_answer($CI->input->ip_address(),$CI->input->post('recaptcha_challenge_field'),$val)) {
        return TRUE;
    } else {
        $CI->form_validation->set_message('check_captcha',$CI->lang->line('recaptcha_incorrect_response'));
        return FALSE;
    }
}