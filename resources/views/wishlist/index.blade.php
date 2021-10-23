@extends('layout')
@section('metaTitle', 'Wishlist')
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags('Wishlist') ))

@section('content')
    <div class="page-body">
        <section class="section wishlist">
            <div class="container">
                <div class="section-header" data-aos="fade-in" data-aos-duration="500" data-aos-delay="50">
                    <div class="feature-headings" data-title="><?= \App\Models\StaticTextLang::t("Wishlist",'wishlist'); ?>">
                        <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Wishlist",'wishlist'); ?></h2>
                    </div>
                </div>
                <div class="section-body">
                    <div class="wishlist-wraper show-wishlist-ajax">
                        @include('wishlist.partials.product-items',['wishlists'=>$wishlists])
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('layouts.contact-us', ['entity' => $seo_block])


@endsection

@section('footer')

@endsection()
