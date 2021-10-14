<?php

Route::get('/', 'AnasayfaController@index')->name('anasayfa');

Route::get('/kategori/{slug_kategoriadi}', 'KategoriController@index')->name('kategori');

Route::get('/urun/{slug_urunadi}', 'UrunController@index')->name('urun');

Route::post('/ara', 'UrunController@ara')->name('urun_ara');
Route::get('/ara', 'UrunController@ara')->name('urun_ara');

Route::group(['prefix'=>'sepet'], function() {
	Route::get('/', 'SepetController@index')->name('sepet');
	Route::post('/ekle', 'SepetController@ekle')->name('sepet.ekle');
	Route::delete('/kaldir/{rowid}', 'SepetController@kaldir')->name('sepet.kaldir');
	Route::delete('/bosalt', 'SepetController@bosalt')->name('sepet.bosalt');
	Route::patch('/guncelle/{rowid}', 'SepetController@guncelle')->name('sepet.guncelle');
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/odeme', 'OdemeController@index')->name('odeme');
	Route::get('/siparisler', 'SiparisController@index')->name('siparisler');
	Route::get('/siparisler/{id}', 'SiparisController@detay')->name('siparis');
});

Route::group(['prefix'=>'kullanici'], function() {
	Route::get('/oturumac', 'KullaniciController@giris_form')->name('kullanici.oturumac');
	Route::post('/oturumac', 'KullaniciController@giris');
	Route::get('/kaydol', 'KullaniciController@kaydol_form')->name('kullanici.kaydol');	
	Route::post('/kaydol', 'KullaniciController@kaydol');	
	Route::get('/aktiflestir/{anahtar}', 'KullaniciController@aktiflestir')->name('aktiflestir');
	Route::post('/oturumukapat', 'KullaniciController@oturumukapat')->name('kullanici.oturumukapat');
});

/*

//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

*/