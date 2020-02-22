<?php

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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){
	Route::get('/', 'CartController@index')->name('index');
	Route::post('add', 'CartController@add')->name('add');

	Route::get('remove/{slug}', 'CartController@remove')->name('remove');
	Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
	Route::get('/', 'CheckoutController@index')->name('index');
	Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
	Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');

	Route::post('/notification', 'CheckoutController@notification')->name('notification');
});

Route::get('my-orders', 'UserOrderController@index')->name('user.orders')->middleware('auth');

Route::group(['middleware' => ['auth', 'access.control.store.admin']], function(){

	Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){

		Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
		Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
		Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');

//	Route::prefix('stores')->name('stores.')->group(function(){
//
//		Route::get('/', 'StoreController@index')->name('index');
//		Route::get('/create', 'StoreController@create')->name('create');
//		Route::post('/store', 'StoreController@store')->name('store');
//		Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
//		Route::post('/update/{store}', 'StoreController@update')->name('update');
//		Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
//
//	});
		Route::resource('stores', 'StoreController');
		Route::resource('products', 'ProductController');
		Route::resource('categories', 'CategoryController');

		Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');

		Route::get('orders/my', 'OrdersController@index')->name('orders.my');
	});

});

Auth::routes();





//Route::get('/home', 'HomeController@index')->name('home');//->middleware('auth');

Route::get('/model', function(){
	//$products = \App\Product::all(); //select * from products

//  $user = new \App\User();
//	$user = \App\User::find(1);
//	$user->name = 'Usuário Teste Editado...';

//	$user->save();
//	return
	//\App\User::all() - retorna todos os usuários
	//\App\User::find(3) - retorna o usuário com base no id
	//\App\User::where('name', 'Christelle Stiedemann')->first()// select * from users where name = 'Christelle Stiedemann'
	//\App\User::paginate(10); - paginar dados com laravel

	//Mass Assignment - Atribuição em Massa
//
//	$user = \App\User::create([
//		'name' => 'Nanderson Castro',
//		'email' => 'email100@email.com',
//		'password' => bcrypt('123345566')
//	]);

	//Mass Update
//	$user = \App\User::find(42);
//	$user->update([
//		'name' => 'Atualizando com Mass Update'
//	]); //true ou false

	//Como eu faria para pegar a loja de um usuário
	//$user = \App\User::find(4);

	//dd($user->store()->count()); //O objeto único (Store) se for Collection de Dados(Objetos)

	//Pegar os produtos de uma loja?
//	$loja = \App\Store::find(1);
	//return $loja->products; | $loja->products()->where('id', 9)->get();

	//Pegar as lojas de uma categoria de uma loja?
//	$categoria = \App\Category::find(1);
//	$categoria->products;

	//Criar uma loja para um usuário
//	$user = \App\User::find(10);
//	$store = $user->store()->create([
//		'name' => 'Loja Teste',
//		'description' => 'Loja Teste de produtos de informática',
//		'mobile_phone' => 'XX-XXXXX-XXXX',
//		'phone' => 'XX-XXXXX-XXXX',
//		'slug'  => 'loja-teste'
//	]);

	//Criar um produto para uma loja
//	$store = \App\Store::find(41);
//	$product = $store->products()->create([
//		'name' => 'Notebook Dell',
//		'description' => 'CORE I5 10GB',
//		'body' => 'Qualquer coisa...',
//		'price' => 2999.90,
//		'slug' => 'notebook-dell',
//	]);
//
//	dd($product);

	//Criar uma categoria

//	\App\Category::create([
//		'name' => 'Games',
//		'slug' => 'games'
//	]);
//
//	\App\Category::create([
//		'name' => 'Notebooks',
//		'slug' => 'notebooks'
//	]);
//
//	return \App\Category::all();

	//Adicionar um produto para uma categoria ou vice-versa

//	$product = \App\Product::find(49);
//
//	dd($product->categories()->sync([2]));

	$product = \App\Product::find(49);

	return $product->categories;
});


Route::get('not', function(){

	//$user = \App\User::find(41);
	//$user->notify(new \App\Notifications\StoreReceiveNewOrder());

//	$notification = $user->unreadNotifications->first();
//	$notification->markAsRead();

	//return $user->readNotifications->count();
});