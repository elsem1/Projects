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

                        <div class="social-icons flex justify-center space-x-4">
                            <a href="https://www.fb.com/"><img src="{{ asset('fb.png') }}"></a>
                            <a href="https://www.twitter.com/"><img src="{{ asset('tw.png') }}"></a>
                            <a href="https://www.google.com/"><img src="{{ asset('gp.png') }}"></a>
                        </div>

                        <form id="login" class="input-group" method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="email" name="email" class="input-field" placeholder="Email" required>
                            <x-form-error name="email"/>

                            <input type="password" name="password" class="input-field" placeholder="Enter Password" required>
                            <x-form-error name="password"/>
                            <input type="checkbox" class="check-box"><span>Remember Password</span>
                            <button type="submit" class="submit-btn">Log in</button>

                        </form>

                        <form id="register" class="input-group" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="name" class="input-field" placeholder="Name" required>
                            <input type="text" name="username" class="input-field" placeholder="Username" required>
                            <input type="email" name="email" class="input-field" placeholder="Email" required>
                            <input type="email" name="email_confirmation" class="input-field" placeholder="Confirm Email" required>
                            <input type="password" name="password" class="input-field" placeholder="Password" required>
                            <input type="password" name="password_confirmation" class="input-field" placeholder="Confirm Password" required>
                            <div>
                                <input type="checkbox" class="check-box" required>
                                <span>I agree to the <a href="#" class="hover:underline">terms & conditions</a></span>
                            </div>
                            <button type="submit" class="submit-btn">Register</button>
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

		function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0";
        }

	</script>



</x-layout>
