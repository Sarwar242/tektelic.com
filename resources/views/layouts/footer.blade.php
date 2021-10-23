<footer class="site-footer">
    <div class="container">
        <div class="site-footer-inner">
            <div class="site-footer-logo"><a href="{{url('')}}"><img class="site-footer-image" src="{{asset('images/theme/tektelic-logo-footer.svg')}}" alt="Tektelic logo"></a></div>
            <div class="site-footer-widgets">
                <div class="footer-widget">
                    <h3 class="footer-title screen-reader-text">Footer navigation</h3>
                    <ul class="footer-navigation">
                        @foreach (\App\Models\MenuItem::getTreeFront('footer1') as $item)
                        <li class="footer-menu-item"><a class="footer-menu-link" href="<?= url($item->link) ?>">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="footer-widget">
                    <h3 class="footer-title screen-reader-text">Additional navigation</h3>
                    <ul class="footer-navigation">
                        @foreach (\App\Models\MenuItem::getTreeFront('footer2') as $item)
                            <li class="footer-menu-item"><a class="footer-menu-link" href="<?= url($item->link) ?>">{{$item->title}}</a></li>
                        @endforeach
                        <li class="footer-menu-item">
                            <a class="footer-menu-link" target="_blank" href="https://support.tektelic.com/portal/en/signin">Technical Support</a>
                        </li>
                    </ul>
                </div>
                <div class="footer-widget">
                    <h3 class="footer-title"><?= \App\Models\StaticTextLang::t("Contact Us",'main'); ?></h3>
                    <ul class="footer-contacts">
                        <li class="footer-contacts-item"><i class="footer-contacts-icon"><svg width="21" height="28" viewBox="0 0 21 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="10.5" cy="10.5" r="5" stroke="white"/>
                                    <path d="M20.5 10.2308C20.5 12.9559 19.3544 17.32 17.479 21.0076C16.5436 22.8467 15.4418 24.4868 14.2381 25.6601C13.0312 26.8365 11.7686 27.5 10.5 27.5C9.23141 27.5 7.96883 26.8365 6.76192 25.6601C5.55823 24.4868 4.45642 22.8467 3.52105 21.0076C1.64557 17.32 0.5 12.9559 0.5 10.2308C0.5 4.86878 4.96483 0.5 10.5 0.5C16.0352 0.5 20.5 4.86878 20.5 10.2308Z" stroke="white"/>
                                </svg></i><span class="footer-contacts-link">7657 10th Street NE <br>Calgary, AB T2E 8X2</span></li>
                        <li class="footer-contacts-item"><i class="footer-contacts-icon"><svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24.344 18.2462L19.2839 15.0535C18.6418 14.6516 17.781 14.7839 17.3063 15.3574L15.8323 17.1504C15.6429 17.3868 15.2986 17.4553 15.0245 17.3113L14.7441 17.165C13.8147 16.6857 12.6582 16.089 10.3281 13.8837C7.99807 11.6784 7.36608 10.5834 6.85947 9.7056L6.70573 9.44033C6.55141 9.18111 6.62249 8.85394 6.87236 8.67329L8.76622 7.27917C9.37218 6.82996 9.51215 6.01581 9.08785 5.40808L5.71335 0.620618C5.2785 0.00175798 4.40607 -0.18402 3.73288 0.198853L1.61693 1.40142C0.95209 1.77122 0.46432 2.37013 0.255904 3.07264C-0.506044 5.69931 0.0671615 10.2325 7.1253 16.9112C12.7399 22.2229 16.9197 23.6513 19.7926 23.6513C20.4538 23.654 21.1124 23.5726 21.7507 23.4093C22.4933 23.2124 23.1264 22.7508 23.5171 22.1216L24.7894 20.1209C25.1946 19.4838 24.9984 18.6579 24.344 18.2462ZM24.0715 19.7164L22.8021 21.7184C22.5217 22.1725 22.0663 22.5064 21.5315 22.6502C18.9685 23.3159 14.4909 22.7645 7.71476 16.3535C0.938664 9.94247 0.355889 5.70643 1.05954 3.28119C1.21167 2.77457 1.56504 2.3432 2.04563 2.07742L4.16158 0.876422C4.45367 0.710136 4.83233 0.790738 5.02102 1.05929L6.8541 3.6631L8.39264 5.84634C8.57689 6.10995 8.51635 6.46326 8.2535 6.65832L6.3592 8.05244C5.78272 8.4695 5.6181 9.22411 5.97303 9.82302L6.12344 10.0816C6.65588 11.0055 7.31785 12.1549 9.73458 14.441C12.1513 16.7271 13.3657 17.3535 14.3418 17.8572L14.6155 17.9998C15.2485 18.3356 16.0461 18.1799 16.4869 17.6345L17.9604 15.8422C18.1666 15.5937 18.5399 15.5365 18.8186 15.7106L23.8783 18.9033C24.1623 19.0817 24.2475 19.4401 24.0715 19.7164Z" fill="white"/>
                                    <path d="M14.1656 3.94255C18.0753 3.94666 21.2436 6.94416 21.248 10.643C21.248 10.8607 21.4345 11.0371 21.6646 11.0371C21.8947 11.0371 22.0812 10.8607 22.0812 10.643C22.0763 6.50897 18.5353 3.15882 14.1656 3.1543C13.9355 3.1543 13.749 3.33074 13.749 3.54842C13.749 3.76611 13.9355 3.94255 14.1656 3.94255Z" fill="white"/>
                                    <path d="M14.1656 6.3078C16.6954 6.31062 18.7454 8.25011 18.7484 10.6435C18.7484 10.8612 18.9349 11.0376 19.1649 11.0376C19.395 11.0376 19.5815 10.8612 19.5815 10.6435C19.5781 7.81491 17.1553 5.52276 14.1656 5.51953C13.9355 5.51953 13.749 5.69598 13.749 5.91367C13.749 6.13136 13.9355 6.3078 14.1656 6.3078Z" fill="white"/>
                                    <path d="M14.1656 8.67283C15.3155 8.67412 16.2473 9.55546 16.2487 10.6431C16.2487 10.8607 16.4353 11.0371 16.6653 11.0371C16.8954 11.0371 17.0819 10.8607 17.0819 10.6431C17.0801 9.12043 15.7755 7.88647 14.1656 7.88477C13.9355 7.88477 13.749 8.06116 13.749 8.2788C13.749 8.49643 13.9355 8.67283 14.1656 8.67283Z" fill="white"/>
                                </svg></i><a class="footer-contacts-link" href="tel:4033386900">403.338.6900</a></li>
                        <li class="footer-contacts-item"><i class="footer-contacts-icon"><svg width="28" height="20" viewBox="0 0 28 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M26.6 0H1.4C0.626828 0 0 0.563792 0 1.25932V18.0502C0 18.7457 0.626773 19.3096 1.4 19.3096H26.6C27.3732 19.3096 28 18.7458 28 18.0502V1.25932C28 0.563841 27.3732 0 26.6 0ZM27.0666 18.0503C27.0666 18.2821 26.8577 18.4701 26.6 18.4701H1.4C1.14226 18.4701 0.933352 18.2821 0.933352 18.0503V1.25932C0.933352 1.02748 1.14226 0.839564 1.4 0.839564H26.6C26.8577 0.839564 27.0666 1.02748 27.0666 1.25932V18.0503V18.0503Z" fill="white"/>
                                    <path d="M25.707 1.68033C25.5836 1.67064 25.4611 1.70542 25.3663 1.77704L14.6002 9.91231C14.253 10.1748 13.7462 10.1748 13.399 9.91231L2.63299 1.777C2.5053 1.68058 2.33008 1.65273 2.1734 1.70399C2.01672 1.75525 1.90231 1.87784 1.87333 2.02557C1.84434 2.17329 1.90516 2.32368 2.03285 2.42009L12.7989 10.555C13.4928 11.0805 14.5065 11.0805 15.2004 10.555L25.9664 2.42014C26.0612 2.34857 26.1205 2.24605 26.1313 2.13512C26.1421 2.02419 26.1034 1.91395 26.0238 1.8287C25.9443 1.74335 25.8303 1.69002 25.707 1.68033Z" fill="white"/>
                                    <path d="M8.97554 10.4984C8.81033 10.4652 8.63817 10.5151 8.52552 10.6287L1.99215 16.9255C1.87392 17.0344 1.8305 17.1924 1.87873 17.3383C1.92697 17.4843 2.05925 17.5953 2.22441 17.6284C2.38962 17.6616 2.56178 17.6117 2.67444 17.498L9.2078 11.2013C9.32603 11.0924 9.36945 10.9344 9.32122 10.7885C9.27299 10.6426 9.14075 10.5315 8.97554 10.4984Z" fill="white"/>
                                    <path d="M19.4742 10.6287C19.3616 10.5151 19.1894 10.4652 19.0242 10.4984C18.859 10.5315 18.7268 10.6425 18.6785 10.7884C18.6303 10.9344 18.6737 11.0923 18.792 11.2012L25.3254 17.4976C25.5026 17.6608 25.7922 17.6669 25.9776 17.5113C26.1631 17.3556 26.1764 17.0953 26.0077 16.925L19.4742 10.6287Z" fill="white"/>
                                </svg></i><a class="footer-contacts-link" href="">info@tektelic.com</a></li>
                    </ul>
                </div>
                <div class="footer-widget">
                    <h3 class="footer-title"><?= \App\Models\StaticTextLang::t("Follow us",'main'); ?></h3>
                    <ul class="footer-socials">
                        <li class="footer-socials-item">
                            <a class="footer-socials-link" href="https://www.facebook.com/Tektelic1/" target="_blank">
                                <img class="footer-socials-icon" src="{{asset('/images/theme/social/facebook.svg')}}" alt="follow us on facebook">
                            </a>
                        </li>
                        <li class="footer-socials-item">
                            <a class="footer-socials-link" href="https://www.linkedin.com/company/tektelic/" target="_blank">
                                <img class="footer-socials-icon" src="{{asset('/images/theme/social/linkedin.svg')}}" alt="follow us on linkedin">
                            </a>
                        </li>
                        <li class="footer-socials-item">
                            <a class="footer-socials-link" href="https://www.instagram.com/tektelic/" target="_blank">
                                <img class="footer-socials-icon" src="{{asset('/images/theme/social/instagram.svg')}}" alt="follow us on instagram">
                            </a>
                        </li>
                        <li class="footer-socials-item">
                            <a class="footer-socials-link" href="https://twitter.com/tektelic" target="_blank">
                                <img class="footer-socials-icon" src="{{asset('/images/theme/social/twitter.svg')}}" alt="follow us on twitter">
                            </a>
                        </li>
                    </ul>
                    <div class="footer-iso">
                        <a class="footer-iso-link" href="{{asset('/uploads/1662872_QMS_ENG_Tektelic_ISO9001_Certificate.pdf')}}" target="_blank">
                            <img class="footer-iso-image" src="/images/iso-9001-2015-2.svg" alt="iso-9001-2015">
                        </a>
                    </div>
                </div>
            </div>
            <div class="site-footer-copyright"><span class="site-copyright"><?= \App\Models\StaticTextLang::t("Copyright © <span class='year'>2009-2020</span> <span>TEKTELIC Communications Inc.</span></span>",'footer'); ?><span class="terms-and-policy"><a class="white" target="_blank" href="{{url('/public/uploads/pages/TEKTELIC_Terms_and_Conditions.pdf')}}">Terms and Conditions</a> | <a class="white" target="_blank" href="{{url('/public/uploads/pages/TEKTELIC-Privacy-Policy.pdf')}}">Privacy Policy</a></div>
        </div>
    </div>
</footer>
