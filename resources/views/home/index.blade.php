<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adams Carpets</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-4">
            <h1 class="text-2xl font-bold text-gray-800">Adams Carpets</h1>
            <nav>
                <ul class="flex space-x-8">
                    <li><a href="#home" class="text-gray-700 hover:text-gray-900">Home</a></li>
                    <li><a href="#about" class="text-gray-700 hover:text-gray-900">About</a></li>
                    <li><a href="{{ route('carpets.index') }}" class="text-gray-700 hover:text-gray-900">Products</a></li>
                    <li><a href="#contact" class="text-gray-700 hover:text-gray-900">Contact</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-gray-900">Dashboard</a></li>
                    @endauth
                    @guest
                        <li><a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a></li>
                    @else
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:underline">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="relative bg-cover bg-center h-[500px] flex items-center justify-center text-center" style="background-image: url('carpet-images/Screenshot 2025-03-24 at 14.17.02.png');">
        <div class="bg-black bg-opacity-50 p-10 rounded-lg">
            <h2 class="text-4xl text-white font-semibold">Welcome to Adams Carpets</h2>
            <p class="text-gray-300 mt-2">Discover premium quality carpets that transform your space with elegance and comfort.</p>
            <a href="{{ route('carpets.index') }}" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Explore Collection</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800">About Us</h2>
            <p class="mt-4 text-gray-600">With over 20 years of experience, we provide the finest carpets that blend tradition with modern aesthetics.</p>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-gray-800 text-center">Our Collection</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ asset('carpet-images/persian-royal-silk.jpg') }}" alt="Luxury Persian Carpet" class="w-full">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">Luxury Persian Carpet</h3>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ asset('carpet-images/Cumbrian-Loop-Blencathra.jpg') }}" alt="Modern Wool Carpet" class="w-full">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">Modern Wool Carpet</h3>
                    </div>
                </div>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="carpet-images/classic-handmade-rug.jpg" alt="Classic Handmade Rug" class="w-full">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">Vintage Oriental Cotton</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-16 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800">Get in Touch</h2>
            <p class="text-gray-600 mt-2">Email: <a href="mailto:adamscarpets@hotmail.co.uk" class="text-blue-600 hover:underline">adamscarpets@hotmail.co.uk</a></p>
            <p class="text-gray-600">Phone: <a href="tel:+1234567890" class="text-blue-600 hover:underline">+123 456 7890</a></p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-6">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p>&copy; 2025 Adams Carpets. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
