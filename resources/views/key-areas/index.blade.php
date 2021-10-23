@extends('layout')
@section('metaTitle', 'Key areas')
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags('TEKTELIC is a premier provider of Best-in-Class IoT Gateways and Devices. Utilizing the LoRaWAN® technology, TEKTELIC prides itself on building hardware designed for Carrier-Grade performance, reliability, scalability.') ))

@section('content')
    <div class="page-header">
        <div class="container">
            {{ Breadcrumbs::render('key-areas') }}
            <div class="page-headings">
                @if(isset($heading) && !empty($heading->title))
                    <h1 class="page-title">{{$heading->title}}</h1>
                @else
                    <h1 class="page-title"><?= \App\Models\StaticTextLang::t("Key areas",'key_area'); ?></h1>
                @endif
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <div class="keyareas-list">
                @foreach ($key_areas as $key_area)
                    <div class="keyareas-list-item" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
                        <article class="keyarea-card-article">
                            <a class="keyarea-card-image" href="{{url('key-areas',['slug' => $key_area->slug])}}">
                                <svg class="keyarea-card-placeholder" width="340" height="207" viewBox="0 0 340 207" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="340" height="207" fill="none"/>
                                </svg>
                                <img class="image" src="{{asset(\App\Helpers\Helper::getImgSrc($key_area->keyArea->image))}}" alt="{{ $key_area->alt }}" title="{{ $key_area->pic_title }}"/>
                            </a>
                            <div class="keyarea-card-content">
                                <a class="keyarea-card-inner" href="{{url('key-areas',['slug' => $key_area->slug])}}">
                                    <h2 class="keyarea-card-title">{{ $key_area->title }}</h2>
                                    <div class="keyarea-card-excerpt">{!! \Illuminate\Support\Str::limit(strip_tags($key_area->text), 230, $end='') !!}</div>
                                    <span class="learn-more-link"><span><?= \App\Models\StaticTextLang::t("Click to learn more",'key_area'); ?></span></span>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.contact-us', ['entity' => $seo_block])
@endsection

@section('footer')

@endsection()
