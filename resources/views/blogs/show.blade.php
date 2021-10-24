@extends('layout')
@section('metaTitle', \Illuminate\Support\Str::limit($blog->title, $limit = 55, $end = '...'))
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags($blog->content_top) ))
@section('content')
    <!-- #SID - 44-new-website-page-knowledge -->
    <div class="page-navigation">
        <div class="container">
            {{ Breadcrumbs::render('knowledge_single', $blog->category()->name, $blog) }}
        </div>
    </div>
    <div class="page-body">
        <section class="section usecase-post blog-desc-sec">
            <div class="container">
                <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                    <div class="feature-headings textCenter" data-title="{{ \App\Helpers\Helper::getBgText($blog->name,$blog->name) }}">
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-lg-12 textCenter blogbox-top" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                            <h5 class="usecase-box-description knowledge-box-min expert-read">Expertise - {{ $blog->reading_time }} reading</h5>
                            <h1 class="section-title feature-headings blog-feature-headings">{{$blog->title}}</h1>
                            <h5 class="usecase-box-description knowledge-box-min by-name">by <a href="#">{{ $blog->author }}</a></h5>
                            <h5 class="usecase-box-by-name knowledge-box-min">{{ date_format(date_create($blog->added_date),"d.m.Y") }}</h5>
                        </div>
                        <div class="col-12 col-lg-12 textCenter blogbox-middle" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                            <img class="icon-box-icon" width="100%" src="{{$blog['banner_image']}}" alt="{{ $blog['title'] }}" title="{{ $blog['title'] }}"/>
                        </div>
                        @if(!empty($blog->content_top) && $blog->content_top != '')
                            <div class="col-12 col-lg-12 textCenter blogbox-bottom" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                                {!! html_entity_decode(htmlentities($blog->content_top)) !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @if(!empty($blog->content_middle) && $blog->content_middle != '')
            <section class="section benefits blog-benefits">
                <div class="container">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-lg-12 textCenter" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                                {!! $blog->content_middle !!}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @if(!empty($blog->content_bottom) && $blog->content_bottom != '')
        <section class="section usecase-post blog-advantages ">
            <div class="container">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-lg-12 textCenter" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                            {!! $blog->content_bottom !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @if(!empty($blog->pdf_url) && $blog->pdf_url != '')
        <section class="section benefits blog-download">
            <div class="container">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-lg-12 textCenter" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                            <h6><b>More detailed information download here</b></h6>
                            <!-- <h6><b>click to download</b></h6> -->
                            <a href="{{ asset($blog->pdf_url)}}" class="product-info-button" data-fancybox="download-pdf">DOWNLOAD THE {{ strtoupper($blog->name)}} </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
        @if(!empty($blog->conclusion) && $blog->conclusion != '')
        <section class="section usecase-post blog-conclution">
            <div class="container">
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 col-lg-12" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                            <!-- <h2 class="icon-box-title textLeft">CONCUSION</h2> -->
                            <div>{!! $blog->conclusion !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

        @if(count($related_blogs) > 0)
        <section class="section related-information blog-tab">
			<h6>YOU MIGHT ALSO LIKE</h6>
            @include('layouts._parts.blog_block',['blogs' => $related_blogs,'title'=> \App\Models\StaticTextLang::t("<b>YOU MIGHT ALSO LIKE</b>",'main') ])
        </section>
        @endif

		<section class="newsletter-box blog-desc-news">
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

                    <!--End mc_embed_signup-->
					<!-- <div class="news-box-inner">
						<h3><i>Subscribe</i> for our monthly newsletter to learn about our recent project, discover what goes on inside TECTELIC</h3>
						<a class="newsletter-btn">Subscribe to the newsletter</a>
					</div> -->
				</div>
			</div>
		</section>
    </div>
    @include('layouts.contact-us', ['entity' => $blog])
@endsection

@section('footer')

@endsection()
