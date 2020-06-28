<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * FRONT-SITE route...
 */
Route::namespace('Site')->name('site.')->group(function () {
    Route::get('/', 'SiteController@index')->name('index');
    // Brand Wise Product Founding Route...
    Route::get('brand/{slug}', 'SiteController@brandWiseProduct')->name('brand');
    // Category Wise Product Founding Route...
    Route::get('category/{slug}', 'SiteController@catWiseProduct')->name('category');
    // Sub Category Wise Product Founding Route...
    Route::get('sub-category/{slug}', 'SiteController@subCatWiseProduct')->name('sub-category');
    // Single product Detail Route...
    Route::get('product-detail/{slug}', 'SiteController@productDetail')->name('product-detail');
    // Fetch Sub Category Grid style product using Ajax Route...
    Route::post('load-subcat-product', 'SiteController@loadSubCatProduct')->name('load-subcat-product');
    // Fetch Sub Category List style product using Ajax Route...
    Route::post('load-subcat-list-product', 'SiteController@loadSubCatListProduct')->name('load-subcat-list-product');
    // Shopping Cart Item CRUD route...
    Route::group(['prefix'=>'cart', 'namespace'=>'Cart', 'as'=>'cart.'], function () {
        Route::get('show', 'CartController@index')->name('show');
        Route::post('add', 'CartController@addCart')->name('add');
        Route::post('add-single-product-cart', 'CartController@addSingleProductCart')->name('add-single-product-cart');
        Route::post('delete', 'CartController@deleteCart')->name('delete');
        Route::post('update', 'CartController@updateCart')->name('update');
//        Route::post('update-grand-totel-price', 'CartController@updateGrandTotalPrice');
    });

    // CHECKOUT show route...
//    Route::get('checkout/login', 'Checkout\CheckoutController@checkoutLogin')->name('checkout.login');
//    Route::post('checkout/login', 'Checkout\CheckoutController@processLogin')->name('checkout.login');
//    Route::get('checkout/register', 'Checkout\CheckoutController@checkoutRegister')->name('checkout.register');
//    Route::post('checkout/register', 'Checkout\CheckoutController@processRegister')->name('checkout.register');
//    Route::get('checkout/account/verify', 'Checkout\CheckoutController@checkoutCustomerAccountVerify')->name('checkout.account.verify');
//    Route::post('checkout/account/verify', 'Checkout\CheckoutController@processCheckoutCustomerAccountVerify')->name('checkout.account.verify');
    Route::get('checkout/shipping', 'Checkout\CheckoutController@checkoutCustomerShipping')->name('checkout.customer-shipping');
    Route::post('checkout/shipping', 'Checkout\CheckoutController@checkoutCustomerShippingInfo')->name('checkout.customer-shipping.info');
    Route::get('checkout/payment', 'Checkout\CheckoutController@checkoutCustomerPayment')->name('checkout.customer-payment');
    Route::post('checkout/order', 'Checkout\CheckoutController@checkoutCustomerOrder')->name('checkout.customer-order');

    //CUSTOMER/VISITOR LOGIN-REGISTER show route...
    Route::get('customer/login', 'Customer\CustomerController@customerLogin')->name('customer.login');
    Route::post('customer/login', 'Customer\CustomerController@processLogin')->name('customer.login');
    Route::get('customer/register', 'Customer\CustomerController@customerRegister')->name('customer.register');
    Route::post('customer/register', 'Customer\CustomerController@processRegister')->name('customer.register');
    Route::get('customer-account-verify', 'Customer\CustomerController@customerAccountVerify')->name('customer.account.verify');
    Route::post('check-account-verify', 'Customer\CustomerController@checkAccountVerify')->name('check.account.verify');
    Route::get('customer/account/{customer_id}', 'Customer\CustomerController@customerAccount')->name('customer.account');
    Route::post('customer/logout', 'Customer\CustomerController@processLogout')->name('customer.logout');

    // SEARCH FUNCTION PRODUCT show route...
    Route::post('search/products', 'SiteController@searchProducts')->name('search.products');

    // CONTACT US Content show route...
    Route::get('contact-us', 'SiteController@contactUs')->name('contact-us');
    Route::post('contact-us/send-mail', 'SiteController@sendMail')->name('contact-us.send-mail');
    // NEWSLETTER-SUBSCRIBER show route...
    Route::post('check-subscriber','Newsletter\NewsletterSubscriberController@checkSubscriber');
    Route::post('add-subscriber','Newsletter\NewsletterSubscriberController@addSubscriber');

    // Sending mail Just For Testing purpose route...
    Route::get('send-mail', function () {
        $mail_detail = [
            'title' => 'Mail Title: Mail Title',
            'subject' => 'Subject: Write to Mail Subject',
            'message' => 'Message: Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid amet animi asperiores, at cum eaque eligendi eos ipsa laborum nam obcaecati odio pariatur quas ratione sunt. Ex in praesentium qui.',
        ];
        \Illuminate\Support\Facades\Mail::to("test@gmail.com")->send(new \App\Mail\ContactUsMail($mail_detail));
    });

    // FAQ Content show route...
    Route::get('faq', 'SiteController@faq')->name('faq');
    // Help Center Content show route...
    Route::get('terms-condition', 'SiteController@termsCondition')->name('terms-condition');

});


