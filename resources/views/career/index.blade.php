@extends('layout')
@section('metaTitle', 'Career')
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags('We are Hiring.') ))
@section('content')
    <!-- #SID - #z3c3nz - Career page On Tektelic -->
    <div class="page-header">
        <div class="container">
            {{ Breadcrumbs::render('career') }}
            <div class="page-headings">
                @if(isset($heading) && !empty($heading->title))
                    <h1 class="page-title">{{$heading->title}}</h1>
                @else
                    <h1 class="page-title"><?= \App\Models\StaticTextLang::t("Career",'career'); ?></h1>
                @endif
            </div>
        </div>
    </div>
    <div class="page-body">
        <section class="section">
            <div class="container">
                @if(!empty($careers) && count($careers) > 0)
                    @foreach($careers as $career)
                        <div class="col-md-12 career-listing">
                            <a target="_blank" href="{{$career->link}}">
                            {!! $career->short_description !!}
                            </a>
                        </div>
                    @endforeach
                @endif
                <div></div>
            </div>
        </section>
    </div>

    @include('layouts.contact-us', ['entity' => $seo_block])
@endsection

@section('footer')

@endsection()