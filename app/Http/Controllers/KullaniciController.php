<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Mail\KullaniciKayitMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Sepet;
use App\Models\SepetUrun;
use Cart;

class KullaniciController extends Controller
{

    public function __construct() {
        $this->middleware('guest')->except('oturumukapat');
    }

    public function giris_form() {
    	return view('kullanici.oturumac');
    }

    public function giris() {
        $this->validate(Request(), [
            'email' => 'required|email',
            'sifre' => 'required'
        ]);

        if (auth()->attempt(['email'=>Request('email'), 'password'=>Request('sifre')], Request()->has('benihatirla'))) {
            Request()->session()->regenerate();

            $aktif_sepet_id=Sepet::firstOrCreate(['kullanici_id'=>auth()->id()])->id;
            session()->put('aktif_sepet_id', $aktif_sepet_id);

            if (Cart::count()>0) {
                foreach (Cart::content() as $cartItem) {
                    SepetUrun::updateOrCreate(
                        ['sepet_id'=>$aktif_sepet_id, 'urun_id'=>$cartItem->id],
                        ['adet'=>$cartItem->qty, 'fiyati'=>$cartItem->price, 'durum'=>'Beklemede']
                    );
                }
            }

            Cart::destroy();
            $sepetUrunler=SepetUrun::where('sepet_id', $aktif_sepet_id)->get();
            foreach ($sepetUrunler as $sepetUrun) {
                Cart::add($sepetUrun->urun->id, $sepetUrun->urun->urun_adi, $sepetUrun->adet, $sepetUrun->fiyati, ['slug'=>$sepetUrun->urun->slug]);
            }

            return redirect()->intended('/');
        } else {
            $errors=['email'=>'Hatalı Giriş'];
            return back()->withErrors($errors);
        }
    }

    public function kaydol_form() {
    	return view('kullanici.kaydol');
    }

    public function kaydol() {

        $this->validate(Request(), [
            'adsoyad' => 'required|min:5|max:60',
            'email' => 'required|email|unique:kullanici',
            'sifre' => 'required|confirmed|min:5|max:15'
        ]);

    	$user= User::create([
    		'adsoyad' => Request('adsoyad'),
    		'email' => Request('email'),
    		'sifre' => Hash::make(Request('sifre')),
    		'aktivasyon_anahtari' => Str::random(60),
    		'aktif_mi' => 0
    	]);

        Mail::to(Request('email'))->send(new KullaniciKayitMail($user));

    	auth()->login($user);

    	return redirect()->route('anasayfa');
    }

    public function aktiflestir($anahtar) {
        $user=User::where('aktivasyon_anahtari', $anahtar)->first();
        if (!is_null($user)) {
            $user->aktivasyon_anahtari=null;
            $user->aktif_mi=1;
            $user->save();
            return redirect()->to('/')
            ->with('mesaj', 'Kullanıcı kaydınız aktifleştirildi!')
            ->with('mesaj_tur', 'success');
        } else {
            return redirect()->to('/') 
            ->with('mesaj', 'Kullanıcı kaydınız aktifleştirilemedi.')
            ->with('mesaj_tur', 'warning');
            }
        }

        public function oturumukapat() {
            auth()->logout();
            Request()->session()->flush();
            Request()->session()->regenerate();
            return redirect()->route('anasayfa');
        }

    }