/**
 * PRACTICE and TESTING route define...
 */
Route::get('fetch-cat-data', 'Practice\PracticeTestController@fatchCatData')->name('fetch-cat-data');
Route::post('fetch-cat-data', 'Practice\PracticeTestController@loadCatData')->name('fetch-cat-data');

/**
 * DEFAULT AUTHENTICATE route...
 */
Auth::routes();

/**
 * NORMAL ADMIN AUTHENTICATE LOGIN WITH SECTION WISE AUTHORIZED route...
 */
Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    /**
     * NORMAL ADMIN DASHBOARD route...
     */
    Route::get('dashboard', 'AdminController@admin')->name('home');

    /**
     * NORMAL ADMIN BRAND route...
     */
    Route::prefix('brands')->namespace('Brand')->name('brand.')->group(function () {
        Route::get('/', 'BrandController@index')->name('index');
        Route::get('show', 'BrandController@show')->name('show');
        Route::post('store/{id}', 'BrandController@store')->name('store');
        Route::get('create', 'BrandController@create')->name('create');
    });

    /**
     * NORMAL ADMIN CATEGORY route...
     */
    Route::prefix('categories')->namespace('Category')->name('category.')->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('show', 'CategoryController@show')->name('show');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::post('store/{user_id}', 'CategoryController@store')->name('store');
    });

    /**
     * NORMAL ADMIN SUB-CATEGORY route...
     */
    Route::prefix('sub-categories')->namespace('Category')->name('sub-category.')->group(function () {
        Route::get('/', 'SubCategoryController@index')->name('index');
        Route::get('show', 'SubCategoryController@show')->name('show');
        Route::get('create', 'SubCategoryController@create')->name('create');
        Route::post('store/{user_id}', 'SubCategoryController@store')->name('store');
    });

    /**
     * NORMAL ADMIN SLIDER route...
     */
    Route::prefix('sliders')->namespace('Slider')->name('slider.')->group(function () {
        Route::get('/', 'SliderController@index')->name('index');
        Route::get('show', 'SliderController@show')->name('show');
        Route::get('create', 'SliderController@create')->name('create');
        Route::post('store/{user_id}', 'SliderController@store')->name('store');
    });

    /**
     * NORMAL ADMIN PRODUCTS route...
     */
    Route::prefix('products')->namespace('Product')->name('product.')->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('show', 'ProductController@show')->name('show');
        Route::get('create', 'ProductController@create')->name('create');
        Route::post('store/{user_id}', 'ProductController@store')->name('store');
    });

    /**
     * NORMAL ADMIN ORDERS route...
     */
    Route::prefix('orders')->namespace('Order')->name('order.')->group(function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::get('show', 'OrderController@show')->name('show');

    });

    /**
     * NORMAL ADMIN CONTACT US route...
     */
    Route::prefix('contacts')->namespace('ContactUs')->name('contact.')->group(function () {
        Route::get('/', 'ContactUsController@index')->name('index');
        Route::get('show', 'ContactUsController@show')->name('show');

    });
});

