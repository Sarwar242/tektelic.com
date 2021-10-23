@extends('layout')
@section('metaTitle', (isset($category_slug) && !empty($category_slug) ? $category_slug : 'Projects portfolio'))
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags('Projects portfolio') ))

@section('content')
        <div class="page-header">
            <div class="container">
                <div class="page-breadcrumbs">
                    {{ Breadcrumbs::render('portfolios') }}
                </div>
                <div class="page-headings">
                    @if(isset($heading) && !empty($heading->title))
                        <h1 class="page-title">{{$heading->title}}</h1>
                    @else
                        <h1 class="page-title"><?= \App\Models\StaticTextLang::t("Projects portfolio",'portfolio'); ?></h1>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container">
                @include('layouts._parts.filter_panel',['categories' => $categories,'category_slug' => $category_slug,'url' => 'projects-portfolio'])
                <div class="portfolio-list">
                    <div class="portfolio-list-inner">
                        @foreach ($portflios as $portflio)
                            @if(!empty($portflio->portfolio))
                        <div class="portfolio-list-column">
                            <div class="hover-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                                <div class="hover-box-inner"><img class="image" src="{{asset(\App\Helpers\Helper::getImgSrc($portflio->portfolio->image) )}}" alt="{{ $portflio->alt }}" title="{{ $portflio->pic_title }}">
                                    <a class="hover-box-overlay" href="{{url('projects-portfolio',['slug' => $portflio->slug])}}">
                                        <div class="hover-box-header">
                                            <h3 class="hover-box-title">{{ $portflio->title }}</h3>
                                        </div>
                                        <div class="hover-box-content">
                                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($portflio->text), 198, $end='') }}</p>
                                        </div>
                                        <div class="hover-box-footer">
                                            <span class="learn-more-link">
                                                <span><?= \App\Models\StaticTextLang::t("Click to learn more",'portfolio'); ?></span>
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.contact-us', ['entity' => $seo_block])

@endsection

@section('footer')

@endsection()
