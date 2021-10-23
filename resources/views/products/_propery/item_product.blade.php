@foreach ($products as $product)
    @php
    $checkWishlist = \App\Wishlist::check($product);
    $checkCompare = \App\Comparison::check($product);
    if(empty($checkWishlist)){
        $wishlist_class='';
    }
    else{
         $wishlist_class='in-active';
    }
    if(empty($checkCompare)){
        $compare_class='';
    }
    else{
         $compare_class='in-active';
    }
    @endphp
    <div class="catalog-column">
    <div class="product-card">
        <div class="product-card-inner border-box">
            <a class="product-card-link" href="{{url('catalog',['slug' => $product->slug])}}">
                <div class="product-card-image">
                    <svg class="product-card-placeholder" width="240" height="240" viewBox="0 0 240 240" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0" y="0" width="240" height="240" rx="3" ry="3" fill="none"></rect>
                    </svg>
                    <picture class="image">
                        <source media="(min-width: 0px)" data-srcset="{{asset($product->getMainImage()['paths'])}}"/>
                        <source media="(min-width: 576px)" data-srcset="{{asset($product->getMainImage()['paths'])}}"/>
{{--                        TOD:FIX opacity 1 --}}
                        <img class="image" src="{{asset($product->getMainImage()['paths'])}}"
                             alt="{{$product->getMainImage()['alt']}}" title="{{$product->getMainImage()['title']}}" style="opacity: 1"/>
                    </picture>
                </div>
                <div class="product-card-content">
                    <h3 class="product-card-title">{{$product->title}}</h3>
                    <p class="product-card-excerpt">{{$product->subtitle}}</p>
                </div>
                <div class="product-card-description">
                    @foreach($product->decodeMainInformation() as $item)
                        <div class="product-card-description-item">{{$item->name}}:<span>{{$item->desc}}</span></div>
                    @endforeach
                </div>
            </a>
            <!-- при добавлении в избранное  добавить класс "in-active" (class="add-to-wishlist in-active")-->
            <div class="add-to-wishlist <?= $wishlist_class ?>" data-product-id="<?= $product->id ?>"></div>
            <!-- при добавлении к сравнению добавить класс "in-active" (class="add-to-compare in-active")-->
            <div class="add-to-compare <?= $compare_class ?>" data-product-id="<?= $product->id ?>"></div>
        </div>
    </div>
</div>
@endforeach
