@extends('layout')

@section('content')
    <div class="page-body">
        <div class="wrapper-404">
            <div class="container">
                <div class="section-header">
                    <div class="feature-headings-404" data-title="404">
                        <h2 class="section-title-404"><?= \App\Models\StaticTextLang::t("the page you are looking for is not found"); ?></h2>
                    </div>
                </div>
                <div class="section-body">
                    <div class="search-panel">
                        <form class="search-panel-form" id="404-search-form" method="POST" action="{{url('search')}}">

                            <div class="search-form-group">
                                <label class="search-panel-label"><?= \App\Models\StaticTextLang::t("Find exactly what you need"); ?></label>
                                <input class="search-panel-input" name="header_search" type="text" placeholder="<?= \App\Models\StaticTextLang::t("Search"); ?>">
                                <div class="search-panel-icon"><svg width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M30.9998 11.2717C30.9998 16.9226 26.3037 21.5434 20.4613 21.5434C14.6189 21.5434 9.92285 16.9226 9.92285 11.2717C9.92285 5.62071 14.6189 1 20.4613 1C26.3037 1 30.9998 5.62071 30.9998 11.2717Z" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <line x1="1" y1="-1" x2="12.6487" y2="-1" transform="matrix(-0.715328 0.698789 0.715328 0.698789 11.7637 20.4624)" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="search-form-group">
                                <button class="search-panel-button"><?= \App\Models\StaticTextLang::t("search"); ?></button>
                                @csrf
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')

@endsection()
