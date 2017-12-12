<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'visitor';
$route['404_override'] = 'Error';
$route['translate_uri_dashes'] = FALSE;


//Admin Side
$route['admin/produk/customize/(:any)'] 	= 'admin/Produk/insert_customize/$1';
$route['admin/produk/customize-action']		= 'admin/Produk/insert_customize_action';
//untuk melihat detail produk
$route['admin/produk/detail']		= 'admin/Produk/detail/$1';
$route['admin/konfirmasi-pembayaran/list']			= 'admin/Order/konfirmasi_pembayaran_list';
$route['admin/konfirmasi-pembayaran/read/(:any)']	= 'admin/Order/konfirmasi_pembayaran_read/$1';

$route['admin/order/list']			= 'admin/Order';
$route['admin/order/read/(:any)']	= 'admin/Order/read/$1';
$route['admin/resend-invoice-konfirmasi/(:any)']	= 'admin/Order/resend_invoice_konfirmasi/$1';

// End Admin

$route['produk/(:any)/(:any)']		= 'Visitor/detail/$1/$2';//detail produk
$route['all-products']				= 'Visitor/all_products';
$route['all-products/(:any)']		= 'Visitor/all_products/$1';
$route['kado-untuk/(:any)']			= 'Visitor/sort_by_tema/$1';
$route['member/login']				= 'Login/login';
$route['member/login-action']		= 'Login/login_action';
//untuk lihat my cart
$route['search']					= 'Visitor/search';
$route['filter-by/kategori']		= 'Visitor/filter_by';
$route['filter-by/subkategori']		= 'Visitor/filter_by';

$route['member/my-cart/(:any)']		= 'Member/my_cart/$1';
$route['member/my-cart']			= 'Visitor/my_cart';
$route['member/cart-delete/(:any)']	= 'Member/delete_cart/$1';
$route['member/detail-cart/(:any)']	= 'Member/detail_cart/$1';

$route['member/my-profile/(:any)']	= 'Member/my_account/$1';
$route['member/riwayat-order/(:any)']	= 'Member/riwayat_order/$1';
$route['member/my-order/(:any)']	= 'Member/my_order/$1';
$route['member/register']			= 'Visitor/register_member';
$route['member/register-action']	= 'Visitor/register_action';
//
$route['order/checkout']			= 'Member/order_form';
$route['order/edit-form/(:any)']	= 'Member/edit_order_form/$1';
$route['order/edit-form-action']	= 'Member/edit_order_form_action';
$route['order/metode-pengambilan/(:any)']	= 'Member/metode_pengambilan/$1';
$route['order/metode-pengambilan-action']	= 'Member/metode_pengambilan_action';
$route['order/edit-metode-pengambilan/(:any)']	= 'Member/edit_metode_pengambilan/$1';
$route['order/edit-metode-pengambilan-action']	= 'Member/edit_metode_pengambilan_action';
$route['order/order-review/(:any)']		= 'Member/order_review/$1';

$route['order/submit']				= 'Member/order_action';

$route['order/metode-pembayaran/(:any)']	= 'Member/metode_pembayaran/$1';
$route['order/metode-pembayaran-action']	= 'Member/metode_pembayaran_action';
$route['order/konfirmasi-tanpa-login']		= 'Visitor/konfirmasi_pembayaran_no_login';
$route['order/konfirmasi-pembayaran/(:any)']		= 'Member/konfirmasi_pembayaran/$1';
$route['order/konfirmasi-pembayaran-action']		= 'Member/konf_pemb_action';
$route['order/order-review/(:any)']			= 'Member/order_review/$1';


$route['sort-by/kategori/(:any)']			= 'Visitor/sort_by/kategori/$1';
$route['sort-by/subkategori/(:any)']		= 'Visitor/sort_by/subkategori/$1';

$route['confirm-email-verification/(:any)']	= 'Visitor/verify/$1';
$route['resend-email-verification']	= 'Visitor/resend_email_verification';

