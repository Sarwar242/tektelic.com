@extends('layout')
@section('metaTitle', $distributor->title)
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags($distributor->sub_title) ))

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="page-breadcrumbs">
                <ul class="breadcrumbs-navigation">
                    {{ Breadcrumbs::render('distributors') }}
                </ul>
            </div>
            <div class="page-headings">
                <h2 class="page-title">{{$distributor->title}}</h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <article class="distributors-post">
                <div class="distributors-post-content">
                    <h2 class="distributors-post-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">{!! $distributor->sub_title !!}</h2>
                    <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">{!! $distributor->text !!}</p>
                </div>
                <div class="distributors-post-image"><img class="image" src="{{asset(\App\Helpers\Helper::getImgSrc($distributor->page->image))}}" alt="{{ $distributor->alt }}" title="{{ $distributor->pic_title }}"></div>
            </article>
            <section class="distributors-main">
                <div class="distributors-panel" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="300">
                    <div class="distributors-select">
                        <div class="form-group">
                            <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("Choose your country"); ?></label>
                            <select class="wide">
                                @if(!empty($countries))
                                    @foreach ($countries as $id => $country)
                                        <option class="country_option" value="{{$id}}">{{$country}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="distributors-list d-ajax">

                    @include('distributors.partials.distributor-items', ['distributor_items' => $distributor_items])

                </div>
            </section>
        </div>
    </div>
    @include('layouts.contact-us', ['entity' => $distributor])

@endsection

@section('footer')

@endsection()
