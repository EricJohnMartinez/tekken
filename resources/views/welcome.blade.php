<!DOCTYPE html>
<html lang="en">
<style>
    body {
        background-image: url('http://minsu.edu.ph/template/images/slides/slides_2.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: top center;
        border-top-right-radius: 8px;
        border-top-left-radius: 8px;
        height: 100vh !important;

    }
</style>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-rjKzzx1VcPB+CGZvbtV/s8OfzX9XVIZ+OosyJ7V3A1e+Ja2sOKs1s4Zz0JQUd8l9A+DUJL0Tf1YjKlJ6xHYxkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-lm3X9D1b11mrU6dRyGp5+Z5oz5f5i5Z6iv2q3B1/c6dy1y6UfM6YRy6U/SiZPhKT05b0Nx0ZawELTxIzH9XQ2Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <title>Welcome</title>
</head>

<body>

    <div class="container my-5 text-center">
        <img src="http://minsu.edu.ph/template/images/logo.png" alt="Logo" />
        <h3 class="my-3 text-white">Welcome to Mindoro State University</h3>
        <h1 class="my-3 text-white">MinSU-AlumnConnect</h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Login') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                        <a class="btn btn-danger" href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </a>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif

                                        <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                            data-bs-target="#termsModal">
                                            {{ __('Terms and Conditions') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Trigger the modal when the button is clicked
            $('[data-bs-toggle="modal"]').click(function() {
                var targetModal = $(this).attr('data-bs-target');
                $(targetModal).modal('show');
            });
        });
    </script>
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body" style="text-align: justify;">
                    <!-- Add your terms and conditions content here -->
                    <p>Welcome to AlumnConnect! These Terms and Conditions ("Terms") govern your use of the AlumnConnect platform ("Platform") and outline the commitments we make to protect your data and ensure its confidentiality. By using AlumnConnect, you agree to abide by these Terms. Please read them carefully.</p>
                    <p>1. Data Protection and Confidentiality</p>
                        <p>1.1 Data Security: AlumnConnect is committed to protecting the confidentiality and security of the data you provide on the platform. We implement industry-standard measures to safeguard your personal information from unauthorized access, use, or disclosure.</p>
                        <p>1.2 Data Collection: When you use AlumnConnect, we collect certain personal information from you. This information may include your name, contact details, educational background, and professional information. We only collect data that is necessary for the functioning of the platform and providing you with relevant services.</p>
                        <p>1.3 Use of Data: AlumnConnect will only use your personal data for the purposes outlined in our Privacy Policy. We will not share, sell, or lease your personal information to third parties without your explicit consent, except as required by law.</p>
                        <p>1.4 Confidentiality: AlumnConnect recognizes the importance of maintaining the confidentiality of your data. We undertake to ensure that any non-public information you provide on the platform will be treated as confidential and will not be disclosed to any unauthorized third party, except as required by law or with your explicit consent.</p>
                        <p>1.5 Data Storage: AlumnConnect stores your data in secure servers and follows industry best practices to protect your information. However, please note that no method of data transmission or storage is 100% secure, and we cannot guarantee the absolute security of your data.</p>
                        <p>2. User Responsibilities</p>
                        <p>2.1 Accurate Information: You are responsible for providing accurate and up-to-date information when using AlumnConnect. Please ensure that the data you input is correct and complete.</p>
                        <p>2.2 User Consent: By using AlumnConnect, you confirm that you have the necessary rights and consents to share any personal information you provide on the platform.</p>
                        <p>2.3 Security Measures: You agree to take appropriate measures to maintain the security of your AlumnConnect account, including keeping your login credentials confidential and promptly notifying us of any unauthorized access or use.</p>
                        <p>2.4 Third-Party Links: AlumnConnect may contain links to third-party websites or services. We are not responsible for the privacy practices or content of these third-party sites. Please review their respective terms and privacy policies before using them.</p>
                        <p>3. Limitation of Liability</p>
                        <p>3.1 AlumnConnect strives to provide a secure and reliable platform. However, we cannot guarantee uninterrupted access or freedom from technical issues, malicious attacks, or other disruptions. You acknowledge that your use of AlumnConnect is at your own risk.</p>
                        <p>3.2 To the fullest extent permitted by applicable law, AlumnConnect and its affiliates shall not be liable for any direct, indirect, incidental, consequential, or special damages arising out of or in connection with your use of the platform or any breach of data security, including but not limited to loss of profits, data, or reputation.</p>
                        <p>4. Governing Law and Dispute Resolution</p>
                        <p>4.1 These Terms shall be governed by and construed in accordance with the laws of [Jurisdiction], without regard to its conflict of laws principles.</p>
                        <p>4.2 Any disputes arising out of or relating to these Terms shall be resolved amicably through good-faith negotiations. If a resolution cannot be reached, the dispute shall be submitted to binding arbitration in accordance with the rules of [Arbitration Institution].</p>
                        <p>4.3 Any legal action or proceedings against AlumnConnect shall be brought exclusively in the courts of [Jurisdiction].</p>
                        <p>Please note that these Terms and Conditions may be updated from time to time,</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
