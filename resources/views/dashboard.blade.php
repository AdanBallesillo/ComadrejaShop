<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comadreja Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Inter', sans-serif; background-color: #F9FAFB;">
    <nav class="w-full px-8 py-4 flex justify-between items-center" style="background-color: white; border-bottom: 1px solid #B9EBD7;">
        <h1 class="text-xl font-bold" style="color: #111827;">Comadreja Shop</h1>
        <div class="flex items-center gap-4">
            <span style="color: #111827;">Hola, {{ auth()->user()->name }}</span>
            <span class="px-3 py-1 rounded-full text-xs font-medium" style="background-color: #B9EBD7; color: #111827;">
                {{ ucfirst(auth()->user()->role) }}
            </span>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="text-sm px-4 py-2 rounded-lg text-white" style="background-color: #2563EB;">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </nav>
    <div class="max-w-4xl mx-auto mt-12 text-center">
        <h2 class="text-3xl font-bold" style="color: #111827;">¡Bienvenido a Comadreja Shop!</h2>
        <p class="mt-2" style="color: #6B7280;">Tu cuenta ha sido creada exitosamente.</p>
    </div>
</body>
</html>
