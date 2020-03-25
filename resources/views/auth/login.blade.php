<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials.head')
    </head>
    <body class="authentication-bg authentication-bg-pattern">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">
                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <a href="{{ url("/") }}">
                                        <span><img src="assets/images/logo-dark.png" alt="" height="80"></span>
                                    </a>
                                </div>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger bg-danger text-white border-0">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <form role="form" method="POST" action="{{ url('login') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group mb-3">
                                        <label for="name">@lang("global.login_email")</label>
                                        <input class="form-control" type="email" name="email" value="{{ old('name') }}" required="" placeholder="@lang("global.login_email_placeholder")">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">@lang("global.login_password")</label>
                                        <input class="form-control" type="password" required="" name="password" placeholder="@lang("global.login_password_placeholder")">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> @lang("global.login") </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.javascripts')
    </body>
</html>