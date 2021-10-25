@extends('layout')
@section('metaTitle', \Illuminate\Support\Str::limit($pdf->title, $limit = 47, $end = '..'))
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags($pdf->short_description) ))

@section('content')
<div class="page-navigation">
    <div class="container">
        {{ Breadcrumbs::render('knowledge_single','whitepapers',$pdf) }}
    </div>
</div>
    <div class="page-navigation">
        <div class="container">
            <div class="page-breadcrumbs">
                <ul class="breadcrumbs-navigation">
                    {{-- Breadcrumbs::render('knowledge_single','whitepapers',$pdf) --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="page-body">
        <section class="section product-post">
            <div class="container">
                <!-- #SID - 43-error-500-vulnerability-on-the-website -->
                @if(isset($pdf) && !empty($pdf))
                <div class="section-header" data-title="key areas" data-aos="fade-in" data-aos-duration="1000">
                    <div class="feature-headings" data-title="{{\App\Helpers\Helper::getBgText($pdf->title,$pdf->title)}}">
                        <h1 class="section-title">{{$pdf->title}}</h1>
                    </div>
                </div>
                <div class="section-body">
                    <div class="product-post-info" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <div class="pdf-image project-post-image">
                            <img src="{{$pdf->image}}">
                        </div>
                        <div class="product-post-exerpt">
                            <div class="product-info-title">{{$pdf->title}}</div>
                            <h2 class="product-info-subtitle"><?= $pdf->short_description ?></h2>

                            <a class="pdf-info-button product-info-button" data-fancybox="download-pdf" data-src="#download-pdf">Download PDF</a>
                            <a id="download-pdf-button" target="_blank" href="{{asset($pdf->file)}}"></a>
                        </div>
                    </div>
                    <div class="product-post-description">
                        <?= $pdf->text ?>
                    </div>
                </div>
                @endif
            </div>
        </section>
    </div>
    <section class="section pdf-block">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <div class="feature-headings" data-title="<?= \App\Models\StaticTextLang::t("Whitepaper",'bgtext_main'); ?>">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("<b>Other Whitepapers</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                @include('layouts._parts.pdf_block',['pdfs' => $pdfs])
            </div>
            <div class="section-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <a class="view-all" href="<?= url('whitepaper') ?>"><span><?= \App\Models\StaticTextLang::t("View all",'main'); ?></span></a>
            </div>
        </div>
    </section>
    <?php if(!empty($articles)){ ?>
        <section class="section recent-posts">
            @include('layouts._parts.news_block',['articles' => $articles,'title'=> \App\Models\StaticTextLang::t("Related <b> articles and news</b>",'main') ])
        </section>
    <?php } ?>
    @include('layouts.contact-us', ['entity' => $pdf])
@endsection

@section('footer')

@endsection()
