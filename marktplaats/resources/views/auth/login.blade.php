<x-layout>
    <section>
        <div class="min-h-screen flex flex-col">
            <div class="flex-grow">
                <div class="section">
                    <div class="form-box">
                        <div class="button-box">
                            <div id="btn"></div>
                            <button type="button" class="toggle-btn" onclick="login()">Login</button>
                            <button type="button" class="toggle-btn" onclick="register()">Register</button>
                        </div>


                        <form id="login" class="input-group form-hidden" method="POST"
                            action="{{ route('login') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="email" name="email" class="input-field" placeholder="Email" required>
                            <x-form-error name="email" />
                            <input type="password" name="password" class="input-field" placeholder="Enter Password"
                                required>
                            <x-form-error name="password" />
                            <div class="checkbox-wrapper">
                                <input type="checkbox" class="check-box" id="remember-password" name="remember">
                                <label for="remember-password">Remember Password</label>
                            </div>
                            <button type="submit" class="submit-btn">Log in</button>
                            @guest
                                <p class="small-text mt-2 text-right"><a
                                        onclick="forgotPassword()"class="hover:underline">Forgot Password?</a></p>
                            @endguest
                        </form>

                        <form id="register" class="input-group form-hidden" method="POST"
                            action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="name" class="input-field" placeholder="Name" required>
                            <input type="text" name="username" class="input-field" placeholder="Username" required>
                            <input type="email" name="email" class="input-field" placeholder="Email" required>
                            <input type="email" name="email_confirmation" class="input-field"
                                placeholder="Confirm Email" required>
                            <input type="password" name="password" class="input-field" placeholder="Password" required>
                            <input type="password" name="password_confirmation" class="input-field"
                                placeholder="Confirm Password" required>
                            <div>
                                <input type="checkbox" class="check-box" required>
                                <span>I agree to the <a href="#" class="hover:underline">terms &
                                        conditions</a></span>
                            </div>
                            <button type="submit" class="submit-btn">Register</button>
                        </form>

                        @if (session('status'))
                            <div id="flash-message" class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="forgot-password" class="input-group form-hidden" method="POST"
                            action="{{ route('password.email') }}" enctype="multipart/form-data">
                            @csrf
                            <p class="center-text text-m">Enter your email to receive a reset link by mail.</p>
                            <input type="email" name="email" class="input-field" placeholder="Email" required>
                            <button type="submit" class="submit-btn">Confirm</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("register");
        var z = document.getElementById("btn");
        var fp = document.getElementById("forgot-password");

        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
            fp.style.left = "450px";
            x.classList.add("form-hidden");
            y.classList.remove("form-hidden");
            fp.classList.add("form-hidden");
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
            fp.style.left = "450px";
            x.classList.remove("form-hidden");
            y.classList.add("form-hidden");
            fp.classList.add("form-hidden");
        }

        function forgotPassword() {
            x.style.left = "-400px";
            y.style.left = "450px";
            z.style.left = "0";
            fp.style.left = "50px";
            x.classList.add("form-hidden");
            y.classList.add("form-hidden");
            fp.classList.remove("form-hidden");
        }

        window.onload = function() {

            x.style.position = 'absolute';
            x.style.left = '50px';
            y.style.position = 'absolute';
            y.style.left = '450px';
            fp.style.position = 'absolute';
            fp.style.left = '450px';
            x.classList.remove("form-hidden");
            y.classList.add("form-hidden");
            fp.classList.add("form-hidden");
        }
    </script>

</x-layout>
