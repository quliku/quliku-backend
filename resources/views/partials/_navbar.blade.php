<nav class="sticky top-0 bg-white-primary z-10 shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between">
            <div class="flex space-x-7">
                <div>
                    <!-- Website Logo -->
                    <img alt="image-logo" src="/images/logo-with-text-horizontal.png" class="w-44 py-3" />
                </div>
                <!-- Primary Navbar items -->
                {{-- <div class="hidden md:flex items-center space-x-">
                    <a href="" class="py-4 px-2 text-green-500 border-b-4 border-green-500 font-semibold ">Home</a>
                    <a href=""
                        class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Services</a>
                    <a href=""
                        class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">About</a>
                    <a href=""
                        class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Contact
                        Us</a>
                </div> --}}
            </div>
            <!-- Secondary Navbar items -->
            <div class="hidden md:flex items-center space-x-3 ">
                <a href=""
                    class="py-2 px-2 font-medium text-black-primary hover:text-orange-primary transition duration-300">Gabung
                    Jadi Mitra</a>
                <a href=""
                    class="flex py-2 px-5 font-medium rounded-2xl bg-orange-primary hover:bg-orange-secondary text-white-primary transition duration-300">
                    <img alt="logo play-store" src="/images/play-store-white.png" class="w-6 h-6 mr-2" />
                    Quliku

                </a>
                <a href=""
                    class="flex py-2 px-5 font-medium text-black-primary rounded-2xl bg-white-primary border-2 border-orange-primary hover:bg-orange-secondary hover:text-white-primary transition duration-300">
                    <img alt="logo play-store" src="/images/play-store-orange.png" class="w-6 h-6 mr-2" />
                    Mitra
                    Quliku</a>
            </div>
            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button class="outline-none mobile-menu-button">
                    <svg class=" w-6 h-6 text-black-primary hover:text-orange-primary " x-show="!showMenu"
                        fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- mobile menu -->
    <div class="hidden mobile-menu">
        <ul>
            <li><a href=""
                    class="block text-sm px-2 py-4 text-black-primary hover:bg-orange-primary hover:text-white-primary hover:font-semibold transition duration-300">Gabung
                    Jadi Mitra</a></li>
            <li><a href=""
                    class="block text-sm px-2 py-4 hover:bg-orange-primary hover:text-white-primary hover:font-semibold transition duration-300">Aplikasi
                    Quliku</a></li>
            <li><a href=""
                    class="block text-sm px-2 py-4 hover:bg-orange-primary hover:text-white-primary hover:font-semibold transition duration-300">Aplikasi
                    Mitra Quliku</a>
            </li>
        </ul>
    </div>

    <script>
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });
    </script>
</nav>
