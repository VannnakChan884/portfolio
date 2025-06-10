// Main Vue app
const app = Vue.createApp({
    data() {
        return {
            projects: [],
            contact: {
                name: '',
                email: '',
                message: ''
            },
            translations: window.portfolioTranslations || {
                // Fallback translations if not available
                hero_title: 'VANNAK',
                hero_subtitle: 'IT Support & Graphic Designer',
                about_title: 'ABOUT ME',
                education: 'SETEC Institute – MIS',
                experience_one: 'Graphic Designer at Reach Both Graphic',
                experience_two: 'Marketing Designer at Company',
                experience_three: 'IT Support Specialist at Company',
                current_job: 'Current IT Support Role',
                skills_title: 'SKILLS',
                design_skills: 'Design: Photoshop, Illustrator, Figma',
                it_skills: 'IT: CCTV, Network Setup, Printer Config',
                code_skills: 'Code: HTML/CSS, JavaScript, PHP, MySQL',
                projects_title: 'PROJECTS',
                contact_title: 'CONTACT ME',
                name: 'Name',
                email: 'Email',
                message: 'Message',
                submit: 'Submit',
                view_work: 'View My Work'
            }
        }
    },
    mounted() {
        this.fetchProjects();
        this.setupResumeDownload();
        
        // Apply theme from PHP
        if (window.portfolioTheme) {
            document.documentElement.classList.toggle('dark', window.portfolioTheme === 'dark');
        }
    },
    methods: {
        async fetchProjects() {
            try {
                const response = await fetch('api/projects.php');
                this.projects = await response.json();
            } catch (error) {
                console.error('Error fetching projects:', error);
            }
        },
        async submitForm() {
            try {
                const response = await fetch('contact.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.contact)
                });
                
                const result = await response.json();
                
                if (result.success) {
                    alert('Message sent successfully!');
                    this.contact = { name: '', email: '', message: '' };
                } else {
                    alert('Error: ' + (result.error || 'Failed to send message'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        },
        setupResumeDownload() {
            const downloadBtn = document.getElementById('downloadResume');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', this.generateResumePDF);
            }
        },
        generateResumePDF() {
            // Create a temporary container for the resume
            const resumeContent = document.createElement('div');
            resumeContent.className = 'p-8 bg-white text-gray-800';
            
            // Resume HTML template
            resumeContent.innerHTML = `
                <!-- Hero Section -->
                <div class="section grid grid-cols-2 gap-4">
                    <img src="assets/images/avatar.png" alt="Vannak's Profile Photo">
                    <div class="grid grid-flow-col grid-rows-4 gap-4">
                        <h1 class="text-4xl font-bold text-primary mb-2">${this.translations.hero_title}</h1>
                        <h2 class="text-xl text-primary mb-6 font-medium">${this.translations.hero_subtitle}</h2>
                        <p class="text-primary mb-8 mx-auto font-light">Bridging technology and creativity to deliver seamless digital experiences and robust IT solutions.</p>
                        <p>Email: vannakchan884@gmail.com<br>Phone: (+855) 96 26 65 240</p>
                    </div>
                </div>

                <!-- About Section -->
                <div class="section">
                    <h2>${this.translations.about_title}</h2>
                    <!-- Education & Career -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold  mb-4">Education & Career</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <i class="fa-solid fa-graduation-cap mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium">${this.translations.education}</h4>
                                    <p class="font-light">Bachelor's Degree in Management Information Systems</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-briefcase mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium">${this.translations.experience_one}</h4>
                                    <p class="font-light">Provide design services for posters, logos, stickers, packaging... to customers.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-briefcase mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium">${this.translations.experience_two}</h4>
                                    <p class="font-light">Created posters for promoting products on social media.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-server mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium">${this.translations.experience_three}</h4>
                                    <p class="font-light">Providing technical assistance and network solutions.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fa-solid fa-server mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-medium">${this.translations.current_job}</h4>
                                    <p class="font-light">Providing technical assistance and network solutions.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- My Journey -->
                    <div>
                        <h3 class="text-xl font-semibold text-primary mb-4">My Journey</h3>
                        <p class="text-primagry mb-4">
                            With a background in both design and information systems, I've cultivated a unique skill set that allows me to bridge the gap between technical functionality and aesthetic appeal.
                            <br><br>My journey began in graphic design, where I developed a keen eye for visual communication. This foundation led me to explore the technical side of digital experiences, eventually specializing in IT support and web development.
                            <br><br>Today, I combine these skills to create solutions that are not only technically sound but also visually compelling and user-friendly.
                        </p>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="section">
                    <h3>${this.translations.skills_title}</h3>
                    <div>
                        <!-- Design Skills -->
                        <div>
                            <h4 class="font-bold">${this.translations.design_skills.split(':')[0]}</h4>
                            <p>
                                ${this.translations.design_skills.split(':')[1]} | 
                                ${this.translations.design_skills.split(':')[2]} | 
                                ${this.translations.design_skills.split(':')[3]} | 
                                ${this.translations.design_skills.split(':')[4]}
                            </p>
                        </div>

                        <!-- IT Skills -->
                        <div>
                            <h4 class="font-bold">${this.translations.it_skills.split(':')[0]}</h4>
                            <p>
                                ${this.translations.it_skills.split(':')[1]} | 
                                ${this.translations.it_skills.split(':')[2]} | 
                                ${this.translations.it_skills.split(':')[3]} | 
                                ${this.translations.it_skills.split(':')[4]}
                            </p>
                        </div>

                        <!-- Coding Skills -->
                        <div>
                            <h4 class="font-bold">${this.translations.code_skills.split(':')[0]}</h4>
                            <p>
                                ${this.translations.code_skills.split(':')[1]} | 
                                ${this.translations.code_skills.split(':')[2]} | 
                                ${this.translations.code_skills.split(':')[3]} | 
                                ${this.translations.code_skills.split(':')[4]} | 
                                ${this.translations.code_skills.split(':')[5]} | 
                                ${this.translations.code_skills.split(':')[6]} | 
                                ${this.translations.code_skills.split(':')[7]} | 
                                ${this.translations.code_skills.split(':')[8]}
                            </p>
                        </div>
                    </div>
                </div>
            `;

            // PDF generation options
            const options = {
                margin: 8,
                filename: `${this.translations.hero_title}_Resume.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { 
                    scale: 2,
                    letterRendering: true,
                    useCORS: true,
                    logging: false
                },
                jsPDF: { 
                    unit: 'mm', 
                    format: 'a4', 
                    orientation: 'portrait' 
                }
            };

            // Generate and download PDF
            html2pdf().set(options).from(resumeContent).save();
        }
    }
}).mount('#app');

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });

            // Close mobile menu if open
            if (headerApp.mobileMenuOpen) {
                headerApp.mobileMenuOpen = false;
            }
        }
    });
});