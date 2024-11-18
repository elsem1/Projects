<x-layout>
    <section>
        <div class="min-h-screen flex flex-col">
            <div class="flex-grow">
                <div class="section">
                    <!-- Form Part -->
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
        
                        <form id="login" class="input-group">
                            <input type="text" class="input-field" placeholder="User Id" required>
                            <input type="text" class="input-field" placeholder="Enter Password" required>
                            <input type="checkbox" class="check-box"><span>Remember Password</span>
                            <button type="submit" class="submit-btn">Log in</button>
                        </form>
        
                        <form id="register" class="input-group">
                            <input type="text" name="name" class="input-field" id="name" placeholder="Name of user" required>
                            <input type="text" name="username" class="input-field" id="username" placeholder="User Id" required>
                            <input type="email" name="email" id="email" class="input-field" placeholder="Email Id" required>
                            <input type="email" name="email_confirmation" id="email" class="input-field" placeholder="Email confirmation" required>
                            <input type="password" name="password" id="password" class="input-field" placeholder="Enter Password" required>
                            <input type="checkbox" class="check-box"><span>I agree to the <a href="#" class="hover:underline">terms & condition</a></span>
                            <button type="submit" class="submit-btn">Register</button> <!-- Change text to 'Register' -->
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
        var formBox = document.querySelector('.form-box');
    
        function adjustHeight() {
            formBox.style.height = (x.scrollHeight, y.scrollHeight) + "px"; 
        }
    
        function register() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
            formBox.style.height = y.scrollHeight + "px"; 
        }
    
        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
            formBox.style.height = x.scrollHeight + "px"; 
        }
    
        
        window.onload = function() {
            adjustHeight(); 
        }
    </script>
    
    
    
</x-layout>
