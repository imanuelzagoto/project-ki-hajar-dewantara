@extends('layouts.auth')

@section('login')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 order-lg-1 order-md-1">
                <div class="login-card">
                    <form action="{{ route('login') }}" method="post" class="theme-form login-form">
                        <h4 class="signin-heading">Sign In</h4>
                        <h6 class="welcome-message">Enter your email and password to sign in!</h6>
                        <div class="garis-horizontal">
                            <div class="bagian"></div>
                            <div class="bagian"></div>
                        </div>
                        @csrf
                        <div class="form-group custom-input">
                            <label class="email-address">Email*</label>
                            <input class="form-control" type="email" name="email" required
                                placeholder="mail@simmmple.com">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group custom-password-input">
                            <label class="password-address">Password*</label>
                            <input class="form-control" type="password" name="password" required placeholder="*********">
                            <i data-feather="eye" id="toggleIcon" class="toggle-password"></i>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn signin-button">Sign In</button>
                    </form>

                </div>
                <div class="text-footer-login">
                    <div class="col-md-12 text-center">
                        <p class="copyright">© 2022 Ki Hadjar Dewantara</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 p-0 order-lg-2 order-md-2 d-none d-md-block position-relative">
                <div class="codew-image">
                    <img class="position-absolute start-50 translate-middle codew-png" src="sets/images/login/codew.png"
                        alt="tempimage">
                </div>
                <div class="text-center">
                    <div class="position-absolute start-50 translate-middle text-white dewantara-teks">
                        Ki Hadjar Dewantara
                    </div>
                </div>
                <div class="rectangle-bordered">
                    <div class="position-absolute start-50 translate-middle rectangle">
                        <div class="intek-company">
                            An official website for INTEK company
                        </div>
                        <div class="kihajar-com">
                            kihadjar.com
                        </div>
                    </div>
                </div>
                <img class="bg-img-cover bg-center img-fluid" src="{{ 'sets/images/login/templogin.jpg' }}"
                    alt="looginpage">
            </div>
        </div>
    </div>
@endsection
