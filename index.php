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
                        primary: {
                            500: '#FFFFFF',
                            600: '#2C5282',
                        },
                        dark: {
                            800: '#2D3748',
                            700: '#4A5568',
                            600: '#3182CE',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-primary dark:bg-secondary text-gray-800 dark:text-white min-h-screen transition-colors duration-300">
    <?php include 'includes/header.php'; ?>
    
    <div id="app">
        <!-- Hero Section -->
        <section id="home" class="hero-pattern pt-24 pb-16 md:pt-32 md:pb-24">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-8 md:mb-0 flex justify-center">
                        <div class="w-48 h-48 md:w-64 md:h-64 rounded-full overflow-hidden border-4 border-primary dark:border-secondary shadow-lg">
                            <img src="assets/images/avatar.png" alt="Vannak's Profile Photo" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="md:w-1/2 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl font-bold text-primary dark:text-secondary mb-2"><?= $translations['hero_title'] ?></h1>
                        <h2 class="text-xl md:text-2xl text-primary dark:text-secondary mb-6"><?= $translations['hero_subtitle'] ?></h2>
                        <p class="text-gray-600 mb-8 max-w-lg mx-auto md:mx-0">
                            Bridging technology and creativity to deliver seamless digital experiences and robust IT solutions.
                        </p>
                        <a href="#projects" class="bg-secondary hover:bg-primary-600 text-secondary font-medium px-8 py-3 rounded-lg btn inline-block">
                            <?= $translations['view_work'] ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="py-16 bg-white dark:bg-gray-800">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-primary text-center mb-12"><?= $translations['about_title'] ?></h2>
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/2 mb-8 md:mb-0">
                        <h3 class="text-xl font-semibold text-primary mb-4">Education & Career</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fa-solid fa-graduation-cap text-accent mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-secondary"><?= $translations['education'] ?></h4>
                                    <p class="text-gray-600">Bachelor's Degree in Management Information Systems</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-briefcase text-accent mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-secondary"><?= $translations['experience'] ?></h4>
                                    <p class="text-gray-600">Created visual concepts to communicate ideas</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-server text-accent mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium text-secondary"><?= $translations['current_job']?></h4>
                                    <p class="text-gray-600">Providing technical assistance and network solutions</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="md:w-1/2 md:pl-12">
                        <h3 class="text-xl font-semibold text-primary mb-4">My Journey</h3>
                        <p class="text-gray-600 mb-4">
                            With a background in both design and information systems, I've cultivated a unique skill set that allows me to bridge the gap between technical functionality and aesthetic appeal.
                        </p>
                        <p class="text-gray-600 mb-4">
                            My journey began in graphic design, where I developed a keen eye for visual communication. This foundation led me to explore the technical side of digital experiences, eventually specializing in IT support and web development.
                        </p>
                        <p class="text-gray-600">
                            Today, I combine these skills to create solutions that are not only technically sound but also visually compelling and user-friendly.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section id="skills" class="py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-primary text-center mb-12"><?= $translations['skills_title'] ?></h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Design Skills -->
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 p-3 rounded-full mr-4">
                                <i class="fa-solid fa-palette text-accent text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-primary"><?= explode(':', $translations['design_skills'])[0] ?></h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-accent rounded-full mr-3"></div>
                                <span class="text-secondary"><?= explode(':', $translations['design_skills'])[1] ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- IT Skills -->
                     <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 p-3 rounded-full mr-4">
                                <i class="fa-solid fa-network-wired text-accent text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-primary"><?= explode(':', $translations['it_skills'])[0] ?></h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-accent rounded-full mr-3"></div>
                                <span class="text-secondary"><?= explode(':', $translations['it_skills'])[1] ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Coding Skills -->
                     <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 p-3 rounded-full mr-4">
                                <i class="fa-solid fa-code text-accent text-xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-primary"><?= explode(':', $translations['code_skills'])[0] ?></h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-accent rounded-full mr-3"></div>
                                <span class="text-secondary"><?= explode(':', $translations['code_skills'])[1] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="py-16 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-primary text-center mb-12"><?= $translations['projects_title'] ?></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div v-for="project in projects" :key="project.id" class="project-card bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-md">
                        <div class="h-48 overflow-hidden">
                            <img :src="project.image_url" :alt="project.title" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-primary mb-2">{{ project.title }}</h3>
                            <p class="text-gray-600 text-sm dark:text-gray-300 mb-3">{{ project.description }}</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded dark:bg-primary-900 dark:text-primary-200">
                                    {{ project.category }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-primary text-center mb-12"><?= $translations['contact_title'] ?></h2>
                <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
                    <form @submit.prevent="submitForm" class="bg-white dark:bg-gray-800 space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-secondary mb-1"><?= $translations['name'] ?></label>
                            <input v-model="contact.name" type="text" required class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-secondary mb-1"><?= $translations['email'] ?></label>
                            <input v-model="contact.email" type="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent">
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block text-sm font-medium text-secondary mb-1"><?= $translations['message'] ?></label>
                            <textarea v-model="contact.message" rows="5" required class="w-full px-4 py-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-accent hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-md btn">
                                <?= $translations['submit'] ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/main.js"></script>
</body>
</html>