<?php
use Illuminate\Support\Facades\Session;
?>
    <!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>TEKTELIC | @yield('metaTitle', 'Global IoT leader of End-to-End LoRaWAN solutions')</title>
    <meta name="description" content="@yield('metaDesc', 'Premier provider of Best-in-Class LoRaWAN Gateways, Sensors and End-to-End Solutions developed for reliability, scalability and cost-effective IoT deployments')">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="index, follow">
    <!-- basic favicons -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicons/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- basic styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('libraries/mCustomScrollbar/jquery.mCustomScrollbar.css') }}"> -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N5MX37X');</script>
    <!-- End Google Tag Manager -->
</head>
<body class="page-home">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N5MX37X"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@include('layouts.header')
<main class="site-content">
   @yield('content')
</main>
@include('layouts.footer')
<!-- Modal -->
<!-- Mobile menu-->
<div class="site-mobile-menu">
    <div class="site-mobile-menu-inner">
        <ul class="mobile-menu">
            @foreach (\App\Models\MenuItem::getTreeFront('left') as $item)
            <li class="mobile-menu-item"><a class="mobile-menu-link" href="<?= url($item->link) ?>">{{$item->title}}</a></li>
            @endforeach

        </ul>
        <ul class="mobile-socials">
            <li class="mobile-socials-item">
                <a class="mobile-socials-link" href="https://www.facebook.com/Tektelic1/" target="_blank">
                    <i class="mobile-socials-icon"><img src="/images/theme/social/facebook.svg" alt="follow us on facebook"></i></a></li>
            <li class="mobile-socials-item">
                <a class="mobile-socials-link" href="https://www.linkedin.com/company/tektelic/" target="_blank">
                    <i class="mobile-socials-icon"><img src="/images/theme/social/linkedin.svg" alt="follow us on linkedin"></i></a></li>
            <li class="mobile-socials-item">
                <a class="mobile-socials-link" href="https://www.instagram.com/tektelic/" target="_blank">
                    <i class="mobile-socials-icon"><img src="/images/theme/social/instagram.svg" alt="follow us on instagram"></i></a></li>
            <li class="mobile-socials-item">
                <a class="mobile-socials-link" href="https://twitter.com/tektelic" target="_blank">
                    <i class="mobile-socials-icon"><img src="/images/theme/social/twitter.svg" alt="follow us on twitter"></i></a></li>
        </ul>
    </div>
</div>
<!-- if KNOWLEDGE BASE page -->
<div class="offcanvas-aside" id="offcanvas-knowledge-base">
    <div class="offcanvas-bg"></div>
    <div class="offcanvas-bar">
        <div class="offcanvas-bar-header"><svg class="close-offcanvas" width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="8.84375" y="19.4492" width="15" height="1" transform="rotate(-45 8.84375 19.4492)" fill="#2CABE1"/>
                <rect x="9.55078" y="8.84375" width="15" height="1" transform="rotate(45 9.55078 8.84375)" fill="#2CABE1"/>
            </svg>
        </div>
        @widget('newsFilter',['type' => 'catalog'])
{{--        <div class="offcanvas-bar-body content">--}}
{{--            <div class="mobile-filters" id="knowledgeBase-filtrers" data-accordion-group>--}}
{{--                <!-- Use Case -->--}}
{{--                <div class="aside-widget accordion open" data-accordion>--}}
{{--                    <div class="widget-title trigger-arrow" data-control><strong>Use Case</strong></div>--}}
{{--                    <div class="widget-content" data-content>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Smart Cities</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Building Management</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Software</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Key Areas-->--}}
{{--                <div class="aside-widget accordion open" data-accordion>--}}
{{--                    <div class="widget-title trigger-arrow" data-control><strong>Key Areas</strong></div>--}}
{{--                    <div class="widget-content" data-content>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>IoT</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>3G-5G</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Custom Solutions &amp; Services</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Product type -->--}}
{{--                <div class="aside-widget accordion open" data-accordion>--}}
{{--                    <div class="widget-title trigger-arrow" data-control><strong>Product type</strong></div>--}}
{{--                    <div class="widget-content" data-content>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Sensors</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Gateways</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Software</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Use Case -->--}}
{{--                <div class="aside-widget accordion open" data-accordion>--}}
{{--                    <div class="widget-title trigger-arrow" data-control><strong>Use Case</strong></div>--}}
{{--                    <div class="widget-content" data-content>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Smart Cities</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Building Management</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Software</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Key Areas-->--}}
{{--                <div class="aside-widget accordion open" data-accordion>--}}
{{--                    <div class="widget-title trigger-arrow" data-control><strong>Key Areas</strong></div>--}}
{{--                    <div class="widget-content" data-content>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>IoT</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>3G-5G</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Custom Solutions &amp; Services</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Product type -->--}}
{{--                <div class="aside-widget accordion open" data-accordion>--}}
{{--                    <div class="widget-title trigger-arrow" data-control><strong>Product type</strong></div>--}}
{{--                    <div class="widget-content" data-content>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Sensors</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Gateways</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="widget-row">--}}
{{--                            <label class="checkbox-item">--}}
{{--                                <input type="checkbox"/><span>Software</span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="offcanvas-bar-footer">--}}
{{--            <button class="offcanvas-button">Apply</button>--}}
{{--        </div>--}}
    </div>
