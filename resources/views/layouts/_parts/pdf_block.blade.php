@if(isset($homeData['pdfs']) && !empty($homeData['pdfs']->description))
<!-- //SD -->
<div class="subtitle-padding">
    {!! $homeData['pdfs']->description !!}
</div>
@endif
<div class="portfolio-list">
    <div class="portfolio-list-inner">
        @foreach($pdfs as $pdf)
            @if(!empty($pdf))
        <div class="portfolio-list-column">
            <div class="hover-box" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                <div class="hover-box-inner">
                    <img class="image" src="{{$pdf->image}}" alt="{{$pdf->title}}" loading='lazy' title="{{$pdf->title}}">
                    <a class="hover-box-overlay" href="{{url('knowledge/whitepaper',['slug' => $pdf->slug])}}">
                        <div class="hover-box-header">
                            <h3 class="hover-box-title">{{$pdf->title}}</h3>
                        </div>
                        <div class="hover-box-content">
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($pdf->short_description), 198, $end='...') }}</p>
                        </div>
                        <div class="hover-box-footer">
                            <span class="learn-more-link">
                                <span><?= \App\Models\StaticTextLang::t("Click to learn more",'portfolio'); ?></span>
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
            @endif
        @endforeach
    </div>
</div>
