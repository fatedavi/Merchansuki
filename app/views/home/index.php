<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchansuki - Premium Anime Dakimakura Collection</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8b5cf6',
                        secondary: '#a78bfa',
                        accent: '#c084fc',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1e1b4b;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8b5cf6, #a78bfa);
            border-radius: 10px;
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carousel-slide {
            min-width: 100%;
            flex-shrink: 0;
        }

        .carousel-slide img {
            width: 90%;
            height: 90%;
            object-fit: cover;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .badge-pulse {
            animation: pulse-badge 2s ease-in-out infinite;
        }

        .glow-effect {
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.5);
        }

        .glow-effect:hover {
            box-shadow: 0 0 30px rgba(139, 92, 246, 0.8);
        }

        /* Placeholder untuk gambar banner */
        .banner-placeholder {
            background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 50%, #6366f1 100%);
            position: relative;
            overflow: hidden;
        }

        .banner-placeholder::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            100% { left: 100%; }
        }
    </style>
</head>
<body class="gradient-bg text-white">
    <!-- Top Bar -->
    <div class="bg-purple-900/50 backdrop-blur-md py-2 px-4 text-center text-xs sm:text-sm">
        <p class="text-purple-200">🎉 <span class="font-semibold">FREE SHIPPING</span> untuk pembelian di atas Rp 500.000! ✨</p>
    </div>
    <?php include __DIR__ . '/partials/navbar.php'; ?>

    <?php include __DIR__ . '/partials/hero.php'; ?>


    <?php include __DIR__ . '/partials/features.php'; ?>
<section class="max-w-7xl mx-auto px-4 mt-10">
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-500 via-purple-500 to-violet-500 shadow-xl">

        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_1px_1px,_white_1px,_transparent_0)] bg-[size:24px_24px]"></div>

        <div class="relative grid grid-cols-1 lg:grid-cols-2 items-center gap-8 px-8 py-14">

            <!-- LEFT : IMAGE -->
            <div class="flex justify-center lg:justify-start">
                <img 
                    src="/assets/images/Anya_Forger_Anime_png.png"
                    alt="Hero Character"
                    class="max-h-[420px] drop-shadow-2xl">
            </div>

            <!-- RIGHT : CONTENT -->
            <div class="text-white space-y-5">

                <span class="inline-block bg-white/20 text-sm px-4 py-1 rounded-full backdrop-blur">
                    MENERIMA PESANAN
                </span>

                <h1 class="text-3xl md:text-4xl xl:text-5xl font-bold leading-tight">
                    CUSTOM SELURUH DUNIA
                </h1>

                <p class="text-white/90 max-w-xl">
                    Kami menerima pesanan import dari seluruh dunia, dengan Jepang
                    sebagai negara utama. Hubungi kami untuk info lebih lanjut!
                </p>

                <div class="flex items-center gap-4 pt-4">
                    <a href="#"
                       class="bg-white text-indigo-600 font-semibold px-6 py-3 rounded-full hover:bg-indigo-50 transition">
                        Info Lebih Lanjut
                    </a>

       
                </div>

            </div>
        </div>
    </div>
</section>

   <!-- Product Section -->
<section class="py-12 sm:py-16 lg:py-20 xl:py-24 bg-gradient-to-b from-transparent to-indigo-950/50">
    <div class="container mx-auto px-4">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 sm:mb-10 lg:mb-12 gap-4">
            <div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Featured Collection
                </h2>
                <p class="text-purple-200 text-xs sm:text-sm lg:text-base">
                    Koleksi Terbaru & Paling Laris
                </p>
            </div>
        </div>

        <!-- Products -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">

            <?php foreach ($products as $product): ?>
                <div class="product-card glass-effect rounded-xl lg:rounded-2xl overflow-hidden group">

                    <!-- Image -->
                    <div class="relative overflow-hidden">
                        <div class="absolute top-2 right-2 bg-gradient-to-r from-pink-500 to-rose-500 text-white px-2 py-1 rounded-full text-[10px] font-bold badge-pulse z-10">
                            <?= $product['badge'] ?? 'HOT' ?>
                        </div>

                        <div class="w-full h-40 sm:h-48 lg:h-64 bg-slate-800 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <img
                            src="<?= htmlspecialchars($product['image']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>"
                            class="w-full h-full object-cover">

                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-3 sm:p-4 lg:p-5">
                        <h3 class="text-sm sm:text-base lg:text-xl font-bold mb-1 line-clamp-1">
                            <?= htmlspecialchars($product['name']) ?>
                        </h3>

                        <p class="text-purple-300 text-[10px] sm:text-xs mb-2 line-clamp-1">
                            160x50cm • Premium Material
                        </p>

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-base sm:text-lg lg:text-2xl font-bold text-pink-400">
                                Rp <?= number_format($product['price'], 0, ',', '.') ?>
                            </span>

                            <div class="flex items-center gap-1 text-yellow-400 text-[10px] sm:text-xs">
                                <i class="fas fa-star"></i>
                                <span class="font-semibold">
                                    <?= $product['rating'] ?? '4.9' ?>
                                </span>
                            </div>
                        </div>

                        <button class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 py-2 rounded-lg font-semibold text-xs transition-all duration-300 glow-effect">
                            <i class="fas fa-cart-plus mr-1"></i>
                            Add to Cart
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>


    <?php include __DIR__ . '/partials/footer.php'; ?>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Carousel
        const track = document.getElementById('carousel-track');
        const slides = document.querySelectorAll('.carousel-slide');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const indicators = document.querySelectorAll('.carousel-indicator');
        
        let currentSlide = 0;
        const totalSlides = slides.length;

        function updateCarousel() {
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
            indicators.forEach((indicator, index) => {
                if (index === currentSlide) {
                    indicator.classList.add('bg-white');
                    indicator.classList.remove('bg-white/50');
                } else {
                    indicator.classList.remove('bg-white');
                    indicator.classList.add('bg-white/50');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateCarousel();
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateCarousel();
        }

        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentSlide = index;
                updateCarousel();
            });
        });

        // Auto-play carousel
        setInterval(nextSlide, 5000);

        // Update first indicator
        updateCarousel();
    </script>
</body>
</html>
