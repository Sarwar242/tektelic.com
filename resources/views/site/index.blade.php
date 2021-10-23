@extends('layout')
@section('metaTitle','Global IoT leader of End-to-End LoRaWAN solutions')
@section('metaDesc','Premier provider of Best-in-Class LoRaWAN Gateways, Sensors and End-to-End Solutions developed for reliability, scalability and cost-effective IoT deployments')
@section('content')
    <section class="section main-intro">
        <div class="main-intro-banner">
            <div class="intro-banner-slide">
                <div class="intro-banner-inner" style="background-image: url('<?= asset('images/intro-banner.jpg') ?>');" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                    <svg class="intro-banner-placeholder" width="1920" height="545" viewBox="0 0 1920 545" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect x="0" width="1920" height="545"></rect>
                    </svg>
                </div>
            </div>
            <div class="intro-banner-info">
                <div class="intro-container">
                    <div class="main-intro-about">
                        <div class="intro-about-article" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50"><?= \App\Models\StaticTextLang::t("Every year TEKTELIC enables hundreds of global IoT Operators and Enterprises to deploy <strong>the most cost effective, reliable and simple to operate IoT Networks and Solutions.</strong>",'main'); ?>
                        </div>
                        <div class="intro-about-exerpt" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                            <button class="main-button-white" data-fancybox data-src="#contact-us">contact us</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-brands-carousel">
                <div class="intro-container">
                    <div class="intro-brands-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50"><?= \App\Models\StaticTextLang::t("TEKTELIC Trusted Network of Customers and Partners",'main'); ?></div>
                    <div class="intro-brands-inner" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <!-- <div class="swiper-container" id="main-brands-carousel">
                            <div class="swiper-wrapper">
                                @foreach($slider__second_items['slider'] as $item)
                                    <div class="swiper-slide">
                                        <a class="brand-link" href="{{$item->link_product}}" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                            <img class="brand-logo b-lazy" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="{{asset($slider__second_items['images'][$item->id])}}" alt="logo">
                                        </a>
                                    </div>
                                @endforeach
                                {{--<div class="swiper-slide">
                                    <a class="brand-link" href="http://www.adtran.com" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="images/media/brands/adtran.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.lastmile.no/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="images/media/brands/last_mile.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.senetco.com" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/senet.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.conserv.io" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/conserv.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.arcade.ch/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/arcade.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.carebandremembers.com" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/careband.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.parametric.ch/solutions" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/parametric.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.felicitysi.com " target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/felicity.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.loriot.io/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/loriot.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://akenza.com/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/akenza.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://talkpool.com/internet-of-things/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/talkpool.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.poultrysenseltd.com/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/poultrysense.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://switzer.cloud/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/switzercloud.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://www.thethingsnetwork.org/#" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/TheThingsNetwork.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://redwireless.us/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/red_wireless.svg" alt="logo"></a></div>
                                <div class="swiper-slide">
                                    <a class="brand-link" href="https://bus.iparkiere.ch" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                        <img class="brand-logo" src="/uploads/brands/iParkiere_bus.svg" alt="logo"></a></div>--}}
                            </div>
                        </div> -->
                        <section id="main-brands-carousel" class="slider">
                            @foreach($slider__second_items['slider'] as $item)
                                <div class="slide"><a href="{{$item->link_product}}" target="_blank"><img src="{{asset($slider__second_items['images'][$item->id])}}"></a></div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
            <div class="intro-promo-banner">
                <div class="promo-banner-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50">
                    <div class="intro-promo-inner">
                        <div class="intro-promo-text"><?= \App\Models\StaticTextLang::t("We do it with great passion, experience, unmatched customer care to accelerate IoT adoption for everyone’s benefit and wellbeing.",'main'); ?></div>
                        <button class="intro-promo-action main-button" data-fancybox data-src="#contact-us">contact us</button>
                    </div>
                </div>
                <div class="promo-banner-footer" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <svg class="intro-promo-logo" width="1033" height="83" viewBox="0 0 1033 83" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 78.5786V2H23.0652V78.5786H2ZM117.63 20.3357H95.5922V78.5786H74.5272V20.3357H52.3818V2H117.63V20.3357Z" stroke="#2CABE1" stroke-width="4"/>
                        <path d="M159.783 58.5175C160 58.6613 160.468 58.913 161.188 59.2725C161.908 59.632 162.808 59.9915 163.889 60.3511C164.969 60.7106 166.193 61.0342 167.561 61.3218C169.002 61.6094 170.478 61.7532 171.991 61.7532C174.223 61.7532 176.023 61.3937 177.392 60.6746C178.76 59.9556 179.804 58.8051 180.525 57.2232C181.245 55.5694 181.713 53.4841 181.929 50.9675C182.145 48.3789 182.253 45.2511 182.253 41.5839V2.64749H203.318V41.5839C203.318 47.4082 202.994 52.7291 202.346 57.5468C201.698 62.2925 200.293 66.3551 198.133 69.7346C195.972 73.1141 192.804 75.7387 188.627 77.6082C184.522 79.4777 178.976 80.4125 171.991 80.4125C165.509 80.4125 159.964 78.8306 155.354 75.6668L159.783 58.5175ZM270.732 61.2139C273.18 61.2139 275.269 60.6746 276.997 59.5961C278.726 58.5175 280.13 57.1153 281.21 55.3896C282.291 53.592 283.083 51.5427 283.587 49.2418C284.091 46.9408 284.343 44.532 284.343 42.0153V2.64749H305.408V42.0153C305.408 47.3363 304.724 52.3337 303.356 57.0075C301.988 61.6094 299.863 65.6001 296.982 68.9796C294.102 72.3591 290.465 75.0196 286.072 76.961C281.751 78.9025 276.637 79.8732 270.732 79.8732C264.61 79.8732 259.353 78.8665 254.96 76.8532C250.639 74.768 247.074 71.9996 244.265 68.5482C241.457 65.0968 239.404 61.1061 238.108 56.5761C236.811 51.9742 236.163 47.1206 236.163 42.0153V2.64749H257.229V42.0153C257.229 44.532 257.481 46.9768 257.985 49.3496C258.489 51.6506 259.281 53.6999 260.361 55.4975C261.442 57.2232 262.81 58.6253 264.466 59.7039C266.195 60.7106 268.283 61.2139 270.732 61.2139ZM385.582 27.6703C383.421 26.3761 381.189 25.2256 378.884 24.2189C376.94 23.3561 374.743 22.5651 372.295 21.8461C369.918 21.0551 367.577 20.6596 365.273 20.6596C363.4 20.6596 361.888 20.9472 360.736 21.5225C359.656 22.0977 359.115 23.0684 359.115 24.4346C359.115 25.4413 359.439 26.2682 360.088 26.9153C360.736 27.5625 361.672 28.1737 362.896 28.7489C364.121 29.2522 365.597 29.7556 367.325 30.2589C369.126 30.7623 371.142 31.3734 373.375 32.0925C376.904 33.1711 380.073 34.3575 382.881 35.6518C385.762 36.946 388.211 38.492 390.227 40.2896C392.244 42.0153 393.792 44.1365 394.872 46.6532C395.952 49.1699 396.493 52.2258 396.493 55.8211C396.493 60.423 395.628 64.3058 393.9 67.4696C392.244 70.5615 390.011 73.0423 387.202 74.9118C384.466 76.7813 381.333 78.1475 377.804 79.0103C374.347 79.8013 370.854 80.1968 367.325 80.1968C364.517 80.1968 361.636 79.9811 358.683 79.5496C355.731 79.1182 352.778 78.507 349.825 77.7161C346.944 76.9251 344.136 75.9903 341.399 74.9118C338.734 73.8332 336.25 72.6108 333.945 71.2446L343.019 52.8011C345.54 54.383 348.169 55.7851 350.905 57.0075C353.21 58.0861 355.803 59.0568 358.683 59.9196C361.636 60.7825 364.625 61.2139 367.65 61.2139C369.954 61.2139 371.538 60.9263 372.403 60.3511C373.339 59.7039 373.807 58.877 373.807 57.8703C373.807 56.7918 373.339 55.893 372.403 55.1739C371.538 54.383 370.314 53.6999 368.73 53.1246C367.145 52.5494 365.309 51.9741 363.22 51.3989C361.204 50.8237 359.043 50.1406 356.739 49.3496C353.354 48.1991 350.437 46.9768 347.989 45.6825C345.54 44.3163 343.524 42.8063 341.939 41.1525C340.355 39.4268 339.166 37.4853 338.374 35.3282C337.654 33.1711 337.294 30.6903 337.294 27.8861C337.294 23.6437 338.05 19.9046 339.563 16.6689C341.147 13.4332 343.272 10.7368 345.936 8.57963C348.601 6.42248 351.626 4.80463 355.01 3.72606C358.467 2.57558 362.104 2.00034 365.921 2.00034C368.73 2.00034 371.466 2.28797 374.131 2.86321C376.796 3.36654 379.352 4.04963 381.801 4.91249C384.322 5.70344 386.662 6.60224 388.823 7.60891C390.983 8.54367 392.928 9.44249 394.656 10.3053L385.582 27.6703ZM487.147 20.9832H465.11V79.2261H444.044V20.9832H421.899V2.64749H487.147V20.9832ZM570.427 3.24891H589.764L596.462 26.8696L603.267 3.24891H622.604L609.965 39.8125L615.474 55.7753L632.003 3.24891H654.904L624.873 79.8275H607.372L596.462 52.4318L585.659 79.8275H568.159L538.127 3.24891H560.921L577.557 55.7753L582.85 39.8125L570.427 3.24891ZM713.273 80.4746C707.44 80.4746 702.146 79.3601 697.393 77.131C692.64 74.902 688.571 71.9899 685.186 68.3946C681.801 64.7275 679.173 60.557 677.3 55.8832C675.428 51.2094 674.492 46.3917 674.492 41.4303C674.492 36.397 675.464 31.5434 677.408 26.8696C679.353 22.1958 682.054 18.0972 685.51 14.5739C689.039 10.9787 693.18 8.13841 697.933 6.05317C702.759 3.89603 708.016 2.81747 713.705 2.81747C719.539 2.81747 724.832 3.932 729.585 6.16105C734.338 8.3901 738.407 11.3382 741.792 15.0053C745.177 18.6725 747.77 22.8429 749.57 27.5168C751.443 32.1906 752.379 36.9723 752.379 41.8618C752.379 46.8951 751.407 51.7487 749.462 56.4225C747.518 61.0244 744.817 65.1229 741.36 68.7182C737.903 72.2415 733.762 75.0818 728.937 77.2389C724.184 79.396 718.963 80.4746 713.273 80.4746ZM695.881 41.646C695.881 44.2346 696.241 46.7513 696.961 49.196C697.681 51.5689 698.762 53.6901 700.202 55.5596C701.642 57.4291 703.443 58.9391 705.603 60.0896C707.836 61.2401 710.465 61.8153 713.489 61.8153C716.514 61.8153 719.143 61.2401 721.375 60.0896C723.608 58.8672 725.408 57.3213 726.776 55.4518C728.217 53.5103 729.261 51.3172 729.909 48.8725C730.629 46.4277 730.99 43.947 730.99 41.4303C730.99 38.8417 730.629 36.361 729.909 33.9882C729.189 31.5434 728.073 29.4222 726.56 27.6246C725.12 25.7551 723.284 24.281 721.051 23.2025C718.89 22.052 716.334 21.4768 713.381 21.4768C710.356 21.4768 707.728 22.052 705.495 23.2025C703.335 24.353 701.534 25.8989 700.094 27.8403C698.654 29.7098 697.573 31.867 696.853 34.3118C696.205 36.6846 695.881 39.1294 695.881 41.646ZM782.912 79.8275V3.24891H818.129C821.874 3.24891 825.331 4.03985 828.5 5.62176C831.668 7.13176 834.369 9.14509 836.602 11.6618C838.906 14.1065 840.706 16.9468 842.003 20.1825C843.299 23.3463 843.947 26.5461 843.947 29.7818C843.947 34.2399 842.975 38.4103 841.031 42.2932C839.086 46.1041 836.386 49.232 832.929 51.6768L849.133 79.8275H825.367L811.863 56.3146H803.978V79.8275H782.912ZM803.978 37.9789H817.265C818.561 37.9789 819.749 37.2598 820.83 35.8218C821.982 34.3837 822.558 32.3703 822.558 29.7818C822.558 27.1213 821.91 25.1079 820.614 23.7417C819.317 22.3037 818.021 21.5846 816.725 21.5846H803.978V37.9789ZM877.415 79.8275V3.24891H898.48V32.3703L921.814 3.24891H945.579L917.708 37.5475L947.524 79.8275H923.326L904.313 51.6768L898.48 57.7167V79.8275H877.415ZM1020.06 28.2718C1017.9 26.9775 1015.66 25.827 1013.36 24.8203C1011.41 23.9575 1009.22 23.1665 1006.77 22.4475C1004.39 21.6565 1002.05 21.261 999.747 21.261C997.875 21.261 996.362 21.5487 995.21 22.1239C994.13 22.6991 993.59 23.6698 993.59 25.036C993.59 26.0427 993.913 26.8696 994.562 27.5168C995.21 28.1639 996.146 28.7751 997.37 29.3503C998.595 29.8537 1000.07 30.357 1001.8 30.8603C1003.6 31.3637 1005.62 31.9749 1007.85 32.6939C1011.38 33.7725 1014.55 34.9589 1017.36 36.2532C1020.24 37.5475 1022.68 39.0934 1024.7 40.891C1026.72 42.6168 1028.27 44.738 1029.35 47.2546C1030.43 49.7713 1030.97 52.8272 1030.97 56.4225C1030.97 61.0244 1030.1 64.9072 1028.37 68.0711C1026.72 71.163 1024.49 73.6437 1021.68 75.5132C1018.94 77.3827 1015.81 78.7489 1012.28 79.6118C1008.82 80.4027 1005.33 80.7982 1001.8 80.7982C998.991 80.7982 996.11 80.5825 993.157 80.151C990.205 79.7196 987.252 79.1084 984.299 78.3175C981.419 77.5265 978.61 76.5917 975.873 75.5132C973.208 74.4346 970.724 73.2122 968.419 71.846L977.494 53.4025C980.014 54.9844 982.643 56.3865 985.38 57.6089C987.684 58.6875 990.277 59.6582 993.157 60.5211C996.11 61.3839 999.099 61.8153 1002.12 61.8153C1004.43 61.8153 1006.01 61.5277 1006.88 60.9525C1007.81 60.3053 1008.28 59.4784 1008.28 58.4718C1008.28 57.3932 1007.81 56.4944 1006.88 55.7753C1006.01 54.9844 1004.79 54.3013 1003.2 53.726C1001.62 53.1508 999.783 52.5756 997.695 52.0003C995.678 51.4251 993.517 50.742 991.213 49.9511C987.828 48.8006 984.911 47.5782 982.463 46.2839C980.014 44.9177 977.998 43.4077 976.413 41.7539C974.829 40.0282 973.641 38.0867 972.848 35.9296C972.128 33.7725 971.768 31.2918 971.768 28.4875C971.768 24.2451 972.524 20.506 974.037 17.2703C975.621 14.0346 977.746 11.3382 980.41 9.18106C983.075 7.02392 986.1 5.40604 989.485 4.32747C992.941 3.177 996.578 2.60177 1000.4 2.60177C1003.2 2.60177 1005.94 2.88938 1008.61 3.46462C1011.27 3.96795 1013.83 4.65105 1016.28 5.5139C1018.8 6.30485 1021.14 7.20367 1023.3 8.21033C1025.46 9.1451 1027.4 10.0439 1029.13 10.9068L1020.06 28.2718Z" stroke="#2CABE1" stroke-width="4"/>
                        <circle cx="48.5" cy="52.5" r="19.5" fill="#F74429"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>
    <!--     <section class="section main-intro">
        <div class="main-intro-banner">
            <div class="intro-banner-back">
                <div class="intro-background-image" style="background-image: url('/uploads/intro-banner.jpg');"></div>
            </div>
            <div class="intro-banner-front">
                <div class="container">
                    <div class="intro-banner-row">
                        <div class="intro-banner-cell">
                            <atricle class="main-atricle aos-init aos-animate" data-aos="fade-in" data-aos-delay="0">
                                <header data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50" class="aos-init aos-animate">
                                    <h2 class="main-content-title">Every year TEKTELIC enables hundreds of global IoT Operators and Enterprises to deploy the most cost-effective, reliable and simple to operate IoT Networks and Solutions.</h2>
                                </header>
                                <footer data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150" class="aos-init aos-animate">
                                    <button class="main-button" data-fancybox="" data-src="#contact-us" href="javascript:;">contact us</button>
                                </footer>
                            </atricle>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-intro-info">
            <div class="scroll-down">
                <svg width="26" height="39" viewBox="0 0 26 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1" y="1" width="24" height="37" rx="12" stroke="white" stroke-width="2"></rect>
                    <rect x="12" y="20" width="2" height="11" fill="white"></rect>
                </svg>
            </div>
            <div class="container">
                <div class="main-intro-about">
                    <div class="intro-about-article">
                        <div class="intro-about-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50"><?= \App\Models\StaticTextLang::t("TEKTELIC’s LoRaWAN® IoT End-to-End Solutions",'main'); ?></div>
                        <div class="intro-about-exerpt" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150"><?= \App\Models\StaticTextLang::t("low total cost of ownership and best in class performance",'main'); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-brands-carousel">
            <div class="main-brands-inner">
                <div class="swiper-container" id="main-brands-carousel">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://aws.amazon.com/iot-core/lorawan/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="images/media/brands/amazon.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="http://www.adtran.com" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="images/media/brands/adtran.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.lastmile.no/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="images/media/brands/last_mile.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.senetco.com" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/senet.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.conserv.io" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/conserv.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.arcade.ch/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/arcade.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.carebandremembers.com" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/careband.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.parametric.ch/solutions" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/parametric.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.felicitysi.com " target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/felicity.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.loriot.io/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/loriot.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://akenza.com/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/akenza.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://talkpool.com/internet-of-things/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/talkpool.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.poultrysenseltd.com/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/poultrysense.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://switzer.cloud/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/switzercloud.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://www.thethingsnetwork.org/#" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/TheThingsNetwork.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://redwireless.us/" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/red_wireless.svg" alt="logo"></a></div>
                        <div class="swiper-slide">
                            <a class="brand-link" href="https://bus.iparkiere.ch" target="_blank" data-aos="fade-in" data-aos-duration="1000">
                                <img class="brand-logo" src="/uploads/brands/iParkiere_bus.svg" alt="logo"></a></div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!--     <section class="section main-intro">
        <div class="main-intro-wrapper">
            <div class="main-gallery-slider">
                <div class="swiper-container" id="main-gallery-slider">
                    <div class="swiper-wrapper">
                        @foreach($slider_items['slider'] as $slider_item)
        <div class="swiper-slide">
            <div class="main-gallery-slide-inner">
                <img class="image" src="{{asset($slider_items['images'][$slider_item->id])}}" alt="">
                                </div>
                            </div>
                        @endforeach
        </div>
        <div class="swiper-pagination" id="main-gallery-pagination"></div>
        <div class="swiper-button-prev" id="main-gallery-button-prev">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M27 18C27.5523 18 28 17.5523 28 17C28 16.4477 27.5523 16 27 16L27 18ZM6.29289 16.2929C5.90237 16.6834 5.90237 17.3166 6.29289 17.7071L12.6569 24.0711C13.0474 24.4616 13.6805 24.4616 14.0711 24.0711C14.4616 23.6805 14.4616 23.0474 14.0711 22.6569L8.41421 17L14.0711 11.3431C14.4616 10.9526 14.4616 10.3195 14.0711 9.92893C13.6805 9.53841 13.0474 9.53841 12.6569 9.92893L6.29289 16.2929ZM27 16L7 16L7 18L27 18L27 16Z" fill="white"/>
                <rect width="34" height="34" fill="none" fill-opacity="0.1"/>
            </svg>
        </div>
        <div class="swiper-button-next" id="main-gallery-button-next">
            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 16C6.44772 16 6 16.4477 6 17C6 17.5523 6.44772 18 7 18L7 16ZM27.7071 17.7071C28.0976 17.3166 28.0976 16.6834 27.7071 16.2929L21.3431 9.92893C20.9526 9.53841 20.3195 9.53841 19.9289 9.92893C19.5384 10.3195 19.5384 10.9526 19.9289 11.3431L25.5858 17L19.9289 22.6569C19.5384 23.0474 19.5384 23.6805 19.9289 24.0711C20.3195 24.4616 20.9526 24.4616 21.3431 24.0711L27.7071 17.7071ZM7 18L27 18L27 16L7 16L7 18Z" fill="white"/>
                <rect width="34" height="34" fill="none" fill-opacity="0.1"/>
            </svg>
        </div>
    </div>
