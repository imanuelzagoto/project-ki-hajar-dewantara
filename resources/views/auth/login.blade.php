@extends('layouts.auth')

@section('login')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 order-lg-1 order-md-1">
                <div class="login-card">
                    <form action="{{ route('loginservice') }}" method="post" class="theme-form login-form">
                        <h4 class="signin-heading">Sign In</h4>
                        <h6 class="welcome-message">Enter your email and password to sign in!</h6>
                        <div class="garis-horizontal">
                            <div class="bagian"></div>
                            <div class="bagian"></div>
                        </div>
                        @csrf
                        <div class="form-group custom-input">
                            <label class="email-address">Email*</label>
                            <input class="form-control" id="email" type="email" name="email" required
                                placeholder="mail@simmmple.com">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group custom-password-input">
                                <label class="password-address">Password*</label>
                                <input class="form-control input_password" id="password" type="password" name="password"
                                    required placeholder="*********">
                                <i data-feather="eye" id="toggleIcon" class="toggle-password"></i>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn signin_button">Sign In</button>
                    </form>
                </div>
                <div class="col-md-12 text-center">
                    <p class="copyright">© 2022 Ki Hadjar Dewantara</p>
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


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"
        integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    {{-- <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: '{{ route('loginuser') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(JSON.stringify(response.user));
                        localStorage.setItem('token', response.token);
                        localStorage.setItem('user', JSON.stringify(response.user));
                        // Redirect ke halaman home.index
                        window.location.href = '{{ route('home.index') }}';
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script> --}}
@endsection
