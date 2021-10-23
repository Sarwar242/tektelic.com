@extends('layout')
@section('metaTitle', $key_area->title)
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags($key_area->sub_title) ))

@section('content')
    <div class="page-navigation">
        <div class="container">
            {{ Breadcrumbs::render('key-area',$key_area) }}
        </div>
    </div>
    <div class="page-body">
        <section class="section usecase-post">
            <div class="container">
                <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                    <div class="feature-headings" data-title="{{ \App\Helpers\Helper::getBgText($key_area->bg_text,$key_area->title) }}">
                        <h1 class="section-title">{{ $key_area->title }}</h1>
                    </div>
                </div>
                <div class="section-body">
                    <div class="usecase-post-article">
                        <div class="usecase-post-figure">
                            <div class="usecase-post-area">
                                <h2 class="usecase-post-heading" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">{!! $key_area->sub_title !!}</h2>
                                <div class="usecase-post-content" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">{!! $key_area->text !!}</div>
                            </div>
                            <div class="usecase-post-image">
                                <img src="{{asset(\App\Helpers\Helper::getImgSrc($key_area->keyArea->image))}}" alt="{{ $key_area->alt }}" title="{{ $key_area->pic_title }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        $i = 0;
        if(!empty($entities_top)){
        foreach ($entities_top as $type => $entities){
        if ($i % 2 == 0) {
            $class = 'benefits';
        } else {
            $class = 'quality';
        }
        ?>
        <section class="section <?=$class ?>">

            <div class="container">

                <?php
                foreach ($entities as $key => $entity){ ?>
                <?php if($entity['type'] == 'section'){ ?>
                <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                    <div class="feature-headings">
                        <h2 class="section-title">{!!isset($entity['title']) ? $entity['title']: '' !!}</h2>
                    </div>
                </div>
                <?php } ?>
                <?php
                    break;
                } ?>
                <div class="section-body">
                    <?php
                    foreach ($entities as $key => $entity){ ?>
                    <?php if($entity['type'] == 'section'){ ?>
                    <div class="benefits-exerpt" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">{!! isset($entity['text']) ? $entity['text']:'' !!}</div>
                    <?php } ?>
                    <?php
                    break;
                    } ?>
                    <div class="row">
                        <?php
                        foreach ($entities as $key => $entity){ ?>
                        <?php if($entity['type'] == 'item'){ ?>
                        <div class="col-6 col-sm-6 col-xl-3" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="250">
                            <div class="icon-box">
                                <div class="icon-box-inner">
                                    <img class="icon-box-icon" src="{{asset($entity['image'])}}" alt="{{ $entity['alt'] }}" title="{{ $entity['pic_title'] }}"/>
                                </div>
                                <div class="icon-box-desc">
                                    <div class="icon-box-title"><?= $entity['title'] ?></div>
                                    <?php if(!empty($entity['text'])){ ?>
                                    <div class="icon-box-description">{!! $entity['text'] !!}</div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>

            </div>

        </section>
        <?php
        $i++;
        }
        }
        ?>

        <?php if(!empty($portfolios)): ?>
            <?php if($portfolios->count() >= 1){ ?>
                <section class="section projects-portfolio">
                    <div class="container">
                        <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                            <div class="feature-headings">
                                <h2 class="section-title"><?= \App\Models\StaticTextLang::t("our Projects <b>for Smart Cities</b>",'key_area'); ?></h2>
                            </div>
                        </div>
                        <div class="section-body" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="100">
                            @include('layouts._parts.portfolio_block',['portflios' => $portfolios])
                        </div>
                        <div class="section-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="150">
                            <a class="view-all" href="<?= url('projects-portfolio') ?>"><span><?= \App\Models\StaticTextLang::t("View all projects",'key_area'); ?></span></a>
                        </div>
                    </div>
                </section>
            <?php } ?>
        <?php endif ?>
        <?php
        if(!empty($entities_bottom)){
        foreach($entities_bottom as $entities){
        ?>
        <section class="section various-technologies">
            <div class="container">

                <?php
                foreach ($entities as $key => $entity){ ?>
                <?php if($entity['type'] == 'section'){ ?>

                <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                    <div class="feature-headings">
                        <h2 class="section-title">{!!isset($entity['title']) ? $entity['title']: '' !!}</h2>
                    </div>
                </div>

                <?php }
                    break;
                }
                ?>

                <div class="section-body">
                    <div class="row">
                        <?php
                        foreach ($entities as $key => $entity){ ?>
                        <?php if($entity['type'] == 'item'){ ?>
                        <div class="col-6 col-sm-6 col-lg-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                            <div class="icon-box">
                                <div class="icon-box-inner">
                                    <img class="icon-box-icon" src="{{asset($entity['image'])}}" alt="{{ $entity['alt'] }}" title="{{ $entity['pic_title'] }}"/>
                                </div>
                                <div class="icon-box-desc">
                                    <div class="icon-box-title">{{$entity['title']}}</div>
                                    <div class="icon-box-description">{!! $entity['text'] !!}</div>
                                </div>
                            </div>
                        </div>
                        <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
        }
        }
        ?>

    </div>
    <?php if(!empty($products)){ ?>
        <section class="section popular-products">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <div class="feature-headings">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Products, <b>which you may also need</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                @include('layouts._parts.product_block',['products' => $products])
            </div>
            <div class="section-footer" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <a class="view-all" href="{{url('catalog')}}"><span><?= \App\Models\StaticTextLang::t("View all products",'key_area'); ?></span></a>
            </div>
        </div>
    </section>
    <?php } ?>
    <?php if(!empty($articles)){ ?>
        <section class="section related-information">
            @include('layouts._parts.news_block',['articles' => $articles,'title'=> \App\Models\StaticTextLang::t("<b>Related information</b>",'main') ])
        </section>
    <?php } ?>
    @include('layouts.contact-us', ['entity' => $key_area])
@endsection

@section('footer')

@endsection()
