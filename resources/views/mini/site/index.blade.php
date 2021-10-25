@extends('minilayout')
@section('metaTitle', 'eHealth - End-to-End Health Monitoring')
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags('TEKTELIC has utilized its capabilities as a premier designer and manufacturer of End-to-End IoT solutions to deliver a comprehensive suite of solutions to address some of the most common challenges in the healthcare space. The TEKTELIC eHealth solutions are changing the way respiratory health and vital sign monitoring is approached with a low power solution designed for quick setup, minimal maintenance and continuous monitoring.') ))

@section('content')
    <section class="slider-sec-product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="banner-content">
                        <div class="banner-text">
                            <h1>eHealth</h1>
                            <h6>End-to-End Health Monitoring IoT Solutions</h6>
                            <p>TEKTELIC has utilized its capabilities as a premier designer and manufacturer of End-to-End IoT solutions to deliver a comprehensive suite of solutions to address some of the most common challenges in the healthcare space. The TEKTELIC eHealth solutions are changing the way respiratory health and vital sign monitoring is approached with a low power solution designed for quick setup, minimal maintenance and continuous monitoring. </p>
                                <a data-toggle="modal" data-target="#contact-us" type="submit" class="btn-blue-light">contact us <span><img src="{{ asset('mini/images/Arrow-button.png') }}" alt="Arrow-button.png"/></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="banner-slider">
                        <div class="item">
                            <div class="banner-img-box">
                                <div class="banner-product-img">
                                    <img src="{{ asset('mini/images/product/image-easy-comfortable-to-wear-in-everyday-life.png') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="banner-img-box">
                                <div class="banner-product-img">
                                    <img src="{{ asset('mini/images/Gold-Render-27-2.png') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="banner-img-box">
                                <div class="banner-product-img">
                                    <img src="{{ asset('mini/images/Outdoor-tracing-device.png') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs -->
    <section id="tabs" class="tektelik-tabs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 px-0">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab"
                            role="tablist">
                            <a class="nav-item nav-link active"
                                id="nav-home-tab" data-toggle="tab"
                                href="#nav-home" role="tab"
                                aria-controls="nav-home"
                                aria-selected="true">Products</a>
                            <a class="nav-item nav-link"
                                id="nav-profile-tab" data-toggle="tab"
                                href="#nav-profile" role="tab"
                                aria-controls="nav-profile"
                                aria-selected="false">Use Cases</a>
                            <a class="nav-item nav-link"
                                id="nav-contact-tab" data-toggle="tab"
                                href="#nav-contact" role="tab"
                                aria-controls="nav-contact"
                                aria-selected="false">About Us</a>
                            <a class="nav-item nav-link" id="nav-our-tab"
                                data-toggle="tab" href="#nav-our"
                                role="tab" aria-controls="nav-our"
                                aria-selected="false">Our Clients</a>
                            <a class="nav-item nav-link" id="nav-about-tab"
                                data-toggle="tab" href="#nav-about"
                                role="tab" aria-controls="nav-about"
                                aria-selected="false">Get in Touch</a>
                            <span class="nav-item nav-link social-con-tab"><a href="https://www.facebook.com/Tektelic1/"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="https://www.instagram.com/tektelic/"><i class="fa fa-instagram" aria-hidden="true"></i></a><a href="https://www.linkedin.com/company/tektelic/"><i class="fa fa-linkedin" aria-hidden="true"></i></a><a href="https://twitter.com/tektelic"><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
                        </div>
                    </nav>
                    <div class="tab-content px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home"
                            role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="product-tab-slider">
                                <div>
                                    <a href="https://tektelic.com/catalog/wearable-lorawan-respiratory-sensor">
                                        <div class="product-tab-inner">
                                            <div class="product-img">
                                                <img src="{{ asset('mini/images/Respiratory Sensor-1.png') }}" alt="Respiratory
                                                    Sensor-1.png" />
                                            </div>
                                            <div class="product-title">
                                                <h4>eDoctor</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a href="https://tektelic.com/catalog/wearable-lorawan-temperature-sensor">
                                        <div class="product-tab-inner">
                                            <div class="product-img">
                                                <img
                                                    src="{{ asset('mini/images/Armband_Render_3-1.png') }}"
                                                    alt="Armband_Render_3-1.png"
                                                    />
                                            </div>
                                            <div class="product-title">
                                                <h4>eDoctor Arm Band</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a href="https://tektelic.com/catalog/lorawan-safealert-solution">
                                        <div class="product-tab-inner">
                                            <div class="product-img">
                                                <img
                                                    src="{{ asset('mini/images/Outdoor-tracing-device-2.png') }}"
                                                    alt="Outdoor-tracing-device-2.png"
                                                    />
                                            </div>
                                            <div class="product-title">
                                                <h4>SafeAlert</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a href="https://tektelic.com/catalog/cold-room-storage-monitoring-solution">
                                        <div class="product-tab-inner">
                                            <div class="product-img">
                                                <img
                                                    src="{{ asset('mini/images/cold-temp.png') }}"
                                                    alt="cold-temp.png"
                                                    />
                                            </div>
                                            <div class="product-title">
                                                <h4>Tundra</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a href="https://tektelic.com/catalog/wearable-contact-tracing-lorawan-device-indoor">
                                        <div class="product-tab-inner">
                                            <div class="product-img">
                                                <img
                                                    src="{{ asset('mini/images/Indoor-contact-tracing-device-final-2.png') }}"
                                                    alt="Indoor-contact-tracing-device-final-2.png"
                                                    />
                                            </div>
                                            <div class="product-title">
                                                <h4>Contact Tracing (Indoor)</h4>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile"
                            role="tabpanel"
                            aria-labelledby="nav-profile-tab">
                            <section class="usecases-sec">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 px-0">
                                            <div class="usecases-box">
                                                <div class="usecases-box-img">
                                                    <img src="{{ asset('mini/images/hospitals.jpg') }}" alt="hospitals.jpg"/>
                                                </div>
                                                <div class="usecases-box-desc">
                                                    <h4><a href="#">Hospitals</a></h4>
                                                    <p><strong>&#8226;</strong> Continuous patient monitoring during surgery and in Pre and Post operative care</p>
                                                    <p><strong>&#8226;</strong> Patient and healthcare worker safety</p>
                                                    <p><strong>&#8226;</strong> Always-On temperature monitoring of prescriptions and vaccines</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 px-0">
                                            <div class="usecases-box">
                                                <div class="usecases-box-img">
                                                    <img src="{{ asset('mini/images/senior_care.jpg') }}" alt="senior_care.jpg"/>
                                                </div>
                                                <div class="usecases-box-desc">
                                                    <h4><a href="#">Seniors Care Residences</a></h4>
                                                    <p><strong>&#8226;</strong> 24/7 respiratory and vital monitoring</p>
                                                    <p><strong>&#8226;</strong> Resident and caregiver safety and security</p>
                                                    <p><strong>&#8226;</strong> Virus spread control and mitigation</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 px-0">
                                            <div class="usecases-box">
                                                <div class="usecases-box-img">
                                                    <img src="{{ asset('mini/images/aging_home.jpg') }}" alt="aging_home.jpg"/>
                                                </div>
                                                <div class="usecases-box-desc">
                                                    <h4><a href="#">Aging at Home</a></h4>
                                                    <p><strong>&#8226;</strong> Continuous health monitoring by caregivers even from home</p>
                                                    <p><strong>&#8226;</strong> Rapid intervention when urgent care is needed</p>
                                                    <p><strong>&#8226;</strong> Peace of mind for loved ones and caregivers</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 px-0">
                                            <div class="usecases-box">
                                                <div class="usecases-box-img">
                                                    <img src="{{ asset('mini/images/military.jpg') }}" alt="military.jpg"/>
                                                </div>
                                                <div class="usecases-box-desc">
                                                    <h4><a href="#">Military</a></h4>
                                                    <p><strong>&#8226;</strong> Respiratory and Vital Health monitoring</p>
                                                    <p><strong>&#8226;</strong> Remote connectivity in any environment</p>
                                                    <p><strong>&#8226;</strong> Activity and Fall Detection and Alerts</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 px-0">
                                            <div class="usecases-box">
                                                <div class="usecases-box-img">
                                                    <img src="{{ asset('mini/images/athletes.jpg') }}" alt="athletes.jpg"/>
                                                </div>
                                                <div class="usecases-box-desc">
                                                    <h4><a href="#">High Performance Athletes</a></h4>
                                                    <p><strong>&#8226;</strong> Accurate and Highly Available Vital Sign Monitoring during Activity and Rest</p>
                                                    <p><strong>&#8226;</strong> Improved Performance and Training Regimens</p>
                                                    <p><strong>&#8226;</strong> Always-On Connectivity for the most accurate data collection</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="tab-pane fade" id="nav-contact"
                            role="tabpanel"
                            aria-labelledby="nav-contact-tab">

                            <section class="about-tab-sec">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2>About Us</h2>
                                            <h3>Premier Supplier of End-to-End IoT Solutions that Just Work</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <p>TEKTELIC, a global leader of End-to-End IoT Products and Solutions, works to perfect the deployment of IoT Networks and Solutions for the best efficiency, high reliability, cost effectiveness and ease of operation. TEKTELIC IoT solutions are designed to work out-of-the box with little to no prior technical expertise from the end user. This results in IoT acceleration and expediency. TEKTELIC solutions are not only unique because of how they are designed, but because of their ease of deployment, operation, and high reliability to help the consumer become a part of the IoT ecosystem. For additional information, visit: https://tektelic.com/</p>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>

                        <div class="tab-pane fade" id="nav-our"
                            role="tabpanel" aria-labelledby="nav-our-tab">

                            <section class="ourclient-tab-sec">
                                <div class="container-fluid">
                                    <div class="row testi-inner">
                                        <div class="col-md-12 px-0">
                                            <h2>Client’s Review</h2>
                                            <div class="ourclient-tab-slider">
                                                <div>
                                                    <div class="ourclient-tab-inner">
                                                        <div class="ourclient-img">
                                                            <img src="{{ asset('mini/images/client-img.png') }}" alt="client-img.png" />
                                                        </div>
                                                        <div class="ourclient-desc">
                                                            <p>Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack. Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack.</p>
                                                            <h4>Ash Bunce</h4>
                                                            <h5>Project Manager <span>PVC</span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="ourclient-tab-inner">
                                                        <div class="ourclient-img">
                                                            <img src="{{ asset('mini/images/client-img.png') }}" alt="client-img.png" />
                                                        </div>
                                                        <div class="ourclient-desc">
                                                            <p>Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack. Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack.</p>
                                                            <h4>Ash Bunce</h4>
                                                            <h5>Project Manager <span>PVC</span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="ourclient-tab-inner">
                                                        <div class="ourclient-img">
                                                            <img src="{{ asset('mini/images/client-img.png') }}" alt="client-img.png" />
                                                        </div>
                                                        <div class="ourclient-desc">
                                                            <p>Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack. Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack.</p>
                                                            <h4>Ash Bunce</h4>
                                                            <h5>Project Manager <span>PVC</span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="ourclient-tab-inner">
                                                        <div class="ourclient-img">
                                                            <img src="{{ asset('mini/images/client-img.png') }}" alt="client-img.png" />
                                                        </div>
                                                        <div class="ourclient-desc">
                                                            <p>Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack. Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack.</p>
                                                            <h4>Ash Bunce</h4>
                                                            <h5>Project Manager <span>PVC</span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="ourclient-tab-inner">
                                                        <div class="ourclient-img">
                                                            <img src="{{ asset('mini/images/client-img.png') }}" alt="client-img.png" />
                                                        </div>
                                                        <div class="ourclient-desc">
                                                            <p>Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack. Great product. Adds so much convenience to my life with it’s superb battery life.It’s an added bonus that it’s the coolest looking object in my backpack.</p>
                                                            <h4>Ash Bunce</h4>
                                                            <h5>Project Manager <span>PVC</span></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>

                        <div class="tab-pane fade" id="nav-about"
                            role="tabpanel" aria-labelledby="nav-about-tab">

                            <section class="contact-tab-sec">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <h2 class="left-title">Get in Touch</h2>
                                        </div>
                                        <div class="col-md-11">
                                            <p class=""></p>
                                            <form method="post" class="contact-form get-in-touch-form">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="d-block" for="country">Find the nearest office</label>
                                                    <select name="country_id" class="nearest-office">
                                                        <option value="">Choose your country</option>
                                                        <option value="28">Canada</option>
                                                        <option value="29">USA</option>
                                                        <option value="10">United Kingdom</option>
                                                    </select>
                                                    <p class="errorMessages errorMessageCountry"></p>
                                                  </div>
                                                <div class="form-group">
                                                  <label for="email">Subscribe to our newslette</label>
                                                  <input type="email" name="email" class="form-control email-id" placeholder="E-mail" id="email">
                                                    <p class="errorMessages errorMessageEmail"></p>
                                                </div>
                                                <div class="form-group form-check">
                                                  <label class="form-check-label">
                                                    <input name="check" class="form-check-input" type="checkbox"> <span>I agree to the Privacy Policy</span>
                                                  </label>
                                                    <p class="errorMessages errorMessagePP"></p>
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-blue-dark get-in-touch">send<span><img src="{{ asset('mini/images/Arrow-button.png') }}" alt="Arrow-button.png"/></span></button>
                                              </form>
                                        </div>
                                    </div>
                                </div>
                            </section>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
