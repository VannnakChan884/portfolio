// Main Vue app
const app = Vue.createApp({
    data() {
        return {
            projects: [],
            contact: {
                name: '',
                email: '',
                message: ''
            }
        }
    },
    mounted() {
        this.fetchProjects();
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