</div>
<div class="main-content-slider">
    <div class="container">
        <div class="swiper-container" id="main-content-slider">
            <div class="swiper-wrapper">
@foreach($slider_items['slider'] as $slider_item)
        <div class="swiper-slide">
            <div class="main-content-slide">
                <div class="main-content-inner" data-aos="fade-in" data-aos-delay="0">
<?= $slider_item->title ?>
        <?= $slider_item->text ?>
        <?php if(!empty($slider_item->button_text)){ ?>
            <a class="main-content-button" href="{{$slider_item->link_product}}"><?= $slider_item->button_text ?></a>
                                            <?php } ?>
            </div>
        </div>
    </div>
@endforeach
        </div>
    </div>
</div>
</div>
</div>
<div class="main-intro-footer">
<div class="scroll-down">
<svg width="26" height="39" viewBox="0 0 26 39" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect x="1" y="1" width="24" height="37" rx="12" stroke="white" stroke-width="2"/>
    <rect x="12" y="20" width="2" height="11" fill="white"/>
</svg>
</div>
<div class="container">
<div class="main-intro-about">
    <div class="intro-about-article">
        <div class="intro-about-title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="50"><?= \App\Models\StaticTextLang::t("TEKTELIC’s LoRaWAN® IoT End-to-End Solutions",'main'); ?></div>
                        <div class="intro-about-exerpt" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150"><?= \App\Models\StaticTextLang::t("low total cost of ownership and best in class performance",'main'); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <section class="section use-cases">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="500" data-aos-delay="50">
                <div class="feature-headings" data-title="<?= strip_tags(\App\Models\StaticTextLang::t("Use <b>cases</b>",'main')); ?>">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Use <b>cases</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body">
                @include('layouts._parts.use_cases_block',['use_cases' => $use_cases])
            </div>
            <div class="section-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="100">
                <a class="view-all" href="<?= url('use-cases') ?>"><span><?= \App\Models\StaticTextLang::t("Click to learn more",'main'); ?></span></a>
            </div>
        </div>
    </section>
    <section class="section key-areas">
        <div class="container">
            <div class="section-header" data-title="key areas" data-aos="fade-in" data-aos-duration="1000">
                <div class="feature-headings" data-title="<?= strip_tags(\App\Models\StaticTextLang::t("Key <b>areas</b>",'main')); ?>">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Key <b>areas</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000">
                @include('layouts._parts.key_areas_block',['key_areas_arr' => $key_areas_arr])
            </div>
        </div>
    </section>
    <section class="section projects-portfolio">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <div class="feature-headings" data-title="<?= \App\Models\StaticTextLang::t("Portfolio",'bgtext_main'); ?>">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Projects <b>portfolio</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                @include('layouts._parts.portfolio_block',['portflios' => $portflios])
            </div>
            <div class="section-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <a class="view-all" href="<?= url('projects-portfolio') ?>"><span><?= \App\Models\StaticTextLang::t("View all projects",'main'); ?></span></a>
            </div>
        </div>
    </section>
    <section class="section popular-products">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <div class="feature-headings">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("Popular <b>products</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                @include('layouts._parts.product_block',['products' => $products])
            </div>
            <div class="section-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="250">
                <a class="view-all" href="{{url('catalog')}}"><span><?= \App\Models\StaticTextLang::t("View all products",'main'); ?></span></a>
            </div>
        </div>
        <div class="products-background">
            <div class="products-background-inner">
                <div class="products-background-image">
                    <img src="{{asset('images/theme/products.svg')}}" alt="popular products">
                </div>
            </div>
        </div>
    </section>
    <section class="section pdf-block">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <div class="feature-headings" data-title="<?= \App\Models\StaticTextLang::t("Whitepapers",'bgtext_main'); ?>">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("<b>Whitepapers</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                @include('layouts._parts.pdf_block',['pdfs' => $pdfs])
            </div>
            <div class="section-footer" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <a class="view-all" href="<?= url('whitepapers') ?>"><span><?= \App\Models\StaticTextLang::t("View all",'main'); ?></span></a>
            </div>
        </div>
    </section>
    <!-- #SID - 30-video-section-for-the-homepage -->
    <section class="section popular-products video-block">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <div class="feature-headings">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("<b>Videos</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                @include('layouts._parts.video_section',['videos' => $videos])
            </div>
        </div>
    </section>
    <!-- #SID - 46-testimonials-slider-section-for-the-homepage -->
    @if(count($testimonials) > 0 && !empty($testimonials))
    <section class="section pdf-block">
        <div class="container">
            <div class="section-header" data-aos="fade-in" data-aos-duration="1000" data-aos-delay="50">
                <div class="feature-headings" data-title="<?= \App\Models\StaticTextLang::t("Testimonials",'bgtext_main'); ?>">
                    <h2 class="section-title"><?= \App\Models\StaticTextLang::t("<b>Testimonials</b>",'main'); ?></h2>
                </div>
            </div>
            <div class="section-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                @include('layouts._parts.testimonial_block',['testimonials' => $testimonials])
            </div>
        </div>
    </section>
    @endif
    <!-- <section class="section recent-posts">
        @include('layouts._parts.news_block',['articles' => $articles,'title'=> \App\Models\StaticTextLang::t("<b>News</b>",'main') ])
    </section> -->
    @include('layouts.contact-us', ['entity' => $seo_block])
@endsection

@section('footer')

@endsection()
