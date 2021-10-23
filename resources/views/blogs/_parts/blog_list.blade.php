@foreach ($blogs as $blog)
    <div class="section-usecases-column use-cases-column">
        <div class="usecase-box aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
            <a class="usecase-box-inner" href="{{url('knowledge',['category' => str_replace(' ', '-', strtolower($blog->category()->name)), 'slug' => $blog->slug])}}">
                <div class="usecase-box-image">
                    <img class="image b-lazy b-loaded" src="{{ $blog->banner_image }}" title="{{ $blog->title }}" alt="{{ $blog->slug }}">
                </div>
                <div class="usecase-box-caption knowledge-box-caption">
                    <h5 class="usecase-box-description knowledge-box-min">Expertise - {{ $blog->reading_time }}</h5>
                    <h3 class="usecase-box-title knowledge-box-title">{{ $blog->title }}</h3>
                    <h5 class="usecase-box-description knowledge-box-min">By {{ $blog->author }}</h5>
                </div>
            </a>
        </div>
    </div>
@endforeach