/**
 * SUPER ADMIN AUTHENTICATE LOGIN WITH SECTION WISE AUTHORIZED route...
 */
Route::middleware('auth', 'is_admin')->prefix('super-admin')->namespace('Admin')->name('super-admin.')->group(function () {
    /**
     * SUPER ADMIN DASHBOARD route...
     */
    Route::get('dashboard', 'AdminController@index')->name('home');

    /**
     * SUPER ADMIN BRAND route...
     */
    Route::prefix('brands')->namespace('Brand')->name('brand.')->group(function () {
        Route::get('/', 'BrandController@index')->name('index');
        Route::get('show', 'BrandController@show')->name('show');
        Route::get('create', 'BrandController@create')->name('create');
        Route::post('store/{user_id}', 'BrandController@store')->name('store');
        Route::delete('delete/{brand_id}', 'BrandController@destroy')->name('delete');
        Route::get('edit/{brand_id}', 'BrandController@edit')->name('edit');
        Route::put('update/{brand_id}', 'BrandController@update')->name('update');
        Route::get('status/{brand_id}/{brand_status}', 'BrandController@updateStatus')->name('status');
    });

    /**
     * SUPER ADMIN CATEGORY route...
     */
    Route::prefix('categories')->namespace('Category')->name('category.')->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('show', 'CategoryController@show')->name('show');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::post('store/{user_id}', 'CategoryController@store')->name('store');
        Route::delete('delete/{category_id}', 'CategoryController@destroy')->name('delete');
        Route::get('edit/{category_id}', 'CategoryController@edit')->name('edit');
        Route::put('update/{category_id}/{user_id}', 'CategoryController@update')->name('update');
        Route::get('status/{category_id}/{category_status}', 'CategoryController@updateStatus')->name('status');
    });

    /**
     * SUPER ADMIN SUB-CATEGORY route...
     */
    Route::prefix('sub-categories')->namespace('Category')->name('sub-category.')->group(function () {
        Route::get('/', 'SubCategoryController@index')->name('index');
        Route::get('show', 'SubCategoryController@show')->name('show');
        Route::get('create', 'SubCategoryController@create')->name('create');
        Route::post('store/{user_id}', 'SubCategoryController@store')->name('store');
        Route::delete('delete/{sub_category_id}', 'SubCategoryController@destroy')->name('delete');
        Route::get('edit/{sub_category_id}', 'SubCategoryController@edit')->name('edit');
        Route::put('update/{sub_category_id}/{user_id}', 'SubCategoryController@update')->name('update');
        Route::get('status/{sub_category_id}/{sub_category_status}', 'SubCategoryController@updateStatus')->name('status');
    });

    /**
     * SUPER ADMIN SLIDER route...
     */
    Route::prefix('sliders')->namespace('Slider')->name('slider.')->group(function () {
        Route::get('/', 'SliderController@index')->name('index');
        Route::get('show', 'SliderController@show')->name('show');
        Route::get('create', 'SliderController@create')->name('create');
        Route::post('store/{user_id}', 'SliderController@store')->name('store');
        Route::delete('delete/{slider_id}', 'SliderController@destroy')->name('delete');
        Route::get('edit/{slider_id}', 'SliderController@edit')->name('edit');
        Route::put('update/{slider_id}/{user_id}', 'SliderController@update')->name('update');
        Route::get('status/{slider_id}/{slider_status}', 'SliderController@updateStatus')->name('status');
    });

    /**
     * SUPER ADMIN PRODUCTS route...
     */
    Route::prefix('products')->namespace('Product')->name('product.')->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('show', 'ProductController@show')->name('show');
        Route::get('create', 'ProductController@create')->name('create');
        Route::post('store/{user_id}', 'ProductController@store')->name('store');
        Route::delete('delete/{product_id}', 'ProductController@destroy')->name('delete');
        Route::get('edit/{product_id}', 'ProductController@edit')->name('edit');
        Route::put('update/{product_id}/{user_id}', 'ProductController@update')->name('update');
        Route::get('status/{product_id}/{product_status}', 'ProductController@updateStatus')->name('status');
        Route::get('find-cat-wise-subcat/{cat_id}', 'ProductController@findCatWiseSubCat');
        Route::get('update-original-price/{id}/{price}', 'ProductController@updateOriginalPrice');
        Route::post('update-sales-price', 'ProductController@updateSalesPrice');
        Route::get('update-special-price/{id}/{price}', 'ProductController@updateSpecialPrice');
        Route::get('update-offer-price/{id}/{price}', 'ProductController@updateOfferPrice');
    });

    /**
     * SUPER ADMIN ORDERS route...
     */
    Route::prefix('orders')->namespace('Order')->name('order.')->group(function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::get('show/{order_id}', 'OrderController@show')->name('show');
        Route::get('edit/{order_id}', 'OrderController@edit')->name('edit');
        Route::post('update', 'OrderController@update')->name('update');
        Route::delete('delete/{order_id}', 'OrderController@destroy')->name('delete');
        Route::get('payment/status/{payment_id}/{payment_status}', 'OrderController@updatePaymentStatus')->name('payment.status');
        Route::post('order-status-update', 'OrderController@orderStatusUpdate')->name('order-status-update');
        Route::post('payment-status-update', 'OrderController@paymentStatusUpdate')->name('payment-status-update');
        Route::post('shipping-charge-update', 'OrderController@shippingChargeUpdate')->name('shipping-charge-update');
        Route::post('order-info-mail', 'OrderController@orderInfoMail')->name('order-info-mail');
        Route::get('order-invoice/{order_id}', 'OrderController@orderInvoice')->name('order-invoice');
        Route::get('order-invoice-print/{order_id}', 'OrderController@orderInvoicePrint')->name('order-invoice-print');

    });

    /**
     * SUPER ADMIN CONTACT US route...
     */
    Route::prefix('contacts')->namespace('ContactUs')->name('contact.')->group(function () {
        Route::get('/', 'ContactUsController@index')->name('index');
        Route::get('show/{contact_id}', 'ContactUsController@show')->name('show');
        Route::delete('delete/{contact_id}', 'ContactUsController@destroy')->name('delete');
        Route::get('edit/{contact_id}', 'ContactUsController@edit')->name('edit');
        Route::put('update/{contact_id}', 'ContactUsController@update')->name('update');
        Route::get('status/{contact_id}/{contact_status}', 'ContactUsController@updateStatus')->name('status');

    });

    /**
     * SUPER ADMIN SIDE CUSTOMER show route...
     */
    Route::prefix('customers')->namespace('Customer')->name('customer.')->group(function () {
        Route::get('/', 'CustomerController@index')->name('index');
        Route::get('show/{customer_id}', 'CustomerController@show')->name('show');
        Route::delete('delete/{customer_id}', 'CustomerController@destroy')->name('delete');
        Route::get('edit/{customer_id}', 'CustomerController@edit')->name('edit');
        Route::put('update/{customer_id}', 'CustomerController@update')->name('update');
        Route::get('status/{customer_id}/{customer_status}', 'CustomerController@updateStatus')->name('status');

    });

    /**
     * SUPER ADMIN SIDE NEWSLETTER SUBSCRIBER show route...
     */
    Route::prefix('subscribers')->namespace('Subscriber')->name('subscriber.')->group(function () {
        Route::get('/', 'SubscriberController@index')->name('index');
        Route::get('show/{subscriber_id}', 'SubscriberController@show')->name('show');
        Route::delete('delete/{subscriber_id}', 'SubscriberController@destroy')->name('delete');
        Route::get('edit/{subscriber_id}', 'SubscriberController@edit')->name('edit');
        Route::put('update/{subscriber_id}', 'SubscriberController@update')->name('update');
        Route::get('status/{subscriber_id}/{subscriber_status}', 'SubscriberController@updateStatus')->name('status');

    });



});
