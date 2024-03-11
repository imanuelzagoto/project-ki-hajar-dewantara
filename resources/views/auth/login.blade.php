@extends('layouts.auth')

@section('login')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 order-lg-1 order-md-1">
                <div class="login-card">
                    <form action="{{ route('login') }}" method="post" class="theme-form login-form">
                        <h4 class="signin-heading">Sign In</h4>
                        <h6 class="welcome-message">Enter your email and password to sign in!</h6>
                        <hr class="separator-left">
                        <hr class="separator-right">
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
                <div class="col-md-12 text-center">
                    <p class="copyright">© 2022 Ki Hadjar Dewantara</p>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 p-0 order-lg-2 order-md-2 d-none d-md-block position-relative">
                <img class="position-absolute start-50 translate-middle codew-png" src="sets/images/login/codew.png"
                    alt="tempimage">
                <div class="position-absolute start-50 translate-middle text-white textimage">
                    Ki Hadjar Dewantara
                </div>
                <div class="position-absolute start-50 translate-middle rectangle"></div>

                <div class="position-absolute start-50 translate-middle text-center text-white teks-rectangle">
                    An official website for INTEK company
                </div>
                <div class="position-absolute start-50 translate-middle text-center text-white kihadjar-teks">
                    kihadjar.com
                </div>
                <img class="bg-img-cover bg-center img-fluid" src="{{ 'sets/images/login/templogin.jpg' }}"
                    alt="looginpage">
            </div>

        </div>
    </div>
@endsection



{{-- <section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7"><img class="bg-img-cover bg-center" src="{{ asset('sets/images/login/surattt.png') }}"
                    alt="looginpage">
            </div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <form action="{{ route('login') }}" method="post" class="theme-form login-form">
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="email" name="email" required placeholder="email">
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control" type="password" name="password" required
                                    placeholder="*********">
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}