</div>
<!-- if CATALOG page -->
<div class="offcanvas-aside" id="offcanvas-catalog">
    <div class="offcanvas-bg"></div>
    <div class="offcanvas-bar">
        <div class="offcanvas-bar-header">
            <svg class="close-offcanvas" width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="8.84375" y="19.4492" width="15" height="1" transform="rotate(-45 8.84375 19.4492)" fill="#2CABE1"/>
                <rect x="9.55078" y="8.84375" width="15" height="1" transform="rotate(45 9.55078 8.84375)" fill="#2CABE1"/>
            </svg>
        </div>
        <div class="offcanvas-bar-body content">
            @widget('productFilter',['products' => Session::get('products'),'class' => 'catalog-mobile-filters'])
            {{--<div class="aside-widgets" id="catalog-mobile-filters" data-accordion-group>
                <!-- Product type -->
                <div class="aside-widget accordion open" data-accordion>
                    <div class="widget-title trigger-arrow" data-control><strong>Product type</strong></div>
                    <div class="widget-content" data-content>
                        <div class="widget-row">
                            <label class="checkbox-item">
                                <input type="checkbox"/><span>Sensors</span>
                            </label>
                        </div>
                        <div class="widget-row">
                            <label class="checkbox-item">
                                <input type="checkbox"/><span>Gateways</span>
                            </label>
                        </div>
                        <div class="widget-row">
                            <label class="checkbox-item">
                                <input type="checkbox"/><span>Software</span>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Category-->
                <div class="aside-widget accordion open" data-accordion>
                    <div class="widget-title trigger-arrow" data-control><strong>Category</strong></div>
                    <div class="widget-content" data-content>
                        <div class="widget-row">
                            <label class="checkbox-item">
                                <input type="checkbox"/><span>Global projects</span>
                            </label>
                        </div>
                        <div class="widget-row">
                            <label class="checkbox-item">
                                <input type="checkbox"/><span>medium scale</span>
                            </label>
                        </div>
                        <div class="widget-row">
                            <label class="checkbox-item">
                                <input type="checkbox"/><span>Micro scale</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
{{--        <div class="offcanvas-bar-footer">--}}
{{--            <button class="offcanvas-button">Apply</button>--}}
{{--        </div>--}}
    </div>
</div>
<!-- if PRODUCT PAGE page -->
<div id="contact-us" style="display: none;" class="">
    <div class="contact_us">
    <form class="contacts-form" method="POST" action="{{url('contact-us')}}">
        @csrf
        <div class="form-legend">
            <?php $heading = \App\Models\Headings::where('slug','contacts')->first();
            if(empty($heading->title)) { ?>
            <div class="form-title"><?= \App\Models\StaticTextLang::t("Get In Touch",'about_us'); ?></div>
            <?php } else { ?>
            <div class="form-title"><?= $heading->title ?></div>
            <?php } ?>
            {{-- <div class="form-subtitle"><?= \App\Models\StaticTextLang::t("We value your feedback. If you haven’t found the information that you are looking for on our web site, please don’t hesitate to get in touch with us using the form below.",'about_us'); ?></div> --}}
        </div>
        <div class="form-row">
            <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("First Name",'about_us'); ?></label>
            <input class="form-field" id="name" name="name" type="text">
        </div>
        <div class="form-row">
            <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("Last Name",'about_us'); ?></label>
            <input class="form-field" id="lastname" name="lastname" type="text">
        </div>
        <div class="form-row">
            <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("Company",'about_us'); ?></label>
            <input class="form-field" id="company" name="company" type="text">
        </div>
        <div class="form-row">
            <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("E-mail",'about_us'); ?></label>
            <input class="form-field" name="email" type="email" required>
        </div>
        <div class="form-row">
            <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("Phone number",'about_us'); ?></label>
            <input class="form-field" name="phone" type="tel">
            <input class="form-field htype" name="type" type="hidden" value="contact" >
        </div>
        <div class="form-row">
            <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("Message",'about_us'); ?></label>
            <textarea  class="form-field" name="text" id="text" rows="10" type="text"></textarea>
            <input class="form-field htype" name="type" type="hidden" value="contact" >
        </div>
        <div class="form-row">
            <div class="form-agreement">
                <input type="checkbox" id="contact-agreement-checkbox">
                <label for="contact-agreement-checkbox"><?= \App\Models\StaticTextLang::t("I agree to the",'footer_form'); ?>  <a target="_blank" href="https://tektelic.com/public/uploads/pages/TEKTELIC-Privacy-Policy.pdf"> Privacy Policy</a></label>
            </div>
        </div>
        <div class="form-group">
            <input class="form-submit contactus" type="submit" value="<?= \App\Models\StaticTextLang::t("send",'about_us'); ?>" >
        </div>
        <br />
        <p class="email_mess"></p>
        <div class="loader"></div>
    </form>
    </div>
</div>
<div id="download-pdf" style="display: none;" class="">
    <div class="contact_us" id="downloaded_pdf">
        <form class="download-pdf" method="POST" action="{{url('download-now')}}">
            @csrf
            <div class="form-legend">
                <div class="form-title">Download Now</div>
            </div>
            <p class='product-info-subtitle'>Thank you for visiting <strong>TEKTELIC KNOWLEDGE</strong> site.
                Our product development teams have significant experience designing,
                 developing and manufacturing Carrier Grade wireless products and
                  solutions for the cellular and LPWAN IoT technologies.
                  We are happy to share our knowledge and experience to enable the global IoT adoption,
                  reduce its cost, simplify its deployment and operational complexity.
                  Our mantra is to ensure the “IoT JUST WORKS” –
                 we believe in it and focus most our efforts to make it reality.</p>
            <p class='product-info-subtitle'>If you would like to leave your name and email,
                we would gladly add you to the next article release approximately every 2 weeks.
                However, you can visit this site any time and download
                any article without providing your contact information – we are here to share the knowledge.</p>
            <div class="form-row nameDiv">
                <label class="form-label label-margin">Name</label>
                <input class="form-field nameField" id="name" name="name" type="text">
            </div>
            <div class="form-row emailDiv">
                <label class="form-label label-margin">Email</label>
                <input class="form-field emailField" name="email" type="email">
            </div>
            <input class="form-field" name="type" type="hidden" value="whitepapers" >
            <input class="form-field" id="pdf_url" type="hidden" value="" >
            {{-- <div class="form-row companyDiv">
                <label class="form-label label-margin">Company Name</label>
                <input class="form-field companyField" name="company" type="text">
            </div> --}}
            <div class="form-row">
                <div class="form-agreement">
                    <input type="checkbox" id="pdf-download-agreement-checkbox">
                    <label for="pdf-download-agreement-checkbox"><?= \App\Models\StaticTextLang::t("I agree to the",'footer_form'); ?>  <a target="_blank" href="https://tektelic.com/public/uploads/pages/TEKTELIC-Privacy-Policy.pdf"> Privacy Policy</a></label>
                </div>
            </div>
            <div class="form-group">
                <input class="form-submit downloadNow" type="submit" disabled value="Download" >
            </div>
            <br />
            <p class="email_mess"></p>
            <div class="loader"></div>
        </form>
    </div>
</div>
<script defer src="{{ asset('js/libraries.min.js') }}"></script>
<!-- <script src="{{ asset('libraries/jquery/jquery-accordion.js') }}"></script> -->
<!-- <script src="{{ asset('libraries/tabslet/jquery.tabslet.min.js') }}"></script> -->
<!-- <script src="{{ asset('libraries/accordion/QuickAccord.min.js') }}"></script> -->
<!-- <script src="{{ asset('libraries/swiper-6.2.0/swiper-bundle.min.js') }}"></script> -->
<!-- <script src="{{ asset('libraries/jquery-nice-select/js/jquery.nice-selecttectelic.js') }}"></script> -->
<!-- <script src="{{ asset('libraries/mCustomScrollbar/jquery.mCustomScrollbar.js') }}"></script> -->
<!-- <script src="{{ asset('libraries/ion.rangeSlider/ion.rangeSlider.js') }}"></script> -->
<!-- <script src="{{ asset('libraries/minibar/minibar.min.js') }}"></script> -->
<!-- <script src="{{ asset('libraries/aos/aos.js') }}"></script> -->
<script defer src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
<script defer src="{{ asset('js/script.js') }}?v=1.0"></script>
<script defer src="{{ asset('js/filter.js') }}"></script>
<script defer src="{{ asset('js/load-data.js') }}"></script>
<script defer src="{{ asset('js/static-load-more/jquery.simpleLoadMore.min.js')}}"></script>
<script defer src="{{ asset('js/cookies-enabler.js') }}"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script defer>
    COOKIES_ENABLER.init({
        scriptClass: 'ce-script',
        iframeClass: 'ce-iframe',
        acceptClass: 'ce-accept',
        dismissClass: 'ce-dismiss',
        disableClass: 'ce-disable',
        bannerClass: 'ce-banner',
        bannerHTML: '<div class="ce-banner-inner"><span>We use cookies to personalise content and ads, to provide social media features and to analyse our traffic. This helps us to provide you with a good experience when you browse our website and also allows us to improve our site. By continuing to browse the site, you are agreeing to our use of cookies.</span>' + '<a href="#" class="ce-accept">' + 'ACCEPT' + '</a>' + '</div>',
        eventScroll: false,
        // scrollOffset: 200,
        clickOutside: true,
        cookieName: 'ce-cookie',
        // cookieDuration: '365',
        wildcardDomain: false,
        iframesPlaceholder: true,
        iframesPlaceholderHTML: '<p><span>We use cookies to personalise content and ads, to provide social media features and to analyse our traffic. This helps us to provide you with a good experience when you browse our website and also allows us to improve our site. By continuing to browse the site, you are agreeing to our use of cookies.</span>' + '<a href="#" class="ce-accept">ACCEPT</a>' + '</p>',
        iframesPlaceholderClass: 'ce-iframe-placeholder',
        // Callbacks
        onEnable: '',
        onDismiss: '',
        onDisable: ''
    });
</script>
@stack('scripts')
</body>
</html>
