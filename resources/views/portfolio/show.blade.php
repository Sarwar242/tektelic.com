@extends('layout')
@section('metaTitle', \Illuminate\Support\Str::limit($portfolio->title, $limit = 47, $end = '..'))
@if(!is_null($portfolio->subtitle))
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags($portfolio->sub_title)))
@else
@section('metaDesc', $portfolio->title)
@endif
@section('content')
<div class="page-navigation">
    <div class="container">
        {{ Breadcrumbs::render('portfolio',$portfolio) }}
    </div>
</div>
<div class="page-body">
    <section class="section project-post">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="500" data-aos-delay="50">
                <div class="feature-headings" data-title="{{\App\Helpers\Helper::getBgText($portfolio->bg_text,$portfolio->title)}}">
                    <h1 class="section-title">{{$portfolio->title}}</h1>
                </div>
            </div>
            <div class="section-body">
                <div class="project-post-article">
                    <div class="project-post-figure" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <div class="project-post-image">
                            <img src="{{asset(\App\Helpers\Helper::getImgSrc($portfolio->portfolio->image))}}" alt="{{ $portfolio->alt }}" title="{{ $portfolio->pic_title }}">
                        </div>
                        <div class="project-post-info">
                            <h2 class="project-post-heading">{!! $portfolio->sub_title !!}</h2>
                            {!! $portfolio->text !!}
                        </div>
                    </div>
                    <div class="project-post-content" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                        {!! $portfolio->text2 !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php if(!empty($products[0])){ ?>
    <section class="section popular-products">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <div class="feature-headings">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Products, <b>related to this use case</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
                @include('layouts._parts.product_block',['products' => $products])
            </div>
            <div class="section-footer" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <a class="view-all" href="{{url('catalog')}}"><span><?= \App\Models\StaticTextLang::t("View all products",'main'); ?></span></a>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if(!empty($portfolios[0])){ ?>
    <section class="section projects-portfolio">
        <div class="container">
            <div class="section-header">
                <div class="feature-headings">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Other <b>Projects portfolio</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body">
                @include('layouts._parts.portfolio_block',['portflios' => $portfolios])
            </div>
            <div class="section-footer">
                <a class="view-all" href="<?= url('projects-portfolio') ?>"><?= \App\Models\StaticTextLang::t("View all projects",'main'); ?></a>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if(!empty($articles[0])){ ?>
    <section class="section related-news">
        @include('layouts._parts.news_block',['articles' => $articles,'title'=> \App\Models\StaticTextLang::t("<b>News</b>",'main') ])
    </section>
    <?php } ?>
</div>

@include('layouts.contact-us', ['entity' => $portfolio])

@endsection

@section('footer')

@endsection()
