@if(isset($homeData['key_areas']) && !empty($homeData['key_areas']->description))
<div class="subtitle-padding">
    {!! $homeData['key_areas']->description !!}
</div>
@endif
<div class="tabs keyarea-tab">
    <ul class="tab-panel keyarea-tab-panel">
        @foreach ($key_areas_arr as $key=> $key_area)
            <li class="tab-item keyarea-tab-item">
                <a class="tab-button keyarea-tab-button" href="#tab-{{$key}}"><span>{{$key_area['title']}}</span></a>
            </li>
        @endforeach
    </ul>
    @foreach ($key_areas_arr as $key=> $key_area)
        <div class="tab-section feature-tab" id="tab-{{$key}}">
            <article class="feature-post-article">
                <div class="feature-post-image">
                    <a class="feature-post-image-wrapper" href="{{url('key-areas',['slug' => $key_area['slug']])}}">
                        <img class="image" lazy="loading" src="{{asset(\App\Helpers\Helper::getImgSrc($key_area['image']))}}" alt="{{ $key_area['alt'] }}" title="{{ $key_area['pic_title'] }}"/>
                    </a>
                </div>
                <div class="feature-post-content">
                    <a class="feature-post-inner" href="{{url('key-areas',['slug' => $key_area['slug']])}}">
                        <h2 class="feature-post-title"></h2>
                        <p class="feature-post-excerpt">{!! strip_tags($key_area['text']) !!}</p>
                        <span class="learn-more-link"><span>Click to learn more</span></span>
                    </a>
                </div>
            </article>
        </div>
    @endforeach
</div>
