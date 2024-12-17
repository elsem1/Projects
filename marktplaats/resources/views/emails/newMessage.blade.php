<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Message</title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto my-8 p-6 bg-white shadow-md rounded-lg">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-700">You received a new message!</h1>
        </div>
        <div class="mt-4 text-gray-600">
            <p class="mb-4">Hi {{ $user->name }},</p>
            <p class="mb-4">You have a new message:</p>
            <p class="mb-4">{{ $messageContent }}</p>

            <p class="mb-4">
                Check your <a href="{{ url('#') }}" class="text-blue-500 underline">inbox</a> for more details.
            </p>
            <p>Best regards,<br>The Semper Agora Team</p>
        </div>
        <div class="mt-6 text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} Semper Agora. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
