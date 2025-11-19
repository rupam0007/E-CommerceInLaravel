import './bootstrap';

// Theme toggle functionality
const THEME_KEY = 'theme-preference';

function getStoredTheme() {
    try {
        return localStorage.getItem(THEME_KEY);
    } catch {
        return null;
    }
}

function setStoredTheme(theme) {
    try {
        localStorage.setItem(THEME_KEY, theme);
    } catch {}
}

function getCurrentTheme() {
    const stored = getStoredTheme();
    if (stored) return stored;
    return 'dark'; // Default to dark theme
}

function applyTheme(theme) {
    const root = document.documentElement;
    
    if (theme === 'dark') {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
}

function updateThemeIcon(btn, theme) {
    const svg = btn.querySelector('svg');
    if (!svg) return;
    
    if (theme === 'dark') {
        // Show sun icon (for switching to light mode)
        svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>';
        btn.setAttribute('title', 'Switch to light mode');
    } else {
        // Show moon icon (for switching to dark mode)
        svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>';
        btn.setAttribute('title', 'Switch to dark mode');
    }
}

function toggleTheme() {
    const current = getCurrentTheme();
    const next = current === 'dark' ? 'light' : 'dark';
    
    setStoredTheme(next);
    applyTheme(next);
    
    // Update all theme toggle buttons
    document.querySelectorAll('[data-theme-toggle]').forEach(btn => {
        updateThemeIcon(btn, next);
    });
}

function initTheme() {
    const theme = getCurrentTheme();
    applyTheme(theme);
    
    // Update all theme toggle buttons
    document.querySelectorAll('[data-theme-toggle]').forEach(btn => {
        updateThemeIcon(btn, theme);
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleTheme();
        });
    });
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTheme);
} else {
    initTheme();
}
