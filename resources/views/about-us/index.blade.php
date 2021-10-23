@extends('layout')
@section('metaTitle', $page->title)
@section('metaDesc', preg_replace( "/\r|\n/", "", strip_tags($page->text) ))
@section('content')
    <div class="page-header">
        <div class="container">
            <div class="page-breadcrumbs">
                <ul class="breadcrumbs-navigation">
                    {{ Breadcrumbs::render('about-us') }}
                </ul>
            </div>
            <div class="page-headings">
                <h2 class="page-title">{{$page->title}}</h2>
            </div>
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li style="color:green">{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            @if (\Session::has('error'))
                <div class="alert alert-error">
                    <ul>
                        <li style="color:red">{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <article class="about-post">
                <div class="about-post-image"><img class="image" src="{{asset(\App\Helpers\Helper::getImgSrc($page->page->image))}}" alt="{{ $page->alt }}" title="{{ $page->pic_title }}"></div>
                <div class="about-post-content" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <h2 class="about-post-title">{!! $page->sub_title !!}</h2>
                    {!! $page->text !!}
                </div>
            </article>
            <section class="about-contacts">
                <div class="about-contacts-header" data-aos>
                    <div class="feature-headings">
                        <h2 class="section-title">Contacts</h2>
                    </div>
                </div>
                <div class="about-contacts-body">
                    <div class="about-contacts-main">
                        <div class="about-widgets-list" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                            @foreach ($contacts as $contact)
                            <div class="about-widget">
                                <div class="about-widget-title">{!! $contact->title !!}</div>
                               {!! $contact->text !!}
                            </div>
                            @endforeach

                        </div>
                        <div class="about-widget-map" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d80137.85492835668!2d-114.12348747781571!3d51.12122721728956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x537164341a7e048d:0xb40244330ee36c6a!2s7657 10 St NE, Calgary, AB T2E 8X2, Canada!5e0!3m2!1sen!2sua!4v1611582981912!5m2!1sen!2sua" aria-hidden="false" tabindex="0"></iframe></div>
                    </div>
                    <div class="about-contacts-aside">
                        <form class="about-form" id="about-contacts" method="POST" action="{{url('about-us-email')}}" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                            @csrf
                            <div class="form-legend">
                                <div class="form-title"><?= \App\Models\StaticTextLang::t("Leave Us a Message",'about_us'); ?></div>
                                <div class="form-subtitle"><?= \App\Models\StaticTextLang::t("We value your feedback. If you haven’t found the information that you are looking for on our web site, please don’t hesitate to get in touch with us using the form below.",'about_us'); ?></div>
                            </div>
                            <div class="form-row">
                                <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("Name",'about_us'); ?></label>
                                <input class="form-field" name="name" type="text" placeholder="" >
                                <input class="form-field" name="type" type="hidden" placeholder="" value="about_us" >
                            </div>
                            <div class="form-row">
                                <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("E-mail",'about_us'); ?></label>
                                <input class="form-field" name="email" type="email" placeholder="" required>
                            </div>
                            <div class="form-row">
                                <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("Phone number",'about_us'); ?></label>
                                <input class="form-field" name="phone" type="tel" placeholder="" >
                            </div>
                            <div class="form-row">
                                <label class="form-label label-margin"><?= \App\Models\StaticTextLang::t("Message",'about_us'); ?></label>
                                <textarea name="mess" class="form-textarea" rows="2"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-agreement">
                                    <input type="checkbox" name="agreement" id="form-agreement-checkbox">
                                    <label for="form-agreement-checkbox"><?= \App\Models\StaticTextLang::t("I agree to the",'footer_form'); ?> <a href="<?= \App\Models\StaticTextLang::t("link",'footer_form'); ?>"> <?= \App\Models\StaticTextLang::t("Privacy Policy",'footer_form'); ?></a></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-submit about-submit" type="submit" value="<?= \App\Models\StaticTextLang::t("send",'about_us'); ?>">
                            </div>

                        </form>
                    </div>
                </div>
            </section>
            @include('layouts.contact-us', ['entity' => $page])
        </div>
    </div>


@endsection

@section('footer')

@endsection()
