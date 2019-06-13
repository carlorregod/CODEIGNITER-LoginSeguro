<?php
function is_logged_in() 
{
    // Get current CodeIgniter instance
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('user_data');
    //El remember token... 
    $token = $user['remember_token'];
    $t = $CI->usuario->consultaToken($user['id']);
    $comparatoken = ($token == $t);
    if (!isset($user) && $comparatoken ) { return false; } else { return true; }
}
