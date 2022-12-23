<?php
function is_admin()
{
    $ci = get_instance();
    if ($ci->session->userdata('level') != null) {
        if ($ci->session->userdata('level') != '0') {
            redirect('auth');
        }
    } else {
        redirect('auth');
    }
}
function is_operator()
{
    $ci = get_instance();
    if ($ci->session->userdata('level') != null) {
        if ($ci->session->userdata('level') != '0' && $ci->session->userdata('level') != '1') {
            redirect('auth');
        }
    } else {
        redirect('auth');
    }
}
function is_logged_in()
{
    $ci = get_instance();
    if ($ci->session->userdata('level') == null) {
        redirect('auth');
    }
}
