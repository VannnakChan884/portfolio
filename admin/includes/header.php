<div class="flex">
    <div class="relative w-1/3 xl:w-1/6 lg:w-1/4 h-[100vh] bg-white shadow-xl">
        <nav>
            <div class="bg-gray-100 flex justify-center p-3 items-center text-center">
                <div class="w-2/5 rounded-xl overflow-hidden mr-3">
                    <img src="assets/images/avatar.jpg" alt="User Image" class="w-full h-full object-cover">
                </div>
                <h2 class="text-md font-bold uppercase">Portfolio Admin</h2>
            </div>
            <ul class="p-4">
                <li>
                    <a href="?page=dashboard" class="menu-item py-2 px-4 hover:bg-green-300 block rounded-xl" data-page="dashboard">Dashboard</a>
                </li>
                <li>
                    <a href="?page=projects" class="menu-item py-2 px-4 hover:bg-green-300 block rounded-xl" data-page="projects">Projects</a>
                </li>
                <li>
                    <a href="?page=messages" class="menu-item py-2 px-4 hover:bg-green-300 block rounded-xl" data-page="messages">Messages</a>
                </li>
                <li>
                    <a href="?page=profiles" class="menu-item py-2 px-4 hover:bg-green-300 block rounded-xl" data-page="profiles">Settings</a>
                </li>
            </ul>
        </nav>
        <!-- <div class="w-full absulote left-0 bottom-0 p-4">
            <div class="grid grid-rows-1 gap-4 justify-center">
                <p class="text-xs">© 2025 Vannak. All rights reserved.</p>
                <div class="flex space-x-6 justify-center">
                    <a href="#">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-linkedin-in text-xl"></i>
                    </a>
                </div>
            </div>
        </div> -->
    </div>
    <div class="w-full p-6">
        <div id="content" class="content-section">
            <div class="w-full mb-6 flex justify-between items-center">
                <a href="dashboard.php" class="text-2xl font-bold">Dashboard</a>
                <a href="auth/logout.php" class="w-8 h-8 flex items-center justify-center border-2 border-red-400 hover:border-white bg-white hover:bg-red-400 text-red-500 hover:text-white p-1 rounded-full">
                    <i class="fa-solid fa-power-off"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-4">
                <div class="bg-white shadow-md p-4 rounded-xl">
                    <h2 class="text-lg font-semibold">Total Projects</h2>
                    <p class="text-3xl font-bold mt-2"><?= $project_count ?></p>
                </div>

                <div class="bg-white shadow-md p-4 rounded-xl">
                    <h2 class="text-lg font-semibold">Total Users</h2>
                    <p class="text-3xl font-bold mt-2"><?= $user_count ?></p>
                </div>

                <div class="bg-white shadow-md p-4 rounded-xl">
                    <h2 class="text-lg font-semibold">Total Messages</h2>
                    <p class="text-3xl font-bold mt-2"><?= $message_count ?></p>
                </div>

                <div class="bg-white shadow-md p-4 rounded-xl">
                    <h2 class="text-lg font-semibold">Total Skills</h2>
                    <p class="text-3xl font-bold mt-2"><?= $skill_count ?></p>
                </div>
            </div>
        </div>
    </div>
</div>