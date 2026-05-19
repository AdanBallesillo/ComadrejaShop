<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comadreja Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @livewireStyles
</head>
<body style="font-family: 'Inter', sans-serif; background-color: #F9FAFB;">
    {{ $slot }}
    @auth
        @if(auth()->user()->role !== 'admin')
            <livewire:chatbot.chat-flotante />
        @endif
    @endauth
    @livewireScripts
</body>
</html>
