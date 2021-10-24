
@extends('layout')
@section('metaTitle',\Illuminate\Support\Str::limit($product->title, $limit = 55, $end = '...'))
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags($product->subtitle) ))

@section('content')
    @php
        $checkWishlist = \App\Wishlist::check($product);
        $checkCompare = \App\Comparison::check($product);
        if(empty($checkWishlist)){
            $wishlist_class='';
            $checked_wish = '';
        }
        else{
             $wishlist_class='in-active';
             $checked_wish = 'checked';
        }
        if(empty($checkCompare)){
            $compare_class='';
            $checked_compare = '';
        }
        else{
             $compare_class='in-active';
             $checked_compare = 'checked';
        }
    @endphp
    <div class="page-navigation">
        <div class="container">
            <div class="page-breadcrumbs">
                <ul class="breadcrumbs-navigation">
                    {{ Breadcrumbs::render('catalog_single',$product) }}
                </ul>
            </div>
        </div>
    </div>
    <div class="page-body">
        <section class="section product-post">
            <div class="container">
                <div class="section-header" data-title="key areas" data-aos="fade-in" data-aos-duration="1000">
                    <div class="feature-headings" data-title="{{\App\Helpers\Helper::getBgText($product->bg_text,$product->title)}}">
                        <h1 class="section-title">{{$product->title}}</h1>
                    </div>
                </div>
                <div class="section-body">
                    <div class="product-post-info" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <div class="product-post-slider">
                            <div class="swiper-container" id="product-slider">
                                <div class="swiper-wrapper">
                                    @if(!empty($product->getImages()))
                                        @foreach($product->getImages() as $image)
                                            @if(isset($image['paths']))
                                                <div class="swiper-slide">
                                                    <a class="product-slider-link"  data-fancybox="gallery" href="{{asset($image['paths'])}}" fancybox>
                                                        <img class="product-slider-image" src="{{asset($image['paths'])}}" alt="{{$image['alt']}}" title="{{$image['title']}}">
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <!-- If we need navigation buttons -->
                                <div class="swiper-button-prev" id="product-slider-prev">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M25 16C25.5523 16 26 15.5523 26 15C26 14.4477 25.5523 14 25 14L25 16ZM4.29289 14.2929C3.90237 14.6834 3.90237 15.3166 4.29289 15.7071L10.6569 22.0711C11.0474 22.4616 11.6805 22.4616 12.0711 22.0711C12.4616 21.6805 12.4616 21.0474 12.0711 20.6569L6.41421 15L12.0711 9.34314C12.4616 8.95262 12.4616 8.31946 12.0711 7.92893C11.6805 7.53841 11.0474 7.53841 10.6569 7.92893L4.29289 14.2929ZM25 14L5 14L5 16L25 16L25 14Z" fill="#2CABE1"/>
                                    </svg>
                                </div>
                                <div class="swiper-button-next" id="product-slider-next">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5 14C4.44772 14 4 14.4477 4 15C4 15.5523 4.44772 16 5 16L5 14ZM25.7071 15.7071C26.0976 15.3166 26.0976 14.6834 25.7071 14.2929L19.3431 7.92893C18.9526 7.53841 18.3195 7.53841 17.9289 7.92893C17.5384 8.31946 17.5384 8.95262 17.9289 9.34315L23.5858 15L17.9289 20.6569C17.5384 21.0474 17.5384 21.6805 17.9289 22.0711C18.3195 22.4616 18.9526 22.4616 19.3431 22.0711L25.7071 15.7071ZM5 16L25 16L25 14L5 14L5 16Z" fill="#2CABE1"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="swiper-container" id="product-thumb-slider">
                                <div class="swiper-wrapper">
                                    @if(!empty($product->getImages()))
                                        @foreach($product->getImages() as $image)
                                            @if(isset($image['paths']))
                                                <div class="swiper-slide">
                                                    <div class="product-slider-image" style="background-image: url({{asset($image['paths'])}})">
                                                        <svg class="product-slider-placeholder" width="580" height="385" viewBox="0 0 580 385" xmlns="http://www.w3.org/2000/svg">
                                                            <rect x="0" y="0" width="580" height="385" rx="3" ry="3" fill="none"></rect>
                                                        </svg>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="product-post-exerpt">
                            <div class="product-info-title">{{$product->title}}</div>
                            <h2 class="product-info-subtitle">{{$product->subtitle}}</h2>
                            <div class="product-info-table">
                                @foreach($product->decodeMainInformation() as $item)
                                    <dl>
                                        <dt>{{$item->name}}: </dt>
                                        <dd>{{$item->desc}}</dd>
                                    </dl>
                                @endforeach
                            </div>
                            <div class="product-info-actions"><span class="product-info-checkbox">
											<label class="checkbox-item">
												<input class="add-compare <?= $compare_class ?>" <?= $checked_compare ?> data-product-id="<?= $product->id ?>" type="checkbox" #{status}="#{status}"/><span>Сompare</span>
											</label></span><span class="product-info-checkbox">
											<label class="checkbox-item">
												<input class="add-wishlist <?= $wishlist_class ?>" <?= $checked_wish ?> data-product-id="<?= $product->id ?>" type="checkbox" #{status}="#{status}"/><span>Add to Wishlist</span>
											</label></span></div>
                            <div class="product-info-price">{{$product->price}}</div>
                            <button class="product-info-button" data-fancybox="contact-us" data-src="#contact-us" href="javascript:;">Contact Us</button>
                        </div>
                    </div>
                    <div class="product-post-description">
                        <?= $product->text ?>
                    </div>
                </div>
            </div>
        </section>
        <section class="section product-specification">
            <div class="container">
                <div class="section-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
                    <div class="feature-headings">
                        <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Technical <b>and functional system specifications",'catalog'); ?></b></h2>
                    </div>
                </div>
                <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <div class="tabs specification-tabs">
                        <ul class="tab-panel specification-tab-panel">
                            <li class="tab-item specification-tab"><a class="tab-button specification-tab-button" href="#tab-1"><?= \App\Models\StaticTextLang::t("Main characteristics",'catalog'); ?></a></li>
                            <li class="tab-item specification-tab"><a class="tab-button specification-tab-button" href="#tab-2"><?= \App\Models\StaticTextLang::t("Technical characteristics",'catalog'); ?></a></li>
                            <li class="tab-item specification-tab"><a class="tab-button specification-tab-button" href="#tab-3"><?= \App\Models\StaticTextLang::t("Compliance Statements",'catalog'); ?></a></li>
                            <!-- #SID : 40-new-tab-on-product-page -->
                        </ul>
                        @include('products._propery.characteristics',['product' => $product])
                    </div>
                </div>
                <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <ul class="specification-button-group">
                        <li class="button-group-item"><a class="specification-button" target="_blank" href="{{asset($product->spec_sheet)}}"><?= \App\Models\StaticTextLang::t("Get Spec Sheet",'catalog'); ?></a></li>
                    </ul>
                </div>
            </div>
        </section>
        <aside class="active-panel">
            <a class="in-wishlist" href="{{url('wishlist')}}" id="in-wishlist">
                <svg width="45" height="42" viewBox="0 0 45 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="path-1-inside-1" fill="white">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22.4997 7.69451L20.4831 5.63092C15.7497 0.786934 7.07033 2.45853 3.93721 8.54851C2.46627 11.4129 2.13439 15.5485 4.82033 20.8265C7.40783 25.9085 12.791 31.9956 22.4997 38.626C32.2085 31.9956 37.5888 25.9085 40.1791 20.8265C42.865 15.5457 42.536 11.4129 41.0622 8.54851C37.9291 2.45853 29.2497 0.784134 24.5163 5.62812L22.4997 7.69451ZM22.4997 42C-20.6244 13.6305 9.22189 -8.51184 22.0047 3.20053C22.1735 3.35453 22.3394 3.51412 22.4997 3.67932C22.6584 3.51428 22.8235 3.35549 22.9947 3.20333C35.7747 -8.51744 65.6238 13.6277 22.4997 42Z"/>
                    </mask>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22.4997 7.69451L20.4831 5.63092C15.7497 0.786934 7.07033 2.45853 3.93721 8.54851C2.46627 11.4129 2.13439 15.5485 4.82033 20.8265C7.40783 25.9085 12.791 31.9956 22.4997 38.626C32.2085 31.9956 37.5888 25.9085 40.1791 20.8265C42.865 15.5457 42.536 11.4129 41.0622 8.54851C37.9291 2.45853 29.2497 0.784134 24.5163 5.62812L22.4997 7.69451ZM22.4997 42C-20.6244 13.6305 9.22189 -8.51184 22.0047 3.20053C22.1735 3.35453 22.3394 3.51412 22.4997 3.67932C22.6584 3.51428 22.8235 3.35549 22.9947 3.20333C35.7747 -8.51744 65.6238 13.6277 22.4997 42Z" fill="#2CABE1"/>
                    <path d="M22.4997 7.69451L11.7716 18.1782L22.507 29.164L33.235 18.1709L22.4997 7.69451ZM20.4831 5.63092L9.75483 16.1144L9.75499 16.1146L20.4831 5.63092ZM3.93721 8.54851L-9.4011 1.68632L-9.40624 1.69631L3.93721 8.54851ZM4.82033 20.8265L-8.54818 27.6296L-8.54679 27.6324L4.82033 20.8265ZM22.4997 38.626L14.0403 51.013L22.4997 56.7902L30.9591 51.013L22.4997 38.626ZM40.1791 20.8265L53.5432 27.6382L53.549 27.6268L40.1791 20.8265ZM41.0622 8.54851L27.7239 15.4107L27.7241 15.4111L41.0622 8.54851ZM24.5163 5.62812L13.788 -4.85536L13.781 -4.84826L24.5163 5.62812ZM22.4997 42L14.2558 54.5315L22.5001 59.9551L30.7442 54.5311L22.4997 42ZM22.0047 3.20053L11.8713 14.2601L11.8823 14.2702L11.8934 14.2803L22.0047 3.20053ZM22.4997 3.67932L11.7351 14.1255L22.5499 25.27L33.3127 14.0754L22.4997 3.67932ZM22.9947 3.20333L32.9599 14.4147L33.0472 14.3371L33.1333 14.2582L22.9947 3.20333ZM33.2279 -2.78913L31.2113 -4.85272L9.75499 16.1146L11.7716 18.1782L33.2279 -2.78913ZM31.2115 -4.85256C18.5987 -17.7599 -2.06826 -12.5668 -9.4011 1.68632L17.2755 15.4107C16.479 16.9589 15.2054 17.5816 14.2949 17.7472C13.3413 17.9207 11.4017 17.7997 9.75483 16.1144L31.2115 -4.85256ZM-9.40624 1.69631C-13.4277 9.52741 -13.0451 18.793 -8.54818 27.6296L18.1888 14.0233C17.6805 13.0245 17.7957 12.8088 17.8115 13.2789C17.819 13.5029 17.8007 13.8266 17.7126 14.219C17.625 14.6092 17.4813 15.01 17.2806 15.4007L-9.40624 1.69631ZM-8.54679 27.6324C-4.42119 35.7352 3.11911 43.5547 14.0403 51.013L30.9591 26.239C22.4628 20.4366 19.2369 16.0817 18.1874 14.0206L-8.54679 27.6324ZM30.9591 51.013C41.8841 43.5521 49.4167 35.7341 53.5432 27.6382L26.815 14.0147C25.7608 16.0828 22.5328 20.4392 14.0403 26.239L30.9591 51.013ZM53.549 27.6268C58.0392 18.7987 58.4363 9.53031 54.4003 1.68595L27.7241 15.4111C27.522 15.0182 27.377 14.6146 27.2886 14.2215C27.1998 13.8263 27.1815 13.5004 27.1891 13.2752C27.205 12.8037 27.3203 13.0211 26.8091 14.0262L53.549 27.6268ZM54.4005 1.68632C47.0711 -12.5601 26.4057 -17.7678 13.788 -4.85536L35.2446 16.1116C33.5962 17.7985 31.6546 17.9189 30.7013 17.7453C29.7916 17.5795 28.5197 16.9574 27.7239 15.4107L54.4005 1.68632ZM13.781 -4.84826L11.7645 -2.78186L33.235 18.1709L35.2515 16.1045L13.781 -4.84826ZM30.7436 29.4685C21.1743 23.1733 17.1951 18.1929 15.7329 15.3881C14.4523 12.9316 15.3704 12.8969 14.8014 14.0784C14.5282 14.6455 13.5965 15.8408 11.8713 14.2601L32.1381 -7.85903C17.6301 -21.1522 -4.61616 -14.7419 -12.2271 1.06073C-16.4651 9.85991 -15.7217 19.9481 -10.8693 29.2562C-6.19843 38.216 2.26306 46.642 14.2558 54.5315L30.7436 29.4685ZM11.8934 14.2803C11.8688 14.2579 11.8133 14.2061 11.7351 14.1255L33.2643 -6.76686C32.8655 -7.17782 32.4781 -7.54882 32.116 -7.87926L11.8934 14.2803ZM33.3127 14.0754C33.1995 14.1932 33.0818 14.3064 32.9599 14.4147L13.0295 -8.00803C12.5653 -7.5954 12.1173 -7.16465 11.6867 -6.71674L33.3127 14.0754ZM33.1333 14.2582C31.4068 15.8415 30.4707 14.6438 30.1972 14.0761C29.6282 12.8948 30.5464 12.93 29.2656 15.3871C27.8035 18.1922 23.8244 23.1731 14.2552 29.4689L30.7442 54.5311C42.7371 46.6407 51.1983 38.2139 55.8688 29.2533C60.7206 19.9448 61.4635 9.8564 57.2252 1.05742C49.6133 -14.7458 27.3626 -21.1557 12.8561 -7.8515L33.1333 14.2582Z" fill="#2CABE1" mask="url(#path-1-inside-1)"/>
                </svg>
                <div class="in-wishlist-count"><?= \App\Wishlist::countWishlist(\App\Helpers\Helper::getUserCookieId()) ?></div></a><a class="in-compare" href="{{url('compare')}}" id="in-compare"><svg width="43" height="36" viewBox="0 0 43 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.4573 26.3157L16.875 25.8561V23.5898L10.0305 9.14062H6.84448L0 23.5898V25.9666L0.372129 26.3704C1.3942 27.4771 2.63404 28.3606 4.01379 28.9653C5.39354 29.57 6.88341 29.883 8.38986 29.8845H8.42678C9.93943 29.8778 11.4342 29.5571 12.8165 28.9428C14.1988 28.3285 15.4386 27.4339 16.4573 26.3157V26.3157ZM14.0625 24.7507C12.562 26.241 10.532 27.0758 8.4172 27.0722H8.38819C6.31059 27.0826 4.31065 26.2833 2.8125 24.8438V24.2227L8.4375 12.3476L14.0625 24.2227V24.7507Z" fill="#2CABE1"/>
                    <path d="M35.343 9.14062H32.157L25.3125 23.5898V25.9666L25.6846 26.3704C26.7067 27.4771 27.9465 28.3606 29.3263 28.9653C30.706 29.57 32.1959 29.883 33.7024 29.8845H33.7393C35.2519 29.8778 36.7467 29.5571 38.1291 28.9427C39.5114 28.3284 40.7511 27.4338 41.7698 26.3155L42.1875 25.8561V23.5898L35.343 9.14062ZM39.375 24.7507C37.8745 26.241 35.8445 27.0758 33.7297 27.0722H33.7007C31.6231 27.0826 29.6231 26.2833 28.125 24.8438V24.2227L33.75 12.3476L39.375 24.2227V24.7507Z" fill="#2CABE1"/>
                    <path d="M22.5 9.63802C23.2823 9.40288 23.9941 8.97747 24.5717 8.39985C25.1493 7.82224 25.5747 7.11044 25.8099 6.32815H35.1562V3.51565H25.8099C25.5072 2.49992 24.8846 1.60907 24.0349 0.975622C23.1852 0.342178 22.1536 0 21.0938 0C20.0339 0 19.0023 0.342178 18.1526 0.975622C17.3028 1.60907 16.6803 2.49992 16.3776 3.51565H7.03125V6.32815H16.3776C16.6128 7.11044 17.0382 7.82224 17.6158 8.39985C18.1934 8.97747 18.9052 9.40288 19.6875 9.63802V33.0469H10.5469V35.8594H31.6406V33.0469H22.5V9.63802ZM18.9844 4.9219C18.9844 4.5047 19.1081 4.09688 19.3399 3.74999C19.5716 3.40311 19.9011 3.13274 20.2865 2.97309C20.672 2.81344 21.0961 2.77166 21.5053 2.85305C21.9144 2.93444 22.2903 3.13534 22.5853 3.43034C22.8803 3.72534 23.0812 4.1012 23.1626 4.51038C23.244 4.91956 23.2022 5.34368 23.0426 5.72912C22.8829 6.11456 22.6125 6.444 22.2657 6.67578C21.9188 6.90756 21.5109 7.03127 21.0938 7.03127C20.5343 7.03127 19.9978 6.80903 19.6022 6.41345C19.2066 6.01787 18.9844 5.48134 18.9844 4.9219Z" fill="#2CABE1"/>
                </svg>
                <div class="in-compare-count"><?= \App\Comparison::countComparison(\App\Helpers\Helper::getUserCookieId()) ?></div>
            </a>
        </aside>
    </div>
    <?php if(!empty($portfolios)){ ?>
        @if($portfolios->count() >= 1)
            <section class="section projects-portfolio">
                <div class="container">
                    <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                        <div class="feature-headings" data-title="Portfolio">
                            <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Projects <b>portfolio</b>",'main'); ?></h2>
                        </div>
                    </div>
                    <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        @include('layouts._parts.portfolio_block',['portflios' => $portfolios])
                    </div>
                    <div class="section-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                        <a class="view-all" href="<?= url('projects-portfolio') ?>"><span><?= \App\Models\StaticTextLang::t("View all projects",'main'); ?></span></a>
                    </div>
                </div>
            </section>
        @endif
    <?php } ?>
    <?php if(!empty($products)){ ?>
        @if($products->count() >= 1)
            <section class="section popular-products">
                <div class="container">
                    <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                        <div class="feature-headings">
                            <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Products, <b>which you may also need</b>",'main'); ?></h2>
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
        @endif
    <?php } ?>
    <?php if(!empty($articles)){ ?>
        <section class="section recent-posts">
            @include('layouts._parts.news_block',['articles' => $articles,'title'=> \App\Models\StaticTextLang::t("Related <b> articles and news</b>",'main') ])
        </section>
    <?php } ?>
    @include('layouts.contact-us', ['entity' => $product])
@endsection

@section('footer')

@endsection()
