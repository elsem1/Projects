<x-layout>
    <section>
        <div class="min-h-screen flex flex-col">
            <div class="flex-grow">
                <div class="section">
                    <div class="form-box">
                        <div class="button-box">
                            <div id="btn"></div>
                            <form id="reset-password" class="input-group" method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <p class="center-text">Reset your password</p>
                                <input type="email" name="email" class="input-field" placeholder="Email" required>
                                <x-form-error name="email"/>
                                <input type="password" name="password" class="input-field" placeholder="New Password" required>
                                <x-form-error name="password"/>
                                <input type="password" name="password_confirmation" class="input-field" placeholder="Confirm Password" required>
                                <x-form-error name="password_confirmation"/>
                                <button type="submit" class="submit-btn">Reset Password</button>
                            </form>
                            
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
</x-layout>
