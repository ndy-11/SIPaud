<?php

// fungsi untuk mengecek apakah sudah login atau belum
// Jika sudah login maka akan dialhikan ke halaman admin
function is_logged_in()
{
	$ths = &get_instance();
	// Cek jika user udah login, tapi mau balik ke halaman login
	if ($ths->session->userdata('role') == 'admin') {
		// Redirect in aja ke admin
		redirect('admin');
	}else if ($ths->session->userdata('role') == 'kepsek') {
		// Redirect in aja ke admin
		redirect('kepsek');
	}else if ($ths->session->userdata('role') == 'guru') {
		// Redirect in aja ke admin
		redirect('guru');
	}if ($ths->session->userdata('role') == 'orangtua') {
		// Redirect in aja ke admin
		redirect('orangtua');
	}
}

// fungsi untuk mengecek apakah sudah login atau belum
// Jika belum login maka akan dialhikan ke halaman login
function is_logged_not_in()
{
	// $ths = &get_instance();
	
	// if ($ths->session->userdata('role') == 'admin') {
	// 	redirect('admin');
	// }
	// if ($ths->session->userdata('role') == 'kepsek') {
	// 	redirect('kepsek');
	// }
	// if ($ths->session->userdata('role') == 'guru') {
	// 	redirect('guru');
	// }
	// if ($ths->session->userdata('role') == 'orangtua') {
	// 	redirect('orangtua');
	// }

	// if ($ths->session->userdata('role') == 'admin' && $ths->uri->segment(1) == 'orangtua') {
	// 	redirect('admin');
	// }
	// if ($ths->session->userdata('role') == 'orangtua' && $ths->uri->segment(1) == 'admin') {
	// 	redirect('orangtua');
	// }
	// if ($ths->session->userdata('role') == 'admin' && $ths->uri->segment(1) == 'kepsek') {
	// 	redirect('admin');
	// }
	// if ($ths->session->userdata('role') == 'kepsek' && $ths->uri->segment(1) == 'admin') {
	// 	redirect('kepsek');
	// }
	// if (!$ths->session->userdata('username')) {
	// 	$ths->session->set_flashdata('error', 'Login terlebih dahulu');
	// 	redirect('login');
	// }
}

// Untuk mengaktifkan menu di home
function activeMenu($arrayMenu)
{
	$ths = &get_instance();
	return !in_array($ths->uri->segment(2), $arrayMenu) ?: 'class="active"';
}
// function is_logged_in_guru()
// {
// 	$ths = &get_instance();
// 	// Cek jika user udah login, tapi mau balik ke halaman login
// 	if ($ths->session->userdata('username')) {
// 		// Redirect in aja ke admin
// 		redirect('guru');
// 	}
// }

// fungsi untuk mengecek apakah sudah login atau belum
// Jika belum login maka akan dialhikan ke halaman login
// function is_logged_not_in_guru()
// {
// 	$ths = &get_instance();
// 	if ($ths->session->userdata('role') == 'guru' && $ths->uri->segment(1) == 'guru') {
// 		redirect('guru');
// 	}
	
// 	if (!$ths->session->userdata('username')) {
// 		$ths->session->set_flashdata('error', 'Login terlebih dahulu');
// 		redirect('log_guru');
// 	}
// }

// Untuk mengaktifkan menu di home
function activeMenu_guru($arrayMenu)
{
	$ths = &get_instance();
	return !in_array($ths->uri->segment(2), $arrayMenu) ?: 'class="active"';
}
