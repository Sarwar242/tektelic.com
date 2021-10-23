@extends('minilayout')
@section('metaTitle', 'eDoctor')
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags('The most simple to deploy IoT solution to monitor hospital patients, senior care residents, seniors living at home, high performance athletes and other vulnerable individuals who require constant respiratory health monitoring.') ))

@section('content')
    <div class="main-content">
        <!-- Section -->
        <section class="section doctor-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>eDoctor</h1>
                        <p>The most simple to deploy IoT solution to monitor hospital patients, senior care residents, seniors living at home, high performance athletes and other vulnerable individuals who require constant respiratory health monitoring.</p>
                        <a href="#myModal" data-toggle="modal" class="ehealth-video"><img src="{{ asset('mini/images/play-btn.png') }}">Watch Video</a>
                    </div>
                    <div class="col-md-6">
                        <div class="doctor-slider">
                            <div class="item">
                                <div class="doctor-img-box">
                                    <div class="doctor-product-img">
                                        <img src="{{ asset('mini/images/Respiratory Sensor-1.png') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="doctor-img-box">
                                    <div class="doctor-product-img">
                                        <img src="{{ asset('mini/images/Gold-Render-27-2.png') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="doctor-img-box">
                                    <div class="doctor-product-img">
                                        <img src="{{ asset('mini/images/Outdoor-tracing-device.png') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid doctor-nav-sec">
                <div class="row">
                    <div class="col-md-2 offset-md-2 d-flex align-items-center">
                        <ul class="social-media-menu">
                            <li class="social-media-menu-item">
                                <a href="https://www.facebook.com/Tektelic1/"
                                    class="social-media-menu-link"> <i class="fa
                                        fa-facebook"></i> </a>
                            </li>
                            <li class="social-media-menu-item">
                                <a href="https://www.instagram.com/tektelic/"
                                    class="social-media-menu-link"> <i class="fa
                                        fa-instagram"></i> </a>
                            </li>
                            <li class="social-media-menu-item">
                                <a href="https://www.linkedin.com/company/tektelic/"
                                    class="social-media-menu-link"> <i class="fa
                                        fa-linkedin"></i></a>
                            </li>
                            <li class="social-media-menu-item">
                                <a href="https://twitter.com/tektelic"
                                    class="social-media-menu-link"> <i class="fa
                                        fa-twitter"></i> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-8 px-0">
                        <div class="doctor-nav">
                            <div class="item">
                                <div class="doctor-nav-img-box">
                                    <div class="doctor-nav-product-img">
                                        <img src="{{ asset('mini/images/Respiratory Sensor-1.png') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="doctor-nav-img-box">
                                    <div class="doctor-nav-product-img">
                                        <img src="{{ asset('mini/images/Gold-Render-27-2.png') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="doctor-nav-img-box">
                                    <div class="doctor-nav-product-img">
                                        <img src="{{ asset('mini/images/Outdoor-tracing-device.png') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section -->
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center pr-lg-5 mb-5 mb-lg-0">
                        <img src="{{ asset('mini/images/product/image-gold-render-belt.png') }}" alt="Product with belt" class="mr-lg-5" />
                    </div>
                    <div class="col-lg-6 ">
                        <p class="section-content">
                            TEKTELIC eDoctor is an End-to-End respiratory health monitoring IoT solution designed to monitor individuals who require constant respiratory monitoring or are at a high risk of adverse effects from respiratory illness. With a sleek, wearable chest band device, eDoctor provides constant monitoring of key respiratory vital signs including Heart Rate, Respiration Rate, Body Temperature, Chest Expansion, Activity Level and Body Position and displays the data in a comprehensive, user friendly application. The eDoctor device can provide continuous monitoring for 3 to 4 months with an easy-to-replace coin cell battery, providing a highly reliable, low-maintenance and simple-to-deploy monitoring solution.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- End section -->

        <!-- Section -->
        <section class="section">
            <div class="container-fluid">
                <h2 class="section-heading section-heading-small section-heading-primary text-center">Continuously monitor</h2>
                
                <div class="features-list">
                    <div class="features-item">
                        <img src="{{ asset('mini/images/RespiratoryBreathingRate.svg') }}">
                        <h6 class="features-title">Respiration (Breathing) Rate</h6>
                    </div>
                    <div class="features-item">
                        <img src="{{ asset('mini/images/HeartRate.svg') }}">
                        <h6 class="features-title">Heart Rate</h6>
                    </div>
                    <div class="features-item">
                        <img src="{{ asset('mini/images/BodyTemperature.svg') }}">
                        <h6 class="features-title">Body Temperature</h6>
                    </div>
                    <div class="features-item">
                        <img src="{{ asset('mini/images/ChestExpansion.svg') }}">
                        <h6 class="features-title">Chest Expansion</h6>
                    </div>
                    <div class="features-item">
                        <img src="{{ asset('mini/images/PhysicalActivity.svg') }}">
                        <h6 class="features-title">Activity</h6>
                    </div>
                    <div class="features-item">
                        <img src="{{ asset('mini/images/BodyPosition.svg') }}">
                        <h6 class="features-title">Body Position</h6>
                    </div>
                </div>

            </div>
        </section>
        <!-- End section -->
        
        <!-- Section -->
        <section class="section easy-comfort-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex align-items-center pr-lg-5 mb-5 mb-lg-0">
                        <img src="{{ asset('mini/images/product/image-easy-comfortable-to-wear-in-everyday-life.png') }}" alt="Product with belt" class="mr-lg-5" />
                    </div>
                    <div class="col-lg-6 d-flex align-items-center">
                        <div>
                            <h2 class="section-heading">
                                Easy & Comfortable <br>
                                to Wear in everyday life
                            </h2>
                            <p class="section-content">
                                The comfortable chest band combined with the sleek and discreet form factor allows the eDoctor device to be worn comfortably in any environment under any clothing. Whether you are training for the next marathon or relaxing at home, the eDoctor device will provide all of the data you need without getting in the way.
                            </p>
                            <a data-toggle="modal" data-target="#contact-us" href="javascript:void(0)" class="btn btn-primary">contact us</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End section -->

        <!-- Section -->
        <section class="section intrest-slider">
            <div class="container-fluid">
                <div class="pl-0 pl-lg-5 row align-items-center">
                    <div class="pl-lg-5 col-md-5 col-md-6">
                        <h2 class="mb-4">Key Technical Features</h2>
                        <p><strong>&#8226;</strong> Battery Life: Up to 4 Months</p>
                        <p><strong>&#8226;</strong> Battery Type: CR2450 Coin Cell (Self Replaceable)</p>
                        <p><strong>&#8226;</strong> Operational Temperature: 0°C to 40°C</p>
                        <p><strong>&#8226;</strong> Body Temperature Accuracy: 0.05°C from 35°to 40°C</p>
                        <p><strong>&#8226;</strong> Device Size: 66.0 x 36.2 x 11.7 mm</p>
                        <p><strong>&#8226;</strong> Strap Size: For Chest Sizes 80cm to 140cm</p>
                    </div>
                    <div class="col-md-6">
                        <div class="intresting-slider">
                            <div class="item">
                                <div class="intresting-img-box">
                                    <div class="intresting-product-img">
                                        <img src="{{ asset('mini/images/Respiratory Sensor-1.png') }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="intresting-img-box">
                                    <div class="intresting-product-img">
                                        <img src="{{ asset('mini/images/Gold-Render-27-2.png') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End section -->

        <!-- Section -->
        <section class="section">
            
            <div class="container">
                <h2 class="section-heading section-heading-highlight">
                    YOU MAY ALSO BE INTERESTED IN
                </h2>
            </div>

            <div class="container-fluid">
                
                <div class="products-list">
                    <a class="product-link" href="https://tektelic.com/catalog/wearable-lorawan-temperature-sensor">
                        <div class="products-item">
                            <div class="products-image">
                                <img src="{{ asset('mini/images/product/image-product-1.png') }}" alt="" />
                            </div>
                            <h6 class="products-title">Arm Band Sensor</h6>
                        </div>
                    </a>
                    <a class="product-link" href="https://tektelic.com/catalog/wearable-contact-tracing-lorawan-device-indoor">
                        <div class="products-item">
                            <div class="products-image">
                                <img src="{{ asset('mini/images/product/image-product-2.png') }}" alt="" />
                            </div>
                            <h6 class="products-title">Contact Tracing Indoor</h6>
                        </div>
                    </a>
                    <a class="product-link" href="https://tektelic.com/catalog/Outdoor-contact-tracing">
                        <div class="products-item">
                            <div class="products-image">
                                <img src="{{ asset('mini/images/product/image-product-3.png') }}" alt="" />
                            </div>
                            <h6 class="products-title">Contact Tracing Outdoor</h6>
                        </div>
                    </a>
                </div>

            </div>
        </section>
        <!-- End section -->
        <div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
            <div class="modal-dialog  modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">eDoctor</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="cartoonVideo" class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/2ShZJqRNvc0" allowfullscreen></iframe>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection