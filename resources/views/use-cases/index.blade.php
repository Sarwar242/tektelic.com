@extends('layout')
@section('metaTitle', 'Use cases')
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags('Use cases') ))

@section('content')
    <div class="page-header">
        <div class="container">
            {{ Breadcrumbs::render('use-cases') }}
            <div class="page-headings">
                @if(isset($heading) && !empty($heading->title))
                    <h1 class="page-title">TEKTELIC {{$heading->title}}</h1>
                @else
                    <h1 class="page-title">TEKTELIC <?= \App\Models\StaticTextLang::t("Use cases",'use_case'); ?></h1>
                @endif
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
           {{-- @include('layouts._parts.filter_panel',[
               'category_slug' => '',
               'url' => 'use-cases',
           ])--}}
            <div class="use-cases-list">
                @foreach ($use_cases as $use_case)
                <div class="use-cases-column">
                    <div class="hover-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                        <div class="hover-box-inner"><img class="image" src="{{asset(\App\Helpers\Helper::getImgSrc($use_case->useCase->image))}}" alt="{{ $use_case->alt }}" title="{{ $use_case->pic_title }}" />
                            <a class="hover-box-overlay" href="{{url('use-cases',['slug' => $use_case->slug])}}">
                                <div class="hover-box-header">
                                    <h3 class="hover-box-title">{{ $use_case->title }}</h3>
                                </div>
                                <div class="hover-box-content">
                                   {!! $use_case->use_case_text !!}
                                </div>
                                <div class="hover-box-footer"><span class="learn-more-link"><span><?= \App\Models\StaticTextLang::t("Click to learn more",'use_case'); ?></span></span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('layouts.contact-us', ['entity' => $seo_block])
@endsection

@section('footer')

@endsection()
