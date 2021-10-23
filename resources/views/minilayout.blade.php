<?php
/* #SID - #zhby1t - Ehealth Landing Page */
use Illuminate\Support\Facades\Session;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>TEKTELIC | @yield('metaTitle', 'eHealth - End-to-End Health Monitoring IoT Solutions')</title>
        <meta name="description" content="@yield('metaDesc', 'TEKTELIC has utilized its capabilities as a premier designer and manufacturer of End-to-End IoT solutions to deliver a comprehensive suite of solutions to address some of the most common challenges in the healthcare space. The TEKTELIC eHealth solutions are changing the way respiratory health and vital sign monitoring is approached with a low power solution designed for quick setup, minimal maintenance and continuous monitoring.')">

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
            integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="crossorigin="anonymous"
            referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('mini/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('mini/css/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('mini/css/bootstrap.min.css') }}">


        <link rel="stylesheet" href="{{ asset('mini/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('mini/css/responsive.css') }}">
        <script src="{{ asset('mini/js/jquery.min.js') }}"></script>
        <script src="{{ asset('mini/js/popper.min.js') }}"></script>
        <script src="{{ asset('mini/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('mini/js/slick.min.js') }}"></script>
        <script src="{{ asset('mini/js/script.js') }}"></script>

    </head>
    <body>

        <!-- Header section  -->
        @include('mini.layouts.header')
        <!-- End Header section  -->

        <!-- slider section -->
        @yield('content')
        <!-- Tabs -->

        <!-- Footer section  -->
        @include('mini.layouts.footer')
        <!-- End Footer section  -->

        <div class="modal fade" id="contact-us" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body contactUsBody">
                        <form class="contacts-form" method="POST" action="{{url('contact-us-mini')}}">
                            @csrf
                            <div class="form-group">
                                <label ><?= \App\Models\StaticTextLang::t("First Name",'about_us'); ?></label>
                                <input class="form-control" id="name" name="name" type="text">
                            </div>
                            <div class="form-group">
                                <label ><?= \App\Models\StaticTextLang::t("Last Name",'about_us'); ?></label>
                                <input class="form-control" id="lastname" name="lastname" type="text">
                            </div>
                            <div class="form-group">
                                <label ><?= \App\Models\StaticTextLang::t("Company",'about_us'); ?></label>
                                <input class="form-control" id="company" name="company" type="text">
                            </div>
                            <div class="form-group">
                                <label ><?= \App\Models\StaticTextLang::t("E-mail",'about_us'); ?> <span class="errorMessages">*</span></label>
                                <input class="form-control email-id-contact" name="email" type="email" required>
                                <p class="errorMessages errorMessageEmailContact"></p>
                            </div>
                            <div class="form-group">
                                <label ><?= \App\Models\StaticTextLang::t("Phone number",'about_us'); ?></label>
                                <input class="form-control" name="phone" type="tel">
                                <input class="form-control htype" name="type" type="hidden" value="contact" >
                            </div>
                            <div class="form-group">
                                <label ><?= \App\Models\StaticTextLang::t("Message",'about_us'); ?></label>
                                <textarea  class="form-control" name="text" id="text" rows="10" type="text"></textarea>
                                <input class="form-control htype" name="type" type="hidden" value="contact_ehealth" >
                            </div>
                            <div class="form-group">
                                <div class="form-agreement">
                                    <input type="checkbox" required name="check_contact" id="contact-agreement-checkbox">
                                    <label for="contact-agreement-checkbox"><?= \App\Models\StaticTextLang::t("I agree to the",'footer_form'); ?>  <a target="_blank" href="https://tektelic.com/public/uploads/pages/TEKTELIC-Privacy-Policy.pdf"> Privacy Policy <span class="errorMessages">*</span></a></label>
                                </div>
                                <p class="errorMessages errorMessagePPContact"></p>
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
            </div>
        </div>
        <div id="contact-us" style="display: none;" class="">
            <div class="contact_us">
            
            </div>
        </div>
    </body>
</html>