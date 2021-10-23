<?php if(!empty($comparisons)){

$options =  \App\Helpers\Helper::getMainOptions($product_type0);
//dd($options);
    $count_compatison= count($comparisons);
    ?>
@foreach($comparisons as $key => $comparison)
    @php

        $product = $comparison->product;
 if(!empty($product)){
    if(!empty($ajax)){
            $product_type=$product->type;
        }
        else{
            $product_type=null;
        }

   // \App\Helpers\Helper::getNotEqualField($product,'Operational Temperature',$product_type);
    $prod_arr =  \App\Helpers\Helper::getSortOptions($product);
   // $prod_arr_next =  \App\Helpers\Helper::getSortOptions($product_next);

    @endphp

    <div class="swiper-slide">
        <div class="compare-item">
            <div class="compare-item-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
               <a href="{{url('catalog',['slug' => $product->slug])}}">
                <div class="compare-item-image"><img class="image" src="{{asset($product->getMainImage()['paths'])}}" alt="product-card-image"></div>
                <div class="compare-item-title">{{$product->title}}</div>
                <svg data-product-id="<?= $product->id ?>" class="product-card-delete delete-compare" width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="8.84375" y="19.4492" width="15" height="1" transform="rotate(-45 8.84375 19.4492)" fill="#2CABE1"/>
                    <rect x="9.55078" y="8.84375" width="15" height="1" transform="rotate(45 9.55078 8.84375)" fill="#2CABE1"/>
                </svg>
               </a>
            </div>
            <div class="compare-item-body">
                <div class="compare-item-list">
                    @foreach($options as $k=>$option)
                    @php
                        $key = array_search($option['name'], array_column($prod_arr, 'name'));

                    @endphp

                    @if(($key!==false))
                    <div class="compare-list-row" data-row="<?= \App\Helpers\Helper::getNotEqualField($product,$prod_arr[$key]['name'],$product_type) ?>"  >
                        <div class="compare-caption">{{$prod_arr[$key]['name']}} :</div>
                        <div class="compare-value">{{$prod_arr[$key]['desc'] ?? ''}}</div>
                    </div>
                        @else

                    <div class="compare-list-row" data-row="<?= \App\Helpers\Helper::getNotEqualField($product,$option['name'],$product_type) ?>"  >
                        <div class="compare-caption">{{$option['name']}} :</div>
                        <div class="compare-value"></div>
                    </div>
                        @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
@endforeach
<?php } ?>
