<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "kullanici";
    protected $fillable = ['adsoyad', 'email', 'sifre', 'aktivasyon_anahtari', 'aktif_mi'];
    protected $hidden = ['sifre', 'aktivasyon_anahtari'];

    public function getAuthPassword() {
    	return $this->sifre;
    }

}