<?php
// Start session for language preference
session_start();

// Set default language to English if not set
if (!isset($_SESSION['language'])) {
    $_SESSION['language'] = 'en';
}

// Change language if requested
if (isset($_GET['lang'])) {
    $_SESSION['language'] = $_GET['lang'];
}

// Load translations
$translations = require 'languages/' . $_SESSION['language'] . '.php';

// Set theme preference
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
?>
<!DOCTYPE html>
<html lang="en" class="<?= $theme ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vannak - Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="shortcut icon" href="assets/images/avatar.png" type="image/x-icon">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#3182CE',
                        secondary: '#FFFFFF',
                    },
                    borderColor: {
                        primary: '#3182CE',
                        secondary: '#FFFFFF',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-secondary dark:bg-primary text-primary dark:text-secondary min-h-screen transition-colors duration-300">
    <?php include 'includes/header.php'; ?>

    <!-- Pass translations to JavaScript -->
    <script>
        window.portfolioTranslations = <?= json_encode($translations) ?>;
        window.portfolioTheme = '<?= $theme ?>';
    </script>
    
    <div id="app">
        <!-- Hero Section -->
        <section id="home" class="hero-pattern hero pt-48 pb-24 md:px-32">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-8 md:mb-0 flex justify-center">
                        <div class="w-48 h-48 md:w-64 md:h-64 rounded-full overflow-hidden border-4 border-primary dark:border-white shadow-lg">
                            <img src="assets/images/avatar.png" alt="Vannak's Profile Photo" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="md:w-1/2 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl font-bold text-primary dark:text-gray-600 mb-2"><?= $translations['hero_title'] ?></h1>
                        <h2 class="text-xl md:text-2xl text-primary dark:text-gray-500 mb-6 font-medium"><?= $translations['hero_subtitle'] ?></h2>
                        <p class="text-primary dark:text-gray-500 mb-8 max-w-lg mx-auto md:mx-0 font-light">
                            Bridging technology and creativity to deliver seamless digital experiences and robust IT solutions.
                        </p>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                            <a href="#projects" class="bg-primary dark:bg-gray-600 hover:bg-gray-900 dark:hover:bg-primary text-secondary font-medium text-center p-3 rounded-lg btn inline-block">
                                <?= $translations['view_work'] ?>
                            </a>
                            
                            <button id="downloadResume" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Resume
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-16 bg-secondary dark:bg-gray-900 text-primary dark:text-secondary">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center mb-12"><?= $translations['about_title'] ?></h2>
                <div class="flex flex-col md:flex-row">
                    <!-- Education & Career -->
                    <div class="md:w-1/2 mb-8 md:mb-0">
                        <h3 class="text-xl font-semibold  mb-4">Education & Career</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fa-solid fa-graduation-cap mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium"><?= $translations['education'] ?></h4>
                                    <p class="font-light">Bachelor's Degree in Management Information Systems</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-briefcase mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium"><?= $translations['experience_one'] ?></h4>
                                    <p class="font-light">Provide design services for posters, logos, stickers, packaging... to customers.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-briefcase mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium"><?= $translations['experience_two'] ?></h4>
                                    <p class="font-light">Created posters for promoting products on social media.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-server mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium"><?= $translations['experience_three'] ?></h4>
                                    <p class="font-light">Providing technical assistance and network solutions.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-server mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium"><?= $translations['current_job']?></h4>
                                    <p class="font-light">Providing technical assistance and network solutions.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- My Journey -->
                    <div class="md:w-1/2 md:pl-12">
                        <h3 class="text-xl font-semibold text-primary dark:text-secondary mb-4">My Journey</h3>
                        <p class="text-primagry dark:text-secondary mb-4">
                            With a background in both design and information systems, I've cultivated a unique skill set that allows me to bridge the gap between technical functionality and aesthetic appeal.
                        </p>
                        <p class="text-primagry dark:text-secondary mb-4">
                            My journey began in graphic design, where I developed a keen eye for visual communication. This foundation led me to explore the technical side of digital experiences, eventually specializing in IT support and web development.
                        </p>
                        <p class="text-primagry dark:text-secondary">
                            Today, I combine these skills to create solutions that are not only technically sound but also visually compelling and user-friendly.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section id="skills" class="py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-primary dark:text-gray-800 text-center mb-12"><?= $translations['skills_title'] ?></h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Design Skills -->
                    <div class="bg-secondary dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 dark:bg-gray-900 p-3 rounded-full mr-4">
                                <i class="fa-solid fa-palette text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-primary dark:text-secondary"><?= explode(':', $translations['design_skills'])[0] ?></h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <ul class="ml-6">
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-solid fa-pen-nib text-sm"></i>
                                            </div>
                                            <span><?= explode(':', $translations['design_skills'])[1] ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-solid fa-vector-square"></i>
                                            </div>
                                            <span><?= explode(':', $translations['design_skills'])[2] ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-brands fa-figma"></i>
                                            </div>
                                            <span><?= explode(':', $translations['design_skills'])[3] ?></span>
                                        </div> 
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-brands fa-sketch"></i>
                                            </div>
                                            <span><?= explode(':', $translations['design_skills'])[4] ?></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- IT Skills -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 dark:bg-gray-900 p-3 rounded-full mr-4">
                                <i class="fa-solid fa-network-wired text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-primary dark:text-secondary"><?= explode(':', $translations['it_skills'])[0] ?></h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <ul class="ml-6">
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-solid fa-camera"></i>
                                            </div>
                                            <span><?= explode(':', $translations['it_skills'])[1] ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-solid fa-print"></i>
                                            </div>
                                            <span><?= explode(':', $translations['it_skills'])[2] ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                            </div>
                                            <span><?= explode(':', $translations['it_skills'])[3] ?></span>
                                        </div> 
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-solid fa-users-gear"></i>
                                            </div>
                                            <span><?= explode(':', $translations['it_skills'])[4] ?></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Coding Skills -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 dark:bg-gray-900 p-3 rounded-full mr-4">
                                <i class="fa-solid fa-code text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-primary dark:text-secondary"><?= explode(':', $translations['code_skills'])[0] ?></h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <ul class="ml-6">
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-brands fa-html5"></i>
                                            </div>
                                            <span><?= explode(':', $translations['code_skills'])[1] ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-brands fa-css3-alt"></i>
                                            </div>
                                            <span><?= explode(':', $translations['code_skills'])[2] ?></span>
                                            <span> / <?= explode(':', $translations['code_skills'])[3] ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-brands fa-js"></i>
                                            </div>
                                            <span><?= explode(':', $translations['code_skills'])[4] ?></span>
                                            <span> / <i class="fa-brands fa-vuejs w-6 h-6"></i><?= explode(':', $translations['code_skills'])[5] ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-brands fa-php"></i>
                                            </div>
                                            <span><?= explode(':', $translations['code_skills'])[6] ?></span>
                                            <span> / <i class="fa-brands fa-laravel w-6 h-6"></i><?= explode(':', $translations['code_skills'])[7] ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 flex items-center justify-center p-3 rounded-full mr-2">
                                                <i class="fa-solid fa-database"></i>
                                            </div>
                                            <span><?= explode(':', $translations['code_skills'])[8] ?></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="py-16 bg-secondary">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-primary dark:text-gray-800 text-center mb-12"><?= $translations['projects_title'] ?></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div v-for="project in projects" :key="project.id" class="project-card bg-gray-50 dark:bg-gray-800 rounded-xl overflow-hidden shadow-md">
                        <div class="h-48 overflow-hidden">
                            <img :src="`../admin/uploads/${project.image}`" :alt="project.image" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-primary dark:text-secondary mb-2">{{ project.title }}</h3>
                            <p class="text-primary text-sm dark:text-secondary mb-3">{{ project.description }}</p>
                            <div>
                                <a :href="`${project.project_link}`" target="_blank" class="bg-primary text-secondary text-xs px-2 py-1 rounded dark:bg-gray-900 dark:text-secondary">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-primary dark:text-gray-800 text-center mb-12"><?= $translations['contact_title'] ?></h2>
                <div class="bg-secondary dark:bg-gray-800 p-8 rounded-lg shadow-md">
                    <form @submit.prevent="submitForm" class="text-primary dark:text-secondary space-y-6">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium mb-1"><?= $translations['name'] ?></label>
                                <div class="mt-2">
                                    <input v-model="contact.name" type="text" name="name" id="name" required class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="email" class="block text-sm font-medium mb-1"><?= $translations['email'] ?></label>
                                <div class="mt-2">
                                    <input v-model="contact.email" type="email" name="email" id="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                                </div>
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium mb-1"><?= $translations['message'] ?></label>
                            <textarea v-model="contact.message" rows="5" required class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-primary dark:bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-4 rounded-md btn">
                                <?= $translations['submit'] ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>

    <!-- html2pdf library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>
</html>