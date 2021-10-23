@extends('layout')
@section('metaTitle', (isset($search_text) && $search_text != '') ? $search_text : 'Search') 
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags((isset($search_text) && $search_text != '') ? $search_text." - FIND EXACTLY WHAT YOU NEED" : 'FIND EXACTLY WHAT YOU NEED') ))

@section('content')
    <div class="page-header">
        <div class="container">
            <div class="page-breadcrumbs">
                <ul class="breadcrumbs-navigation">
                    <li class="breadcrumbs-item"><a class="breadcrumbs-link" href="index.html">Home </a></li>
                    <li class="breadcrumbs-item"><span class="breadcrumbs-text">Search</span></li>
                </ul>
            </div>
            <div class="page-headings">
                <h2 class="page-title"><?= \App\Models\StaticTextLang::t("Find exactly what you need",'search'); ?></h2>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <div class="search-filters" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
                <div class="filter-panel">
                    <div class="filter-panel-inner" id="search-filters">
                        <div class="filter-panel-item">
                            <div class="filter-panel-button search_cat uppercase active">All</div>
                        </div>
                        <div class="filter-panel-item">
                            <div class="filter-panel-button search_cat uppercase" data-searchcat="<?= \App\Helpers\Helper::$searchCat['catalog'] ?>">catalog</div>
                        </div>
                        <div class="filter-panel-item">
                            <div class="filter-panel-button search_cat uppercase" data-searchcat="<?= \App\Helpers\Helper::$searchCat['key_areas'] ?>">key areas</div>
                        </div>
                        <div class="filter-panel-item">
                            <div class="filter-panel-button search_cat uppercase" data-searchcat="<?= \App\Helpers\Helper::$searchCat['projects_portfolio'] ?>">Projects portfolio</div>
                        </div>
                        <div class="filter-panel-item">
                            <div class="filter-panel-button search_cat uppercase" data-searchcat="<?= \App\Helpers\Helper::$searchCat['use_cases'] ?>">use cases</div>
                        </div>
                        <div class="filter-panel-item">
                            <div class="filter-panel-button search_cat uppercase" data-searchcat="<?= \App\Helpers\Helper::$searchCat['knowledge_base'] ?>">Knowledge base</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="search-panel" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <form class="search-panel-form">
                    <div class="search-form-group">
                        <label class="search-panel-label"><span class="result_count"><?= $count ?></span> RESULTS FOR <span class="result_search"> {{$search_text}} </span></label>
                        <input class="search-panel-input" type="text" placeholder="Search" value="<?= !empty($search_text)?$search_text :'' ?>">
                        <div class="search-panel-icon"><svg width="32" height="30" viewBox="0 0 32 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M30.9998 11.2717C30.9998 16.9226 26.3037 21.5434 20.4613 21.5434C14.6189 21.5434 9.92285 16.9226 9.92285 11.2717C9.92285 5.62071 14.6189 1 20.4613 1C26.3037 1 30.9998 5.62071 30.9998 11.2717Z" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <line x1="1" y1="-1" x2="12.6487" y2="-1" transform="matrix(-0.715328 0.698789 0.715328 0.698789 11.7637 20.4624)" stroke="#C4C4C4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="search-form-group">
                        <button class="search-panel-button"><?= \App\Models\StaticTextLang::t("search",'search'); ?></button>
                    </div>
                </form>
            </div>
            <div class="search-results">
                @include('search.partials._search', ['data' => $data,'search_text'=>$search_text])
            </div>
        </div>
    </div>


@endsection

@section('footer')

@endsection()

@push('scripts')
    <script src="{{ asset('js/search.js') }}"></script>
@endpush
