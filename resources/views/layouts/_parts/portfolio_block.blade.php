@if(isset($homeData['case_studies']) && !empty($homeData['case_studies']->description))
<div class="subtitle-padding">
    {!! $homeData['case_studies']->description !!}
</div>
@endif
<div class="blog-teaser">
    <div class="teaser-wrapper">
        <div class="teaser-column">
            @if(isset($portflios[0]) && isset($portflios[0]->portfolio))
                <a class="teaser-link" href="{{url('projects-portfolio',['slug' => $portflios[0]->slug])}}">

                    <div class="teaser-card">
                        <div class="teaser-card-image">
                            <div class="teaser-card-image-inner" style="background-image: url('{{asset(\App\Helpers\Helper::getImgSrc($portflios[0]->portfolio->image))}}')">
                                <svg class="distributor-placeholder teaser-image-large" width="780" height="648"
                                     viewBox="0 0 780 648" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0" y="0" width="779" height="647" rx="3" ry="3" fill="none"></rect>
                                </svg>
                                <svg class="distributor-placeholder teaser-image-small" width="378" height="261"
                                     viewBox="0 0 378 261" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0" y="0" width="378" height="261" rx="3" ry="3" fill="none"></rect>
                                </svg>
                            </div>
                        </div>
                        <div class="teaser-card-caption">
                            <div class="teaser-card-title">{!! $portflios[0]->title !!}</div>
                        </div>
                    </div>

                </a>
            @endif
        </div>
        <div class="teaser-column">
            @if(isset($portflios[1]) && isset($portflios[1]->portfolio))
                <a class="teaser-link" href="{{url('projects-portfolio',['slug' => $portflios[1]->slug])}}">

                    <figure class="teaser-card">
                        <div class="teaser-card-image">
                            <div class="teaser-card-image-inner" style="background-image: url('{{ asset(\App\Helpers\Helper::getImgSrc($portflios[1]->portfolio->image))}}')">
                                <svg class="distributor-placeholder" width="378" height="261" viewBox="0 0 378 261"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect class="teaser-image-small" x="0" y="0" width="378" height="261" rx="3" ry="3"
                                          fill="none"></rect>
                                </svg>
                            </div>
                        </div>
                        <figcaption class="teaser-card-caption">
                            <div class="teaser-card-title">{!! $portflios[1]->title !!}</div>
                        </figcaption>
                    </figure>
                </a>
            @endif
            @if(isset($portflios[2]) && isset($portflios[2]->portfolio))
                <a class="teaser-link" href="{{url('projects-portfolio',['slug' => $portflios[2]->slug])}}">


                    <figure class="teaser-card">
                        <div class="teaser-card-image">
                            <div class="teaser-card-image-inner" style="background-image: url('{{asset(\App\Helpers\Helper::getImgSrc($portflios[2]->portfolio->image))}}')">
                                <svg class="distributor-placeholder" width="378" height="261" viewBox="0 0 378 261"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <rect class="teaser-image-small" x="0" y="0" width="378" height="261" rx="3" ry="3"
                                          fill="none"></rect>
                                </svg>
                            </div>
                        </div>
                        <figcaption class="teaser-card-caption">
                            <div class="teaser-card-title">{!! $portflios[2]->title !!}</div>
                        </figcaption>
                    </figure>
                </a>
            @endif
        </div>
    </div>
</div>
