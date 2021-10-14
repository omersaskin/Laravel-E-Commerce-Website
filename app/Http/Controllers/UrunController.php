<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urun;

class UrunController extends Controller
{
   public function index($slug_urunadi) {
        $urun=Urun::whereSlug($slug_urunadi)->firstOrFail();
    	return view('urun', compact('urun'));
    }

    public function ara() {
    	 $aranan=request()->input('aranan');
    	 $urunler=Urun::where('urun_adi', 'like', "%$aranan%")
    	 ->orWhere('aciklama', 'like', "%$aranan%")
    	 ->paginate(8);
    	 request()->flash();
    	 return view('arama', compact('urunler'));
    }
}
