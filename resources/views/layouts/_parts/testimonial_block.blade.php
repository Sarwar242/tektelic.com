<!-- #SID - 46-testimonials-slider-section-for-the-homepage -->
<section id="testimonial-carousel" class="slider">
    @if(isset($testimonials) && !empty($testimonials))
        @foreach($testimonials as $testimonial)
        <div class="slide">
            <a href="{{$testimonial->website_link}}" target="_blank">
                <div class="row testi-inner">
                    <div class="logo-area col-md-3 col-sm-12 col-xs-12 mx-0">
                        <img src="{{$testimonial->logo}}" alt="{{$testimonial->company_name}}"  loading='lazy'>
                    </div>
                    <div class="template-demo">
                        <p>{{$testimonial->quote}}</p>
                    </div>
                    <div class="author-details col-sm-12 px-0">
                        <div class="profile">
                            <h4 class="cust-name">{{$testimonial->speaker_name}}</h4>
                            <p class="cust-profession">{{$testimonial->position}}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    @endif
    <!-- <div class="slide">
        <div class="inner-slide col-md-12">
            <div class="logo-area col-md-3 col-sm-12 col-xs-12">
                <img src="https://brand.mastercard.com/content/dam/mccom/brandcenter/thumbnails/mastercard_hrz_pos_300px_2x.png">
            </div>
            <div class="content-area col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-sm-3">
                        <img class="profile-pic" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=50">
                    </div>
                    <div class="author-details col-sm-9">
                        <div class="profile">
                            <h4 class="cust-name">Delbert Simonas</h4>
                            <p class="cust-profession">Store Owner</p>
                        </div>
                    </div>
                </div>
                <div class="template-demo">
                    <p>When you think of Apple you automatically think expensive if your anything like me. When purchasing this laptop I was skeptical on laptops i purchased.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="slide">
        <div class="inner-slide col-md-12">
            <div class="logo-area col-md-3 col-sm-12 col-xs-12">
                <img src="https://brand.mastercard.com/content/dam/mccom/brandcenter/thumbnails/mastercard_hrz_pos_300px_2x.png">
            </div>
            <div class="content-area col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-sm-3">
                        <img class="profile-pic" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=50">
                    </div>
                    <div class="author-details col-sm-9">
                        <div class="profile">
                            <h4 class="cust-name">Delbert Simonas</h4>
                            <p class="cust-profession">Store Owner</p>
                        </div>
                    </div>
                </div>
                <div class="template-demo">
                    <p>When you think of Apple you automatically.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="slide">
        <div class="inner-slide col-md-12">
            <div class="logo-area col-md-3 col-sm-12 col-xs-12">
                <img src="https://brand.mastercard.com/content/dam/mccom/brandcenter/thumbnails/mastercard_hrz_pos_300px_2x.png">
            </div>
            <div class="content-area col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-sm-3">
                        <img class="profile-pic" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8dXNlcnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&w=1000&q=50">
                    </div>
                    <div class="author-details col-sm-9">
                        <div class="profile">
                            <h4 class="cust-name">Delbert Simonas</h4>
                            <p class="cust-profession">Store Owner</p>
                        </div>
                    </div>
                </div>
                <div class="template-demo">
                    <p>When you think of Apple you automatically think expensive if your anything like me. When purchasing this laptop I was skeptical on laptops i purchased.</p>
                </div>
            </div>
        </div>
    </div> -->
</section>
