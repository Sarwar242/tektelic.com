@if(isset($homeData['products']) && !empty($homeData['products']->description))
<div class="subtitle-padding">
    {!! $homeData['products']->description !!}
</div>
@endif
<div class="feature-products">
    @foreach($products as $product)
        <div class="feature-product-column">
        <div class="product-card">
            <div class="product-card-inner shadow-box">
                <a class="product-card-link" href="{{url('catalog',['slug' => $product->slug])}}">
                    <div class="product-card-image">
                        <svg class="product-card-placeholder" width="240" height="240" viewBox="0 0 240 240" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0" y="0" width="240" height="240" rx="3" ry="3" fill="none"></rect>
                        </svg>
                        <picture class="image">
                            <source media="(min-width: 0px)" srcset="{{asset($product->getMainImage()['paths'])}}"/>
                            <source media="(min-width: 576px)" srcset="{{asset($product->getMainImage()['paths'])}}"/>
                            <img class="image" src="{{asset($product->getMainImage()['paths'])}}"
                                 alt="{{$product->getMainImage()['alt']}}"  loading='lazy'/>
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
            </div>
        </div>
    </div>
    @endforeach
</div>
