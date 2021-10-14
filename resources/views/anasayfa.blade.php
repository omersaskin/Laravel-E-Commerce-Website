@extends('layouts.master')
@section('title', 'Anasayfa')
@section('content')
    @include('layouts.partials.alert')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="list-group categories">
                        @foreach($kategoriler as $kategori)
                        <a href="{{ route('kategori', $kategori->slug) }}" class="list-group-item"><i class="fa fa-arrow-circle-right"></i> 
                            {{ $kategori->kategori_adi }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for($i=0; $i<count($urunler_slider); $i++)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($urunler_slider as $index => $urun)
                        <div class="item {{ $index == 0 ? 'active' : '' }}">
                            <img style="width: 100%;" src="{{ asset('img/unnamed.jpg') }}" alt="...">
                            <div class="carousel-caption">
                                {{ $urun->urun_adi }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default" id="sidebar-product">
                    <div class="panel-heading">Günün Fırsatı</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 product col-12">
                            <a href="{{ route('urun', $urun_gunun_firsati->slug) }}">
                            <img style="width: 100%; height: auto;border-radius: 5px;" src="{{ asset('img/unnamed.jpg') }}" class="img-responsive">
                            </a>
                            
                                <p style="text-align: center;margin-top: 5px;">
                                    <a href="{{ route('urun', $urun_gunun_firsati->slug) }}">{{ $urun_gunun_firsati->urun_adi }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Öne Çıkan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($urunler_one_cikan as $urun)
                        <div class="col-md-3 product">
                            <a href="{{ route('urun', $urun->slug) }}"><img src="{{ asset('img/unnamed.jpg') }}"></a>
                            <p><a href="{{ route('urun', $urun->slug) }}">{{ $urun->urun_adi }}</a></p>
                            <p class="price">{{ $urun->fiyati }} ₺</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">Çok Satan Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($urunler_cok_satan as $urun)
                        <div class="col-md-3 product">
                            <a href="{{ route('urun', $urun->slug) }}"><img src="{{ asset('img/unnamed.jpg') }}"></a>
                            <p><a href="{{ route('urun', $urun->slug) }}">{{ $urun->urun_adi }}</a></p>
                            <p class="price">{{ $urun->fiyati }} ₺</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <div class="panel panel-theme">
                <div class="panel-heading">İndirimli Ürünler</div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($urunler_indirimli as $urun)
                        <div class="col-md-3 product">
                            <a href="{{ route('urun', $urun->slug) }}"><img src="{{ asset('img/unnamed.jpg') }}"></a>
                            <p><a href="{{ route('urun', $urun->slug) }}">{{ $urun->urun_adi }}</a></p>
                            <p class="price">{{ $urun->fiyati }} ₺</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection