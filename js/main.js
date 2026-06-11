// Cambio de tema oscuro/claro
const themeToggle = document.getElementById('themeToggle');
const html = document.documentElement;

// Verificar preferencia guardada
const savedTheme = localStorage.getItem('theme') || 'light';
html.setAttribute('data-theme', savedTheme);

themeToggle.addEventListener('click', () => {
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    
    html.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
});

// Cambio de idioma
function changeLang(lang) {
    const currentLang = document.getElementById('currentLang');
    currentLang.textContent = lang.toUpperCase();
    
    // Guardar preferencia
    localStorage.setItem('language', lang);
    
    // Recargar pagina con nuevo idioma (implementar segun necesites)
    // window.location.href = `?lang=${lang}`;
}

// Cargar idioma guardado
const savedLang = localStorage.getItem('language') || 'es';
document.getElementById('currentLang').textContent = savedLang.toUpperCase();

// Animacion al hacer scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

document.querySelectorAll('.alumno-card').forEach(card => {
    observer.observe(card);
});