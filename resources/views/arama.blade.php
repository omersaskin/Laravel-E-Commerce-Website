@extends('layouts.master')
@section('title', 'Arama')
@section('content')
    <div class="container">
        <ol compact="breadcrumb">
            <li><a href="{{ route('anasayfa') }}">Anasayfa</a></li>
            <li class="active">Arama Sonucu</li>
        </ol>
    </div>

    <div class="container products bg-content">
        <div class="row">
            @if(count($urunler)==0)
                <div class="col-md-12 text-align-center">
                    Bir ürün bulunamadı!
                </div>
            @endif
            @foreach($urunler as $urun)
                <div class="col-md-3 product">
                    <a href="{{ route('urun', $urun->slug) }}">
                        <img src="{{ asset('img/unnamed.jpg') }}" alt="{{ $urun->urun_adi }}">
                    </a> 
                    <p>
                        <a href="{{ route('urun', $urun->slug) }}">
                            {{ $urun->urun_adi }}
                        </a> 
                    </p>
                    <p>{{ $urun->fiyati }}</p>
                </div>
            @endforeach
        </div>
        {{ $urunler->appends(['aranan' => old('aranan')])->links() }}
    </div>
@endsection