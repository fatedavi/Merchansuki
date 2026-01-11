<!-- Navbar Partial -->
<nav class="sticky top-0 z-50 bg-indigo-950/95 backdrop-blur-lg shadow-lg border-b border-purple-500/30">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-3 lg:py-4">
            <!-- Logo -->
            <a href="#" class="flex items-center space-x-2 lg:space-x-3 group">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center glow-effect">
                    <i class="fas fa-heart text-white text-lg lg:text-xl"></i>
                </div>
                <span class="text-xl lg:text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                    Merchansuki
                </span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                <a href="#" class="text-purple-200 hover:text-white transition-colors duration-300 font-medium text-sm xl:text-base">Home</a>
                <div class="relative group">
                    <button class="text-purple-200 hover:text-white transition-colors duration-300 font-medium flex items-center text-sm xl:text-base">
                        Dakimakura <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>
                </div>
                <a href="#" class="text-purple-200 hover:text-white transition-colors duration-300 font-medium text-sm xl:text-base">Custom Print</a>
                <a href="#" class="text-purple-200 hover:text-white transition-colors duration-300 font-medium text-sm xl:text-base">Fan Art Merch</a>
                <a href="#" class="text-purple-200 hover:text-white transition-colors duration-300 font-medium text-sm xl:text-base">About</a>
            </div>

            <!-- Right Menu -->
            <div class="flex items-center space-x-3 lg:space-x-4">
                <button class="hidden md:block text-purple-200 hover:text-white transition-colors">
                    <i class="fas fa-search text-base lg:text-lg"></i>
                </button>
                <button class="relative text-purple-200 hover:text-white transition-colors">
                    <i class="fas fa-shopping-cart text-base lg:text-lg"></i>
                    <span class="absolute -top-2 -right-2 bg-pink-500 text-white text-xs rounded-full w-4 h-4 lg:w-5 lg:h-5 flex items-center justify-center font-bold text-[10px] lg:text-xs">0</span>
                </button>
                <button class="hidden md:block bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 px-4 lg:px-6 py-2 rounded-full font-semibold text-sm lg:text-base transition-all duration-300 glow-effect">
                    Login
                </button>
                <!-- Mobile Menu Toggle -->
                <button class="lg:hidden text-white" id="mobile-menu-btn">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="lg:hidden hidden pb-4" id="mobile-menu">
            <div class="flex flex-col space-y-3">
                <a href="#" class="text-purple-200 hover:text-white transition-colors py-2 text-sm">Home</a>
                <a href="#" class="text-purple-200 hover:text-white transition-colors py-2 text-sm">Dakimakura</a>
                <a href="#" class="text-purple-200 hover:text-white transition-colors py-2 text-sm">Custom Print</a>
                <a href="#" class="text-purple-200 hover:text-white transition-colors py-2 text-sm">Fan Art Merch</a>
                <a href="#" class="text-purple-200 hover:text-white transition-colors py-2 text-sm">About</a>
                <button class="md:hidden bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 px-6 py-2 rounded-full font-semibold text-sm transition-all duration-300 text-center">
                    Login
                </button>
            </div>
        </div>
    </div>
</nav>
