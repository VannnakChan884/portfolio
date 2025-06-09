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
            translations: window.portfolioTranslations || {} // Initialize with empty object as fallback
        }
    },
    mounted() {
        this.fetchProjects();
        this.setupResumeDownload();
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
            document.getElementById('downloadResume').addEventListener('click', () => {
                this.generateResumePDF();
            });
        },
        generateResumePDF() {
            // Get translations from PHP
            const translations = this.translations;
            
            // Create a resume template
            const resumeContent = document.createElement('div');
            resumeContent.className = 'p-8 bg-white text-gray-800';
            
            // Add your resume content
            resumeContent.innerHTML = `
                <style>
                    body { font-family: Arial, sans-serif; }
                    h1 { color: #3182CE; font-size: 24pt; margin-bottom: 5px; }
                    h2 { color: #2C5282; font-size: 18pt; margin-bottom: 15px; }
                    h3 { color: #3182CE; border-bottom: 1px solid #3182CE; padding-bottom: 3px; margin-top: 15px; }
                    .section { margin-bottom: 15px; }
                    .contact-info { margin-bottom: 20px; }
                    .skills-list { columns: 2; }
                    .experience-item { margin-bottom: 10px; }
                </style>
                
                <div class="header text-center mb-8">
                    <h1>${translations.hero_title}</h1>
                    <h2>${translations.hero_subtitle}</h2>
                    <div class="contact-info">
                        <p>Email: vannakchan884@gmail.com | Phone: (+855) 96 26 65 240</p>
                    </div>
                </div>
                
                <div class="section">
                    <h3>${translations.about_title}</h3>
                    <p><strong>${translations.education}</strong> - Bachelor's Degree in Management Information Systems</p>
                    <p><strong>${translations.experience_one}</strong> - Provide design services for posters, logos, stickers, packaging</p>
                    <p><strong>${translations.experience_two}</strong> - Created posters for promoting products on social media</p>
                    <p><strong>${translations.experience_three}</strong> - Providing technical assistance and network solutions</p>
                    <p><strong>${translations.current_job}</strong> - Providing technical assistance and network solutions</p>
                </div>
                
                <div class="section">
                    <h3>${translations.skills_title}</h3>
                    <div class="skills-list">
                        <p><strong>${translations.design_skills.split(':')[0]}:</strong> ${translations.design_skills.split(':')[1]}</p>
                        <p><strong>${translations.it_skills.split(':')[0]}:</strong> ${translations.it_skills.split(':')[1]}</p>
                        <p><strong>${translations.code_skills.split(':')[0]}:</strong> ${translations.code_skills.split(':')[1]}</p>
                    </div>
                </div>
                
                <div class="section">
                    <h3>${translations.projects_title}</h3>
                    <div class="projects-grid">
                        ${this.projects.map(project => `
                            <div class="experience-item">
                                <p><strong>${project.title}</strong> - ${project.description}</p>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;

            // Generate PDF options
            const options = {
                margin: 10,
                filename: `${translations.hero_title}_Resume.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { 
                    scale: 2,
                    letterRendering: true,
                    useCORS: true 
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