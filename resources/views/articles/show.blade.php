@extends('layout')
@section('metaTitle', \Illuminate\Support\Str::limit($post->title, $limit = 55, $end = '...'))
@if(!is_null($post->subtitle))
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags($post->subtitle)))
@else
@section('metaDesc', $post->title)
@endif

@section('content')
<div class="page-navigation">
    <div class="container">
        {{ Breadcrumbs::render('article',$post) }}
    </div>
</div>
<div class="page-body">
    <section class="knowledge-post">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="500" data-aos-delay="50">
                <div class="feature-headings" data-title="{{\App\Helpers\Helper::getBgText($post->bg_text,$post->title)}}">
                    <h1 class="section-title">
                        {{$post->title}}
                    </h1>
                </div>
            </div>
            <div class="section-body">
                <div class="knowledge-post-wrapper">
                    <div class="knowledge-post-aside">
                        <div class="knowledge-base-aside-inner" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="250">
                            <div class="aside-widgets" id="aside-accordion" data-accordion-group>
                                <!-- Topics -->
                                <div class="aside-widget accordion open" data-accordion>
                                    <div class="widget-title trigger-arrow" data-control><strong>Topics</strong></div>
                                    <div class="widget-content" data-content>
                                        <ul class="widget-list">
                                            @foreach($lastArticles as $lastArticle)
                                                <li class="widget-list-item"><a class="widget-list-link" href="{{url('articles',['slug' => $lastArticle->slug])}}">{{$lastArticle->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="knowledge-post-article">
                        <img class="knowledge-post-image" src="{{$post->image}}" alt="{{ $post->alt }}" title="{{ $post->pic_title }}">
                        <date class="knowledge-post-date">
                            {{date('d.m.Y', strtotime($post->date))}}
                        </date>
                        <h2 class="knowledge-post-title">{{$post->subtitle}}</h2>
                        <p><?= $post->content ?></p>
                        @if(!empty($post->tags))
                            <div class="knowledge-post-tags">
                                <i class="knowledge-post-icon">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.9167 0H12.6308C11.6291 0 10.6875 0.39 9.97914 1.09832L0.71082 10.3667C0.2525 10.825 0 11.4342 0 12.085C0 12.7325 0.2525 13.3417 0.71082 13.8L6.2 19.2892C6.65832 19.7475 7.2675 20 7.91832 20C8.56582 20 9.175 19.7475 9.63332 19.2892L18.9016 10.0209C19.61 9.3125 20 8.37082 20 7.36918V2.08332C20 0.935 19.065 0 17.9167 0ZM19.1667 7.36918C19.1667 8.14836 18.8634 8.88086 18.3134 9.43086L9.04418 18.7C8.445 19.2992 7.39418 19.3033 6.79 18.7L1.3 13.21C0.99918 12.91 0.83332 12.51 0.83332 12.0817C0.83332 11.6567 0.999141 11.2567 1.3 10.9559L10.5683 1.6875C11.12 1.13668 11.8516 0.83332 12.6308 0.83332H17.9166C18.6058 0.83332 19.1666 1.39414 19.1666 2.08332V7.36918H19.1667Z" fill="black"/>
                                        <path d="M15.4167 2.5C14.2684 2.5 13.3334 3.435 13.3334 4.58332C13.3334 5.73164 14.2684 6.66664 15.4167 6.66664C16.565 6.66664 17.5 5.73168 17.5 4.58332C17.5 3.435 16.565 2.5 15.4167 2.5ZM15.4167 5.83332C14.7275 5.83332 14.1667 5.2725 14.1667 4.58332C14.1667 3.89414 14.7275 3.33332 15.4167 3.33332C16.1059 3.33332 16.6667 3.89414 16.6667 4.58332C16.6667 5.2725 16.1058 5.83332 15.4167 5.83332Z" fill="black"/>
                                    </svg>
                                </i>

                                @foreach($post->tags as $tag)
                                    <a class="knowledge-post-tag-link" href="{{url('articles?filters=tags['.$tag->id.']|')}}">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!empty($posts))
        <section class="section related-information">
            @include('layouts._parts.news_block',['articles' => $posts,'title'=>'You may also <b>be interested in</b>' ])
        </section>
    @endif
    @if(!empty($products))
        <section class="section popular-products">
            <div class="container">
                <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                    <div class="feature-headings">
                        <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Products, <b>which you may also need</b>",'main'); ?></h2>
                    </div>
                </div>
                <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    @include('layouts._parts.product_block',['products' => $products])
                </div>
                <div class="section-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="150">
                    <a class="view-all" href="{{url('catalog')}}"><span><?= \App\Models\StaticTextLang::t("View all products",'main'); ?></span></a>
                </div>
            </div>
        </section>
    @endif
</div>
@include('layouts.contact-us', ['entity' => $post])
@endsection

@section('footer')

@endsection()
