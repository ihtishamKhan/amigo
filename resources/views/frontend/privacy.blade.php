@extends('layouts.master-without-nav')

@section('title')
    Privacy Policy - Amigos
@endsection

@section('body')

    <body>
    @endsection

    @section('content')
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="card overflow-hidden">
                            <div class="bg-primary-subtle">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h4 class="text-primary fw-bold">Privacy Policy</h4>
                                            <p>Last Updated: 30 September 2025</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('build/images/profile-img.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="privacy-content">
                                    <div class="mb-4">
                                        <p>Amigos App respects your privacy and is committed to protecting the personal
                                            information you share with us. This Privacy Policy describes how we collect,
                                            use, disclose, and safeguard your data when you use our mobile application and
                                            related services.</p>
                                        <p>By using Amigos App, you agree to the practices described in this policy.</p>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">1. Information We Collect</h5>
                                        <p>When you use Amigos App to place takeaway orders, we may collect the following
                                            information:</p>

                                        <h6 class="mt-3">a. Personal Information</h6>
                                        <ul class="list-unstyled ps-3">
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Name</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Phone number</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Email address</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Delivery address</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Order history</li>
                                        </ul>

                                        <h6 class="mt-3">b. Payment Information</h6>
                                        <ul class="list-unstyled ps-3">
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Card details (handled
                                                securely via third-party payment processors; we do not store full card
                                                information)</li>
                                        </ul>

                                        <h6 class="mt-3">c. Location Information</h6>
                                        <ul class="list-unstyled ps-3">
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>With your consent, we
                                                may collect your device's location to provide delivery or pickup options.
                                            </li>
                                        </ul>

                                        <h6 class="mt-3">d. Device and Usage Data</h6>
                                        <ul class="list-unstyled ps-3">
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>IP address</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Device type and
                                                operating system</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>App usage data (such
                                                as menu items viewed, orders placed)</li>
                                        </ul>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">2. How We Use Your Information</h5>
                                        <p>We use your information to:</p>
                                        <ul class="list-unstyled ps-3">
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Process and deliver
                                                takeaway orders</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Communicate order
                                                status and confirmations</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Improve the app and
                                                personalize your experience</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Send you promotional
                                                offers (if you opt-in)</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Provide customer
                                                support</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Detect and prevent
                                                fraud or abuse</li>
                                        </ul>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">3. Sharing Your Information</h5>
                                        <p>We may share your data with:</p>
                                        <ul class="list-unstyled ps-3">
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Delivery Providers to
                                                deliver your food</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Payment Processors to
                                                process transactions securely</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Service Providers
                                                (e.g., hosting, analytics) who assist with app operations</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>Authorities when
                                                required by law or to protect rights and safety</li>
                                        </ul>
                                        <p class="mt-3">We do <strong>not</strong> sell your personal data to third
                                            parties.</p>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">4. Your Choices</h5>
                                        <ul class="list-unstyled ps-3">
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>You can disable
                                                location sharing via your device settings.</li>
                                            <li><i class="mdi mdi-circle-small text-primary me-2"></i>You can contact us to
                                                request access to, correction, or deletion of your data.</li>
                                        </ul>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">5. Data Security</h5>
                                        <p>We implement security measures to protect your information, including encryption
                                            and secure servers. However, no method of transmission is 100% secure.</p>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">6. Retention</h5>
                                        <p>We retain your data only as long as necessary to provide services, comply with
                                            legal obligations, or resolve disputes.</p>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">8. Changes to This Policy</h5>
                                        <p>We may update this Privacy Policy periodically. We will notify you of any major
                                            changes by updating the policy within the app.</p>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">9. Contact Us</h5>
                                        <p>If you have any questions about this Privacy Policy, please contact us at:</p>
                                        <p><strong>Phone:</strong> 0191 250 2226</p>
                                        <p><strong>Address:</strong> 1 West View, Dudley, NE23 7AD</p>
                                        <p><strong>Email:</strong> amigospizza23@gmail.com</p>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">10. Our Right</h5>
                                        <p>The management has the right to refuse online orders or refuse refunds or has the
                                            right to change the price and offers at any time.</p>
                                    </div>

                                    <div class="mb-4">
                                        <h5 class="text-primary">11. Allergy and Dietary Information</h5>
                                        <p>While we may display information provided by Amigos Pizza regarding allergens or
                                            dietary content, we do <strong>not</strong> guarantee the accuracy or
                                            completeness of this information.</p>
                                        <p>Cross-contamination may occur in kitchens, even if a dish is listed as "free
                                            from" a certain ingredient.</p>
                                        <p>If you have a <strong>severe food allergy or intolerance</strong>, we strongly
                                            advise you to contact the Amigos Pizza directly before placing your order to
                                            ensure it is safe for your consumption.</p>
                                        <p>It is your responsibility to consult with the Amigos Pizza directly if you have
                                            any food allergies, intolerances, or dietary restrictions. Amigos App is not
                                            liable for any reactions or issues that may arise from food ordered through the
                                            App.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            {{-- <p>
                                <a href="index" class="fw-medium text-primary"> Return to Home </a>
                            </p> --}}
                            <p>
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Amigos. Made with
                                <i class="mdi mdi-heart text-danger"></i> by Amigos Team
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
