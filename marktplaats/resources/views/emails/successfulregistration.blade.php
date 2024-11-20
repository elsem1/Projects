<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful Registration</title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
        
    </style>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto my-8 p-6 bg-white shadow-md rounded-lg">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-700">Welcome to Semper Agora!</h1>
        </div>
        <div class="mt-4 text-gray-600">
            <p class="mb-4">Hi {{ $user->name }},</p>
            <p class="mb-4">We're excited to have you on board. Your registration was successful!</p>
            <p class="mb-4">Feel free to explore and let us know if you have any questions or need assistance.</p>
            <p class="mb-4">Welcome once again!</p>
            <p>Best regards,<br>The Semper Agora Team</p>
        </div>
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} Semper Agora. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
