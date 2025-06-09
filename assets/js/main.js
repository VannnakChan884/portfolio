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
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    h1 { color: #3182CE; font-size: 24pt; margin-bottom: 5px; }
                    h2 { color: #2C5282; font-size: 18pt; margin-bottom: 15px; }
                    h3 { color: #3182CE; border-bottom: 1px solid #3182CE; padding-bottom: 3px; margin-top: 20px; }
                    .section { margin-bottom: 20px; }
                    .contact-info { margin-bottom: 25px; text-align: center; }
                    .skills-list { columns: 2; margin-top: 10px; }
                    .experience-item { margin-bottom: 12px; }
                    .project-item { margin-bottom: 12px; }
                </style>
                
                <div class="header">
                    <h1 class="text-center">${this.translations.hero_title}</h1>
                    <h2 class="text-center">${this.translations.hero_subtitle}</h2>
                    <div class="contact-info">
                        <p>Email: your.email@example.com | Phone: (123) 456-7890</p>
                    </div>
                </div>
                
                <div class="section">
                    <h3>${this.translations.about_title}</h3>
                    <div class="experience-item">
                        <p><strong>${this.translations.education}</strong></p>
                        <p>Bachelor's Degree in Management Information Systems</p>
                    </div>
                    <div class="experience-item">
                        <p><strong>${this.translations.experience_one}</strong></p>
                        <p>Provide design services for posters, logos, stickers, packaging</p>
                    </div>
                    <div class="experience-item">
                        <p><strong>${this.translations.experience_two}</strong></p>
                        <p>Created posters for promoting products on social media</p>
                    </div>
                    <div class="experience-item">
                        <p><strong>${this.translations.experience_three}</strong></p>
                        <p>Providing technical assistance and network solutions</p>
                    </div>
                    <div class="experience-item">
                        <p><strong>${this.translations.current_job}</strong></p>
                        <p>Providing technical assistance and network solutions</p>
                    </div>
                </div>
                
                <div class="section">
                    <h3>${this.translations.skills_title}</h3>
                    <div class="skills-list">
                        <p><strong>${this.translations.design_skills.split(':')[0]}:</strong> ${this.translations.design_skills.split(':')[1]}</p>
                        <p><strong>${this.translations.it_skills.split(':')[0]}:</strong> ${this.translations.it_skills.split(':')[1]}</p>
                        <p><strong>${this.translations.code_skills.split(':')[0]}:</strong> ${this.translations.code_skills.split(':')[1]}</p>
                    </div>
                </div>
                
                <div class="section">
                    <h3>${this.translations.projects_title}</h3>
                    ${this.projects.map(project => `
                        <div class="project-item">
                            <p><strong>${project.title}</strong></p>
                            <p>${project.description}</p>
                        </div>
                    `).join('')}
                </div>
            `;

            // PDF generation options
            const options = {
                margin: 10,
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
        }
    });
});

// Smooth scrolling for anchor links
// document.querySelectorAll('a[href^="#"]').forEach(anchor => {
//     anchor.addEventListener('click', function (e) {
//         e.preventDefault();
        
//         const targetId = this.getAttribute('href');
//         if (targetId === '#') return;
        
//         const targetElement = document.querySelector(targetId);
//         if (targetElement) {
//             window.scrollTo({
//                 top: targetElement.offsetTop - 80,
//                 behavior: 'smooth'
//             });
            
//             // Close mobile menu if open
//             if (headerApp.mobileMenuOpen) {
//                 headerApp.mobileMenuOpen = false;
//             }
//         }
//     });
// });