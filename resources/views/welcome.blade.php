<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to To-Do List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
        body {
            background-color: aqua
}
</style>
<body class="min-h-screen flex flex-col justify-center items-center bg-cyan-400">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Welcome to To-Do List App</h1>
    <p class="text-lg text-black-600 mb-6">Manage your tasks efficiently and stay productive with ToList!    </p>
    <div class="space-x-4">
        @guest
            <a href="/login" class="px-6 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">Login</a>
            <a href="/register" class="px-6 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600">Register</a>

        @endguest

        @auth
        <a href="/kegiatan" class="px-6 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">Masuk</a>

        @endauth
        {{-- <a href="/kegiatan" class="px-6 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-blue-600">Masuk</a> --}}
    </div>
</body>
</html>