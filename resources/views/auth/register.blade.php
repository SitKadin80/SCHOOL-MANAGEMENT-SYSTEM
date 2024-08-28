@extends('layout.hander')
    <main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mt-5">
                    <h3 class="card-header text-center">Register User</h3>
                    <div class="card-body">
                    <form action="{{ route('customRegistration') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Name" id="name" class="form-control" name="name" autofocus>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" placeholder="Email" id="email_address" class="form-control" name="email" autofocus>
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" placeholder="Password" id="password" class="form-control" name="password">
                            <i class="bx bxs-low-vision  position-absolute" id="eye" style="top: 35%; right: 10px; "></i>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group d-flex justify-content-between mb-3">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember Me</label>
                            </div>
                            <div class="form-group mb-3">
                                <a href="{{ route('login') }}">Login Account</a>
                            </div>
                        </div>
                        <div class="d-grid mx-auto">
                            <button type="submit" class="btn btn-success btn-block">Sign up</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.getElementById('eye').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.classList.remove('bxs-low-vision');
            this.classList.add('bx-show');
        } else {
            passwordInput.type = 'password';
            this.classList.remove('bx-show');
            this.classList.add('bxs-low-vision');
        }
    });
</script>