@extends('layouts.front-end.app')

@section('title', translate('privacy_policy'))

@section('content')
    <div class="container py-5 rtl text-align-direction">
        <h2 class="text-center mb-3 headerTitle">{{ translate('privacy_policy') }}</h2>
        <div class="card __card">
            <div class="card-body text-justify">
                {{-- {!! $privacyPolicy !!} --}}
                <div class="container py-5">
                    {{-- <h1 class="mb-4">Privacy Policy</h1> --}}

                    <p>At {{ config('app.name') }}, we are committed to protecting your privacy. This Privacy Policy
                        explains how we collect, use, disclose, and safeguard your information when you visit our website or
                        make a purchase from our store.</p>

                    <h3>1. Information We Collect</h3>
                    <ul>
                        <li><strong>Personal Information:</strong> We collect your name, email address, phone number,
                            shipping/billing address, and payment details when you make a purchase or create an account.
                        </li>
                        <li><strong>Device Information:</strong> We automatically collect data such as IP address, browser
                            type, device information, and pages visited to improve our services.</li>
                        <li><strong>Cookies:</strong> We use cookies to enhance user experience, analyze site traffic, and
                            personalize content.</li>
                    </ul>

                    <h3>2. How We Use Your Information</h3>
                    <ul>
                        <li>To process orders and manage payments</li>
                        <li>To deliver your products and provide order updates</li>
                        <li>To improve our store, services, and user experience</li>
                        <li>To send marketing communications (only if you opt in)</li>
                        <li>To prevent fraudulent transactions and ensure security</li>
                    </ul>

                    <h3>3. How We Share Your Information</h3>
                    <p>We do not sell or rent your personal information. We may share your information with:</p>
                    <ul>
                        <li>Trusted third-party service providers (e.g., payment processors, shipping companies)</li>
                        <li>Law enforcement or regulatory authorities if required by law</li>
                    </ul>

                    <h3>4. Your Rights</h3>
                    <ul>
                        <li>You can access, update, or delete your personal data at any time by contacting us.</li>
                        <li>You may unsubscribe from marketing emails by clicking the “unsubscribe” link in our emails.</li>
                    </ul>

                    <h3>5. Data Security</h3>
                    <p>We implement appropriate technical and organizational measures to protect your personal data from
                        unauthorized access, loss, or misuse.</p>

                    <h3>6. Third-Party Links</h3>
                    <p>Our website may contain links to third-party websites. We are not responsible for their privacy
                        practices or content.</p>

                    <h3>7. Changes to This Policy</h3>
                    <p>We reserve the right to update this Privacy Policy at any time. Changes will be posted on this page
                        with an updated revision date.</p>

                    <h3>8. Contact Us</h3>
                    <p>If you have any questions about this Privacy Policy, please contact us at: <br>
                        <strong>Email:</strong> support@{{ request() - > getHost() }}
                    </p>
                </div>

            </div>
        </div>
    </div>
@endsection
