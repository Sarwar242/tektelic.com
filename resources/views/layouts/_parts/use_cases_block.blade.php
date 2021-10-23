@if(isset($homeData['use_case']) && !empty($homeData['use_case']->description))
<div class="subtitle-padding">
    {!! $homeData['use_case']->description !!}
</div>
@endif
<div class="section-usecases-inner">
    @foreach ($use_cases as $use_case)
        <div class="section-usecases-column">
            <div class="usecase-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <a class="usecase-box-inner" href="{{url('use-cases',['slug' => $use_case->slug])}}">
                    <div class="usecase-box-image">
                        <img class="image b-lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{asset(\App\Helpers\Helper::getImgSrc(isset($use_case->useCase)?$use_case->useCase->image:''))}}" alt="{{ $use_case->alt }}" title="{{ $use_case->pic_title }}">
                    </div>
                    <div class="usecase-box-caption">
                        <h3 class="usecase-box-title">{{ $use_case->title }}</h3>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>
