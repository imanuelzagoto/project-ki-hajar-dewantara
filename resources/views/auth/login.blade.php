@extends('layouts.auth')

@section('login')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 order-lg-1 order-md-1">
                <div class="login-card">
                    <form action="{{ route('loginservice') }}" method="post" class="theme-form login-form">
                        <h4 class="signin-heading">Masuk</h4>
                        <h6 class="welcome-message">Masukkan email dan password Anda untuk masuk!</h6>
                        <div class="garis-horizontal">
                            <div class="bagian"></div>
                            <div class="bagian"></div>
                        </div>
                        @csrf
                        <div class="custom-input">
                            <div class="">
                                <label class="email-address">Email*</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email"
                                    type="email" name="email" placeholder="mail@simmmple.com"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="go-up text-danger">{{ $message }}</span>
                                @enderror
                                @if ($errors->has('login'))
                                    <div class="text-danger">{{ $errors->first('login') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="custom-input">
                            <div class=" ">
                                <label class="password-address">Password*</label>
                                <div class="password-container">
                                    <input class="form-control password-input @error('password') is-invalid @enderror"
                                        id="password" type="password" name="password" placeholder="Min. 8 characters">
                                    <i class="fas fa-eye eye-icon" aria-hidden="true" style="color: #7A7B7D"></i>
                                </div>
                                @error('password')
                                    <span class="go-up text-danger">{{ $message }}</span>
                                @enderror
                                @if ($errors->has('login'))
                                    <div class="text-danger">{{ $errors->first('login') }}</div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn signin_button">Masuk</button>
                    </form>
                </div>
                <div>
                    <span class="copyright">@2024 SIOPS. INTEK Company.</span>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 p-0 order-lg-2 order-md-2 d-none d-md-block position-relative">
                <div class="codew-image">
                    <img class="position-absolute start-50 translate-middle codew-png" src="sets/images/login/plogin.svg"
                        alt="tempimage">
                </div>
                <div class="rectangle-bordered">
                    <div class="position-absolute start-50 translate-middle rectangle">
                        <div class="intek-company">
                            An official website for INTEK company
                        </div>
                        <div class="kihajar-com">
                            SIOPS.com
                        </div>
                    </div>
                </div>
                <img class="bg-img-cover bg-center img-fluid" src="{{ 'sets/images/login/templogin.jpg' }}"
                    alt="looginpage">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.querySelector('.password-input');
            const eyeIcon = document.querySelector('.eye-icon');

            eyeIcon.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        });
    </script>
@endsection
