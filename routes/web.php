<?php

use Illuminate\Support\Facades\Route;

/* Admin Controllers */
use App\Http\Controllers\Admin\{
    AMasterCategory,
    AMasterContact,
    AMasterDiscount,
    AMasterHome,
    AMasterOrder,
    AMasterProduct,
    AMasterProductAttribute,
    AMasterProductImage,
    AMasterSlider,
    AMasterSubcategory,
    AMasterUser
};

/* User Controllers */
use App\Http\Controllers\User\{
    UMasterCart,
    UMasterCheckout,
    UMasterContact,
    UMasterHome,
    UMasterOrder,
    UMasterProduct,
    UMasterProfile,
    UMasterShop,
    UMasterSigninup
};

/* Middleware */
use App\Http\Middleware\{
    AdminAuthentication,
    UserAuthentication
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Default Route */
Route::get('/', function () {
    return redirect()->route('home');
});

/* User Routes */

/* Home */
Route::get('/home', [UMasterHome::class, 'home'])->name('home');

/* Contact */
Route::get('/User/contact', [UMasterContact::class, 'contact'])->name('contact');
Route::post('/User/addcontact_action', [UMasterContact::class, 'addcontact_action'])->name('addcontact.action');

/* User Authentication Routes */
Route::get('/User/signin', [UMasterSigninup::class, 'signin'])->name('signin');
Route::post('/User/signin_action', [UMasterSigninup::class, 'signin_action'])->name('signin.action');
Route::get('/User/signup', [UMasterSigninup::class, 'signup'])->name('signup');
Route::post('/User/signup_action', [UMasterSigninup::class, 'signup_action'])->name('signup.action');
Route::get('/User/otp', [UMasterSigninup::class, 'otp'])->name('otp');
Route::post('/User/otp_action', [UMasterSigninup::class, 'otp_action'])->name('otp.action');

/* Shop Routes */
Route::get('/User/shop/{category?}/{subcategory?}', [UMasterShop::class, 'shop'])->name('shop');
Route::post('/User/search_action', [UMasterShop::class, 'search_action'])->name('search.action');
Route::post('/User/price_action', [UMasterShop::class, 'price_action'])->name('price.action');

/* Product Route */
Route::get('/User/product/{id}/{atu?}', [UMasterProduct::class, 'product'])->name('product');

/* User Authentication Middleware */
Route::middleware([UserAuthentication::class])->group(function () {

    /* Cart Routes */
    Route::get('/User/cart', [UMasterCart::class, 'cart'])->name('cart');
    Route::post('/User/addcart_action', [UMasterCart::class, 'addcart_action'])->name('addcart.action');
    Route::get('/User/updatecart_action/{id},{qty}', [UMasterCart::class, 'updatecart_action'])->name('uptcart.action');
    Route::get('/User/deletecart_action/{id}', [UMasterCart::class, 'deletecart_action'])->name('delcart.action');
    Route::post('/User/applydiscount_action', [UMasterCart::class, 'applydiscount_action'])->name('appdiscount.action');
    Route::get('/User/removediscount_action', [UMasterCart::class, 'removediscount_action'])->name('remdiscount.action');
    Route::post('/User/setsubtotal_action', [UMasterCart::class, 'setsubtotal_action'])->name('setsubtotal.action');

    /* Order Routes */
    Route::get('/User/order', [UMasterOrder::class, 'order'])->name('order');
    Route::get('/User/download_invoice/{id}', [UMasterOrder::class, 'download_invoice'])->name('download.invoice');
    Route::get('/User/cancelorder_action/{id}', [UMasterOrder::class, 'cancelorder_action'])->name('canorder.action');

    /* Checkout Routes */
    Route::get('/User/checkout', [UMasterCheckout::class, 'checkout'])->name('checkout');
    Route::post('/User/checkout_action', [UMasterCheckout::class, 'checkout_action'])->name('checkout.action');
    Route::get('/User/payment', [UMasterCheckout::class, 'payment'])->name('payment');
    Route::post('/User/payment_action', [UMasterCheckout::class, 'payment_action'])->name('payment.action');
    Route::post('/User/repayment', [UMasterCheckout::class, 'repayment'])->name('repayment');

    /* Profile Routes */
    Route::get('/User/profile', [UMasterProfile::class, 'profile'])->name('profile');
    Route::post('/User/profile_action', [UMasterProfile::class, 'profile_action'])->name('profile.action');
    Route::get('/User/logout_action', [UMasterProfile::class, 'logout_action'])->name('logout.user');

    /* Buy Now Route */
    Route::post('/User/buynow_action', [UMasterProduct::class, 'buynow_action'])->name('buynow.action');

});

/* Admin Routes */

/* Admin Authentication Middleware */
Route::middleware([AdminAuthentication::class])->group(function () {

    /* Admin Home */
    Route::get('/admin', [AMasterHome::class, 'home'])->name('admin');

    /* User Management */
    Route::get('/Admin/user/edit/{id}', [AMasterUser ::class, 'edit'])->name('edit.use');
    Route::post('/Admin/user/update_action/{id}', [AMasterUser ::class, 'updateuse'])->name('update.use');
    Route::get('/Admin/user/delete_action/{id}', [AMasterUser ::class, 'deleteuse'])->name('delete.use');

    /* Category Management */
    Route::get('/Admin/category/create', [AMasterCategory::class, 'create'])->name('create.cat');
    Route::get('/Admin/category/manage', [AMasterCategory::class, 'manage'])->name('manage.cat');
    Route::get('/Admin/category/edit/{id}', [AMasterCategory::class, 'edit'])->name('edit.cat');
    Route::post('/Admin/category/store_action', [AMasterCategory::class, 'storecat'])->name('store.cat');
    Route::post('/Admin/category/update_action/{id}', [AMasterCategory::class, 'updatecat'])->name('update.cat');
    Route::get('/Admin/category/delete_action/{id}', [AMasterCategory::class, 'deletecat'])->name('delete.cat');

    /* Subcategory Management */
    Route::get('/Admin/subcategory/create', [AMasterSubcategory::class, 'create'])->name('create.subcat');
    Route::get('/Admin/subcategory/manage', [AMasterSubcategory::class, 'manage'])->name('manage.subcat');
    Route::get('/Admin/subcategory/edit/{id}', [AMasterSubcategory::class, 'edit'])->name('edit.subcat');
    Route::post('/Admin/subcategory/store_action', [AMasterSubcategory::class, 'storesubcat'])->name('store.subcat');
    Route::post('/Admin/subcategory/update_action/{id}', [AMasterSubcategory::class, 'updatesubcat'])->name('update.subcat');
    Route::get('/Admin/subcategory/delete_action/{id}', [AMasterSubcategory::class, 'deletesubcat'])->name('delete.subcat');

    /* Product Management */
    Route::get('/Admin/product/create', [AMasterProduct::class, 'create'])->name('create.pro');
    Route::get('/Admin/product/manage', [AMasterProduct::class, 'manage'])->name('manage.pro');
    Route::get('/Admin/product/edit/{id}', [AMasterProduct::class, 'edit'])->name('edit.pro');
    Route::post('/Admin/product/store_action', [AMasterProduct::class, 'storepro'])->name('store.pro');
    Route::post('/Admin/product/update_action/{id}', [AMasterProduct::class, 'updatepro'])->name('update.pro');
    Route::get('/Admin/product/delete_action/{id}', [AMasterProduct::class, 'deletepro'])->name('delete.pro');

    /* Product Image Management */
    Route::get('/Admin/productimage/manage/{id}', [AMasterProductImage::class, 'manage'])->name('manage.proimg');
    Route::get('/Admin/productimage/edit/{id}', [AMasterProductImage::class, 'edit'])->name('edit.proimg');
    Route::post('/Admin/productimage/update_action/{id}', [AMasterProductImage::class, 'updateproimg'])->name('update.proimg');
    Route::get('/Admin/productimage/delete_action/{id}', [AMasterProductImage::class, 'deleteproimg'])->name('delete.proimg');

    /* Product Attribute Management */
    Route::get('/Admin/productattribute/create', [AMasterProductAttribute::class, 'create'])->name('create.proatu');
    Route::get('/Admin/productattribute/manage', [AMasterProductAttribute::class, 'manage'])->name('manage.proatu');
    Route::get('/Admin/productattribute/edit/{id}', [AMasterProductAttribute::class, 'edit'])->name('edit.proatu');
    Route::post('/Admin/productattribute/store_action', [AMasterProductAttribute::class, 'storeproatu'])->name('store.proatu');
    Route::post('/Admin/productattribute/update_action/{id}', [AMasterProductAttribute::class, 'updateproatu'])->name('update.proatu');
    Route::get('/Admin/productattribute/delete_action/{id}', [AMasterProductAttribute::class, 'deleteproatu'])->name('delete.proatu');

    /* Discount Management */
    Route::get('/Admin/discount/create', [AMasterDiscount::class, 'create'])->name('create.dis');
    Route::get('/Admin/discount/manage', [AMasterDiscount::class, 'manage'])->name('manage.dis');
    Route::get('/Admin/discount/edit/{id}', [AMasterDiscount::class, 'edit'])->name('edit.dis');
    Route::post('/Admin/discount/store_action', [AMasterDiscount::class, 'storedis'])->name('store.dis');
    Route::post('/Admin/discount/update_action/{id}', [AMasterDiscount::class, 'updatedis'])->name('update.dis');
    Route::get('/Admin/discount/delete_action/{id}', [AMasterDiscount::class, 'deletedis'])->name('delete.dis');

    /* Slider Management */
    Route::get('/Admin/slider/create', [AMasterSlider::class, 'create'])->name('create.sli');
    Route::get('/Admin/slider/manage', [AMasterSlider::class, 'manage'])->name('manage.sli');
    Route::get('/Admin/slider/edit/{id}', [AMasterSlider::class, 'edit'])->name('edit.sli');
    Route::post('/Admin/slider/store_action', [AMasterSlider::class, 'storesli'])->name('store.sli');
    Route::post('/Admin/slider/update_action/{id}', [AMasterSlider::class, 'updatesli'])->name('update.sli');
    Route::get('/Admin/slider/delete_action/{id}', [AMasterSlider::class, 'deletesli'])->name('delete.sli');

    /* Contact Management */
    Route::get('/Admin/contact/manage', [AMasterContact::class, 'manage'])->name('manage.con');
    Route::get('/Admin/contact/edit/{id}', [AMasterContact::class, 'edit'])->name('edit.con');
    Route::post('/Admin/contact/update_action/{id}', [AMasterContact::class, 'updatecon'])->name('update.con');

    /* Order Management */
    Route::get('/Admin/order/manage', [AMasterOrder::class, 'manage'])->name('manage.ord');
    Route::get('/Admin/order/edit/{id}', [AMasterOrder::class, 'edit'])->name('edit.ord');
    Route::post('/Admin/order/update_action/{id}', [AMasterOrder::class, 'updateord'])->name('update.ord');
    Route::get('/Admin/order/delete_action/{id}', [AMasterOrder::class, 'deleteord'])->name('delete.ord');
    Route::get('/Admin/order/download_invoice/{id}', [UMasterOrder::class, 'download_invoice'])->name('download.ord');

    /* Admin Logout */
    Route::get('/Admin/logout_action', [AMasterHome::class, 'logout_action'])->name('logout.admin');
});
