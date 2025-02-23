@include("home.header")
<div class="l-content-wrap u-cf">
    <div class="l-1-col-master u-cf">
        <main class="l-content-primary">
            <div class='body-content js-body-content'>

                <div class='l-sub-hero'>
                    <section class='sub-hero hero--image js-hero--image' aria-label="Hero Area">
                        <div class='image-hero js-hero-image-bg'>
                            <div class='hero-image-bg main-hero-background main-hero-background--home hero-image-bg--gradient '
                                style='background-image:url("templates/bank-pro/invest-images/Citadel_AlkemyX_00405_weatlh_kate_1600x650.jpg"); transform:translateY(0px);'>
                            </div>
                        </div>
                        <div class='sub-hero-content l-contain'>
                            <div class='sub-hero-content-inner'>
                                <p class="sub-hero__title mb-1">Frequently Asked Questions</p>
                                <p class='sub-hero__teaser p'>What's on your mind? There are lots of ways to get in
                                    touch with us. Search our FAQs</p>
                            </div>
                        </div>
                    </section>
                </div>
                <div class='l-nav-secondary'>
                    <!-- notes:component
  title: Secondary Navigation / Breadcrumb
  general: This navigation will work as a hybrid breadcrumb/traditional secondary navigation. The user is on a page that has child pages, those child pages will be displayed to the right. If the user is at the lowest level (no child pages) the active page will be highlighted and its siblings will be displayed. The user will be able to jump back to items from previous sections by clicking on the breadcrumb item.
  -->

                    <nav class="js-nav-secondary nav-secondary ">
                        <ul class="nav-secondary__l1">
                            <li class="nav-secondary__l1-item">
                                <button type="button" data-toggle="section-nav-menu">About Us <span
                                        class="button-icon"></span></button>
                                <div id="section-nav-menu" class="nav-secondary__l1-flyout" data-toggler=".is-active">
                                    <ul id="section-nav-drilldown"
                                        class="nav-secondary__l2 vertical menu accordion-menu" data-drilldown
                                        data-auto-height="true" data-animate-height="true" data-parent-link="true">


                                    </ul>
                                </div>
                            </li>
                            <li class="nav-secondary__l1-item"><span>Frequently Asked Questions</span>
                            </li>
                        </ul>
                    </nav>

                    <script>
                        window.addEventListener('DOMContentLoaded', function () {
                          $(document).ready(function () {
                              $('#section-nav-drilldown').foundation('_showMenu', $('.nav-secondary_active_selector'), true);
                          });
                      });
                    </script>
                </div>
                <div class='content-nav-section' data-short-name='Frequently Asked Questions'>
                    <div class="u-pos-relative l-contain">
                        <div class="rtf h1">
                            <h1>Frequently Asked Questions</h1>
                        </div>
                    </div>
                </div>
                <div class="content-nav-section" data-short-name="Frequently Asked Questions">

                    <div class="l-bg-gray padding-content" id="faqs">
                        <section class="faq l-contain js-faq" aria-label="FAQ">

                            <div class="faq__inner l-bg-white">
                                <div class="faq__item">
                                    <a class="faq__question js-faq-open" href="#">Is the company registered and
                                        regulated</a>
                                    <div class="faq__answer rtf">
                                        <p>
                                            <font color="#011f4c" face="Open Sans, sans-serif"><span
                                                    style="font-size: 16px;">Yes, our Company is totally a legal
                                                    platform licensed by the Securities and Exchange Commission&nbsp;to
                                                    carry out financial activities in over 105 countries?</span></font>
                                            <br>
                                        </p>
                                    </div>
                                </div>
                                <div class="faq__item">
                                    <a class="faq__question js-faq-open" href="#">What is the field of activity of the
                                        company?</a>
                                    <div class="faq__answer rtf">
                                        <p>The company is engaged in cryptocurrency and Forex trading. Our staff of
                                            highly qualified traders and financial experts shows high profit rates from
                                            year to year. The company's priorities are access to international markets
                                            and long-term cooperation with investors.<br></p>
                                    </div>
                                </div>
                                <div class="faq__item">
                                    <a class="faq__question js-faq-open" href="#">Who can be a Customer of Givens Hall
                                        Bank?</a>
                                    <div class="faq__answer rtf">
                                        <p>Everyone can be a Customer of Givens Hall Bank, but he\she must be not less
                                            18 years old.<br></p>
                                    </div>
                                </div>
                                <div class="faq__item">
                                    <a class="faq__question js-faq-open" href="#">How can I become an investor in the
                                        company?</a>
                                    <div class="faq__answer rtf">
                                        <p>You may become a client of the company and it is totally free of charge. All
                                            you need is to sign up and fill all required fields. It takes less than 2
                                            minutes to complete sign up.<br></p>
                                    </div>
                                </div>
                                <div class="faq__item">
                                    <a class="faq__question js-faq-open" href="#">How reliable is the company in terms
                                        of security and personal data?</a>
                                    <div class="faq__answer rtf">
                                        <p>We pay great attention to security and privacy. All information on our
                                            website is protected by SSL. We do not divulge any personal data of our
                                            customers to third parties. Your participation is strictly confidential.<br>
                                        </p>
                                    </div>
                                </div>
                                <div class="faq__item">
                                    <a class="faq__question js-faq-open" href="#">Is there a KYC verification
                                        process?</a>
                                    <div class="faq__answer rtf">
                                        <p>Yes, we do require verification documents confirming the identity, address or
                                            origin of account owner.<br></p>
                                    </div>
                                </div>

                                <div class="u-align-center faq__lower">
                                    <p>
                                        Still have questions?
                                        <a href="customer-support.html" title="Contact Member Care">Contact Us.</a>
                                    </p>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<div class='l-footer__top'>
    <div class='footer-quick-bar l-contain'>
        <div class='footer-quick-bar__item footer-quick-bar__item--routing'>
            <img src="templates/bank-pro/icons/footer-icons/citadel-credit-union-routing-number.svg" alt="" />
            <div class="footer-quick-bar__text">
                <h2 class='footer-quick-bar__item-header'>Routing #</h2>
                <h3 class='footer-quick-bar__item-subtitle'>251480576</h3>
            </div>
        </div>
        <div class='footer-quick-bar__item footer-quick-bar__item--clock'>
            <img src="templates/bank-pro/icons/prefooter-icons/icoclock.png" alt="" />
            <div class="footer-quick-bar__text">
                <h2 class='footer-quick-bar__item-header'>Branch Hours: <span class='weight-reg'>Mon - Thurs: 8:30
                        a.m.-5:00 p.m.</span></h2>
                <h2 class='footer-quick-bar__item-header'>Friday: <span class='weight-reg'>8:30 a.m.-6:00 p.m.</span>
                </h2>
                <h2 class='footer-quick-bar__item-header'>Saturday: <span class='weight-reg'>9:00 a.m.-1:00 p.m.</span>
                </h2>
            </div>
        </div>
        <div class='footer-quick-bar__item footer-quick-bar__item--phone'>
            <img src="templates/bank-pro/icons/footer-icons/call-citadel-credit-union.svg" alt="" />
            <div class="footer-quick-bar__text">
                <h2 class='footer-quick-bar__item-header'><a
                        class="footer-quick-bar__item-header footer-quick-bar__item-header--phone"
                        href="mailto:support@everguardtb.com">support@everguardtb.com</a></h2>
                <h3 class='footer-quick-bar__item-subtitle'>Customer Service</h3>
            </div>
        </div>
        <div class='footer-quick-bar__item footer-quick-bar__item--video'>
            <img src="templates/bank-pro/footer-images/live-video-call.png" alt="" />
            <div class="footer-quick-bar__text">
                <h2 class='footer-quick-bar__item-header'><a
                        class="footer-quick-bar__item-header footer-quick-bar__item-header--video" href="#"
                        onclick="alert('Temporarily unavailable, please contact us via Email')">Video
                        Connect</a></h2>
                <h3 class='footer-quick-bar__item-subtitle'>Chat Virtually</h3>
            </div>
        </div>
    </div>
</div>
@include("home.footer")