<?php if(!empty($wishlists)){ ?>
@foreach($wishlists as $wishlist)
    @php
        $product = $wishlist->product;
    @endphp
    @if(!empty($product))
        <div class="wishlist-column">
            <div class="product-card">
                <div class="product-card-inner border-box">

                    <svg data-product-id="<?= $product->id ?>" class="product-card-delete delete-wishlist" width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8.84375" y="19.4492" width="15" height="1" transform="rotate(-45 8.84375 19.4492)" fill="#2CABE1"/>
                    <rect x="9.55078" y="8.84375" width="15" height="1" transform="rotate(45 9.55078 8.84375)" fill="#2CABE1"/>
                    </svg>

                    <a class="product-card-link" href="{{url('catalog',['slug' => $product->slug])}}">
                        <div class="product-card-image">
                            <picture class="image">
                                <source media="(min-width: 0px)" data-srcset="{{asset($product->getMainImage()['paths'])}}"/>
                                <source media="(min-width: 576px)" data-srcset="{{asset($product->getMainImage()['paths'])}}"/><img class="image" src="{{asset($product->getMainImage()['paths'])}}" alt="product-card-image"/>
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
                        </div></a>
                </div>
            </div>
        </div>
    @endif
@endforeach
<?php } ?>
