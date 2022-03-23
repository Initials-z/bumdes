<?php

function ceklogin()
{
    $japeg = get_instance();

    if (!$japeg->session->userdata('username')) {
        redirect('Welcome/not_found');
    }
}
