@extends('layout')
@section('metaTitle', 'Knowledge')
@section('metaDesc', str_replace("\xc2\xa0",' ',strip_tags('Knowledge')))
@section('content')
    <!-- #SID - 44-new-website-page-knowledge -->
    <div class="page-header">
        <div class="container">
            {{ Breadcrumbs::render('knowledge', $categoryName) }}
            <div class="page-headings">
                @if(isset($categoryName) && !empty($categoryName))
                    <h1 class="page-title">{{$categoryName}}</h1>
                @else
                    <h1 class="page-title"><?= \App\Models\StaticTextLang::t("Knowledge",'knowledge'); ?></h1>
                @endif
            </div>
        </div>
    </div>
    <div class="page-body">
        <section class="section use-cases blog-tab">
            <div class="container">
                <div class="section-body">
                    <div class="blog-filter-main blogCategories">
                        @foreach($categories as $category)
                            <form action="{{url('knowledge/'.str_replace(' ', '-', strtolower($category->name)))}}" method="post" id="{{$category->id}}">
                                @csrf
                                <input type="hidden" name="categoryId" value="{{$category->id}}">
                                <a data-categoryId="{{$category->id}}" onclick="filterCategory('{{$category->id}}')" class="selectCategory {{ ($activeCategory == $category->id) ? 'active' : '' }}" href="javascript:void(0);">{{$category->name}}</a>
                            </form>
                        @endforeach
                    </div>
                    <div class="section-usecases-inner render-list">
                        @if($isWhitepaper == 1)
                            @include('blogs._parts.whitepaper_list', ['pdfs' => $blogs])
                        @else
                            @include('blogs._parts.blog_list', ['blogs' => $blogs])
                        @endif
                    </div>
                </div>
            </div>
            <div class="catalog-footer">
                <div class="pagination">
                    @if($blogs->currentPage() != $blogs->lastPage())
                        <div class="load-more load-data-content"
                             data-type="blog"
                             data-url="{{$action_name}}"
                             data-current-page="{{isset($_GET['page']) ? $_GET['page'] : 1 }}"
                             data-aos="fade-in" data-aos-duration="1000" data-aos-delay="100"
                             data-empty-query="No results were found for your search."> Load more </div>
                    @endif
                    @include('layouts._parts.paginator', ['paginator' => $blogs])
                </div>
            </div>
        </section>
		
		<section class="newsletter-box">
			<div class="container">
				<div class="row">
					<div class="news-box-inner">
                    <!-- Begin Mailchimp Signup Form -->
                        <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
                        <div id="">
                            <form action="https://tektelic.us1.list-manage.com/subscribe/post?u=952800a87329e635009eb0e64&amp;id=55d80c1901" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                <div id="">
                                    <h3><i>Subscribe</i> for our monthly newsletter to learn about our recent projects, discover the latest news from TEKTELIC</h3>
                                    <div class="form-row">
                                        <input type="email" value="" name="EMAIL" class="email form-field" id="mce-EMAIL" placeholder="Email address" required>
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_952800a87329e635009eb0e64_55d80c1901" tabindex="-1" value="">
                                        </div>
                                        <div class="clear">
                                            <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="newsletter-btn form-submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</section>
    </div>

    @include('layouts.contact-us', ['entity' => $seo_block])
@endsection

@section('footer')

@endsection()