@extends('layout')
@section('metaTitle', 'Comparison')
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags('Comparison') ))

@section('content')
    <div class="page-body">
        <div class="compare-wrapper">
            <div class="container">
                <div class="section-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
                    <div class="feature-headings" data-title="<?= \App\Models\StaticTextLang::t("comparison",'comparison'); ?>">
                        <h2 class="section-title"><b><?= \App\Models\StaticTextLang::t("comparison",'comparison'); ?></b></h2>
                    </div>
                </div>
                <?php if(($comparisons->isNotEmpty())){
                    //dd($comparisons);
                    ?>
                <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <?php if(!empty($product_types)){
                        $i=0;
                        ?>
                        <div class="compare-filters">
                          <!--  <a class="compare-filter-button product-type" data-product-type="all" href="#">All</a> -->
                            @foreach($product_types as $id => $product_type)
                                @php
                                    if($i==0){
                                        $active = 'active';
                                    }
                                    else{
                                        $active = '';
                                    }
                                @endphp
                            <a class="compare-filter-button product-type {{$active}}" data-product-type="{{$id}}" href="#">{{$product_type}}</a>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </div>
                    <?php } ?>
                    <div class="compare-inner">
                        <div class="compare-aside">
                            <div class="compare-aside-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                                <button class="compare-aside-button" id="all-types-button"  data-aos-duration="1000" data-aos-delay="150" id="all-types-button">All parameters</button>
                                <button class="compare-aside-button" id="equal-types-button" data-aos-duration="1000" data-aos-delay="250" id="equal-types-button">Сontradistinction </button>
                            </div>
                            <div class="compare-aside-body ajax-aside">
                                @include('compare.partials.compare-aside',['comparison_one'=>$comparison_one,'product_type0'=>$product_type0])
                            </div>
                        </div>
                        <div class="compare-main">
                            <div class="compare-list">
                                <div class="swiper-container" id="compare-slider">
                                    <div class="swiper-wrapper compare-ajax">
                                        @include('compare.partials.product-items',['comparisons'=>$comparisons,'product_type0'=>$product_type0])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                else {
                ?>
                <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <h5> You have not added products to compare yet </h5>
                </div>
                <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    @include('layouts.contact-us', ['entity' => $seo_block])


@endsection

@section('footer')

@endsection()
