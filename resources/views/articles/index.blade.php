@extends('layout')
@section('metaTitle', ((!empty($heading->title))?$heading->title:'Knowledge base'))
@section('content')

    <?php
    if(empty($category_slug)){
        $active_all = 'active';
        $active = '';
    }
    else{
        $active_all = '';
        $active = 'active';
    }
    ?>

    <div class="page-header">
        <div class="container">
            {{ Breadcrumbs::render('articles') }}
            <div class="page-headings">
                <h1 class="page-title">{{((!empty($heading->title))?$heading->title:'Knowledge base')}}</h1>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <div class="service-panel">
                <div class="row">
                    <div class="service-panel-item col-12 col-sm-7">
                        <button class="filter-button" id="knowledge-base-filter"><svg class="filter-button-icon" width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.3741 1.3635H5.84165C5.57958 0.571914 4.84335 0 3.97773 0C3.11211 0 2.37588 0.571914 2.11381 1.3635H0.625869C0.280222 1.3635 0 1.64848 0 2C0 2.35152 0.280222 2.6365 0.625869 2.6365H2.11385C2.37592 3.42809 3.11215 4 3.97777 4C4.84339 4 5.57962 3.42809 5.84169 2.6365H15.3741C15.7198 2.6365 16 2.35152 16 2C16 1.64848 15.7198 1.3635 15.3741 1.3635V1.3635ZM3.97773 2.72701C3.58356 2.72701 3.26286 2.40087 3.26286 2C3.26286 1.59913 3.58356 1.27299 3.97773 1.27299C4.3719 1.27299 4.6926 1.59913 4.6926 2C4.6926 2.40087 4.3719 2.72701 3.97773 2.72701Z" fill="white"/>
                                <path d="M15.3741 6.3635H13.8861C13.624 5.57191 12.8878 5 12.0222 5C11.1566 5 10.4204 5.57191 10.1583 6.3635H0.625869C0.280222 6.3635 0 6.64848 0 7C0 7.35152 0.280222 7.6365 0.625869 7.6365H10.1583C10.4204 8.42809 11.1567 9 12.0222 9C12.8878 9 13.6241 8.42809 13.8861 7.6365H15.3741C15.7198 7.6365 16 7.35152 16 7C16 6.64848 15.7198 6.3635 15.3741 6.3635ZM12.0222 7.72701C11.6281 7.72701 11.3074 7.40087 11.3074 7C11.3074 6.59913 11.6281 6.27299 12.0222 6.27299C12.4164 6.27299 12.7371 6.59913 12.7371 7C12.7371 7.40087 12.4164 7.72701 12.0222 7.72701Z" fill="white"/>
                                <path d="M15.3741 11.3635H8.52316C8.26109 10.5719 7.52486 10 6.65924 10C5.79363 10 5.0574 10.5719 4.79532 11.3635H0.625869C0.280222 11.3635 0 11.6485 0 12C0 12.3515 0.280222 12.6365 0.625869 12.6365H4.79532C5.0574 13.4281 5.79363 14 6.65924 14C7.52486 14 8.26109 13.4281 8.52316 12.6365H15.3741C15.7198 12.6365 16 12.3515 16 12C16 11.6485 15.7198 11.3635 15.3741 11.3635ZM6.65924 12.727C6.26507 12.727 5.94438 12.4009 5.94438 12C5.94438 11.5992 6.26507 11.273 6.65924 11.273C7.05342 11.273 7.37411 11.5991 7.37411 12C7.37411 12.4009 7.05342 12.727 6.65924 12.727V12.727Z" fill="white"/>
                            </svg><span class="filter-button-title">Filter</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="filters-group" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
                @include('layouts._parts.filter_panel',[
                    'categories' => $categories,
                    'category_slug' => $category_slug,
                    'url' => 'articles',
                ])
            </div>
            <div class="knowledge-base">
                <div class="knowledge-base-wrapper">
                    <div class="knowledge-base-aside" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="250">
                        @widget('newsFilter',['type' => 'catalog'])
                    </div>
                    <div class="knowledge-base-inner">
                        <div class="knowledge-base-articles render-list">
                            @include('.articles._parts.item',['posts' => $posts])
                        </div>
                    </div>
                </div>
                <div class="knowledge-base-footer">
                    <div class="pagination" data-url="{{$action_name}}">
                        @if($posts->currentPage() != $posts->lastPage())
                            <div class="load-more load-data-content"
                                 data-type="news"
                                 data-url="{{$action_name}}"
                                 data-current-page="{{isset($_GET['page']) ? $_GET['page'] : 1 }}">Load more</div>
                        @endif
                        @include('layouts._parts.paginator', ['paginator' => $posts])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.contact-us', ['entity' => $seo_block])
@endsection

@section('footer')

@endsection()
