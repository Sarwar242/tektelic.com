@extends('layout')
@section('metaTitle', $heading->title)
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags($heading->title) ))

@section('content')
        <div class="page-header">
            <div class="container">
                <div class="page-breadcrumbs">
                    {{ Breadcrumbs::render('whitepapers') }}
                </div>
                <div class="page-headings">
                    @if(isset($heading) && !empty($heading->title))
                        <h1 class="page-title">{{$heading->title}}</h1>
                    @else
                        <h1 class="page-title"><?= \App\Models\StaticTextLang::t("Whitepapers",'whitepapers'); ?></h1>
                    @endif
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container">
                <div class="portfolio-list">
                    <div class="portfolio-list-inner">
                        @foreach($pdfs as $pdf)
                            @if(!empty($pdf))
                        <div class="portfolio-list-column">
                            <div class="hover-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                                <div class="hover-box-inner">
                                    <img class="image" src="{{$pdf->image}}" alt="{{$pdf->title}}" title="{{$pdf->title}}">
                                    <a class="hover-box-overlay" href="{{url('whitepaper',['slug' => $pdf->slug])}}">
                                        <div class="hover-box-header">
                                            <h3 class="hover-box-title">{{$pdf->title}}</h3>
                                        </div>
                                        <div class="hover-box-content">
                                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($pdf->short_description), 198, $end='...') }}</p>
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
