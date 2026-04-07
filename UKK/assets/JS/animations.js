// ===== BUTTON CLICK ANIMATIONS =====

// Ripple effect untuk semua button
document.addEventListener('DOMContentLoaded', function() {
    
    // Tambah ripple effect ke semua button, link dengan class btn, dan nav-item
    const clickableElements = document.querySelectorAll('button, .btn, .nav-item, a[href*="page="]');
    
    clickableElements.forEach(element => {
        element.addEventListener('click', function(e) {
            // Ripple effect
            createRipple(e, this);
            
            // Scale animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    });
    
    // Hover effect untuk cards
    const cards = document.querySelectorAll('.card, .main-table-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Smooth scroll untuk semua link internal
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Loading animation untuk form submit
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
                submitBtn.style.opacity = '0.7';
            }
        });
    });
    
    // Fade in animation untuk elements saat page load
    const fadeElements = document.querySelectorAll('.card, .main-table-card, .navbar-top');
    fadeElements.forEach((element, index) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.5s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Function untuk create ripple effect
function createRipple(event, element) {
    const ripple = document.createElement('span');
    const rect = element.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = event.clientX - rect.left - size / 2;
    const y = event.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple-effect');
    
    // Remove existing ripples
    const existingRipple = element.querySelector('.ripple-effect');
    if (existingRipple) {
        existingRipple.remove();
    }
    
    element.style.position = 'relative';
    element.style.overflow = 'hidden';
    element.appendChild(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
}

// Notification toast animation
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `
        <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
        ${message}
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.classList.add('show');
    }, 100);
    
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }, 3000);
}

// Konfirmasi delete dengan animasi
document.addEventListener('click', function(e) {
    const deleteBtn = e.target.closest('a[onclick*="confirm"]');
    if (deleteBtn) {
        e.preventDefault();
        const confirmMsg = deleteBtn.getAttribute('onclick').match(/'([^']+)'/)[1];
        
        if (confirm(confirmMsg)) {
            // Animasi sebelum redirect
            deleteBtn.style.transition = 'all 0.3s ease';
            deleteBtn.style.transform = 'scale(0)';
            deleteBtn.style.opacity = '0';
            
            setTimeout(() => {
                window.location.href = deleteBtn.href;
            }, 300);
        }
    }
});

// Parallax effect untuk decorative circles
document.addEventListener('mousemove', function(e) {
    const circles = document.querySelectorAll('[style*="border-radius: 50%"]');
    circles.forEach(circle => {
        const speed = circle.offsetWidth / 100;
        const x = (window.innerWidth - e.pageX * speed) / 100;
        const y = (window.innerHeight - e.pageY * speed) / 100;
        
        circle.style.transform = `translate(${x}px, ${y}px)`;
        circle.style.transition = 'transform 0.3s ease';
    });
});
