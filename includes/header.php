<header class="fixed top-0 xl:top-6 lg:top-4 left-0 right-0 z-50">
    <div class="hero-pattern backdrop-blur-sm max-w-6xl mx-auto bg-white/70 dark:bg-gray-800/70 shadow-md xl:rounded-full lg:rounded-full px-4 flex justify-between items-center">
        <a href="#home" class="text-xl font-bold text-primary dark:text-white py-4"><?= $translations['hero_title'] ?></a>
        
        <div class="flex items-center space-x-4">
            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="w-10 h-10 flex items-center text-primary dark:text-white justify-center md:hidden p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8 text-primary dark:text-white uppercase">
                <a href="#about" class="hover:text-gray-400 px-3 py-4 text-sm font-medium"><?= $translations['about_title'] ?></a>
                <a href="#skills" class="hover:text-gray-400 px-3 py-4 text-sm font-medium"><?= $translations['skills_title'] ?></a>
                <a href="#projects" class="hover:text-gray-400 px-3 py-4 text-sm font-medium"><?= $translations['projects_title'] ?></a>
                <a href="#contact" class="hover:text-gray-400 px-3 py-4 text-sm font-medium"><?= $translations['contact_title'] ?></a>
            </nav>

            <!-- Theme Toggle -->
            <button @click="toggleTheme" class="w-10 h-10 flex items-center justify-center text-primary dark:text-white p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                <i class="fa-solid fa-moon text-xl" v-if="theme === 'light'"></i>
                <i class="fa-solid fa-sun text-xl" v-else></i>
            </button>

            <!-- Language Selector -->
            <div class="relative group">
                <button class="w-10 h-10 flex items-center space-x-1 p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    <!-- <span class="uppercase"><?= $_SESSION['language'] ?></span> -->
                    <img src="assets/icons/language.png" alt="Language icon" class="w-full h-full object-cover">
                </button>
                <div class="absolute right-0 w-20 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg py-0 z-10 invisible group-hover:visible opacity-0 group-hover:opacity-100 transition">
                    <a href="?lang=en" class="block w-full text-left px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700">English</a>
                    <a href="?lang=kh" class="block w-full text-left px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700">ខ្មែរ</a>
                    <a href="?lang=zh" class="block w-full text-left px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700">中国</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div v-if="mobileMenuOpen" class="md:hidden bg-white dark:bg-gray-800 shadow-lg py-2 px-4">
        <a href="#about" class="block py-2 hover:text-primary-500 transition"><?= $translations['about_title'] ?></a>
        <a href="#skills" class="block py-2 hover:text-primary-500 transition"><?= $translations['skills_title'] ?></a>
        <a href="#projects" class="block py-2 hover:text-primary-500 transition"><?= $translations['projects_title'] ?></a>
        <a href="#contact" class="block py-2 hover:text-primary-500 transition"><?= $translations['contact_title'] ?></a>
    </div>
</header>

<script>
    // Header Vue component
    const headerApp = Vue.createApp({
        data() {
            return {
                theme: '<?= $theme ?>',
                mobileMenuOpen: false
            }
        },
        methods: {
            toggleTheme() {
                this.theme = this.theme === 'light' ? 'dark' : 'light';
                document.documentElement.classList.toggle('dark');
                document.cookie = `theme=${this.theme}; path=/; max-age=31536000`;
            }
        }
    }).mount('header');
</script>