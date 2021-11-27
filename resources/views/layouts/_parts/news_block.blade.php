@if(!empty($articles))
    @if($articles->count() >= 1)
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <div class="feature-headings headings--recent-posts" data-title="<?= \App\Models\StaticTextLang::t("news",'bgtext_main'); ?>">
                    <h2 class="section-title"><?= $title ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <div class="recent-posts-inner">
                        @foreach($articles as $article)
                            <div class="recent-post-column">
                                <article class="news-card">
                                    <div class="news-card-inner">
                                        <a class="news-card-image" href="{{url('knowledge/company-news',['slug' => $article->slug])}}">
                                            <img class="image b-lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{\App\Helpers\Helper::getImgSrc($article->image)}}" loading='lazy' alt="{{ $article->alt }}" title="{{ $article->pic_title }}"/>
                                        </a>
                                        <div class="news-card-content">
                                            <date class="news-card-date">
                                                {{date('d-m-Y', strtotime($article->created_at))}}
                                            </date>
                                            {{-- <i class="news-card-icon icon-facebook"></i>--}}
                                            <a class="news-card-title" href="{{url('knowledge/company-news',['slug' => $article->slug])}}">{{$article->title}}</a>
                                           {{-- <p class="news-card-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>--}}
                                            <a class="news-card-link" href="{{url('knowledge/company-news',['slug' => $article->slug])}}"><span><?= \App\Models\StaticTextLang::t("news",'See more'); ?></span></a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                </div>
            </div>
            <div class="section-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="150">
                <a class="view-all" href="{{url('knowledge/news')}}"><span><?= \App\Models\StaticTextLang::t("news",'View all news'); ?></span></a>
            </div>
        </div>
    @endif
@endif
