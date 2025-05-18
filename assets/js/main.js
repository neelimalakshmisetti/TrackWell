// Track-Well Main JS
// Animations, transitions, and logic for navigation and form interactivity

document.addEventListener('DOMContentLoaded', function() {
    // Animate logo and title
    const title = document.querySelector('.animated-title');
    if (title) {
        title.classList.add('show');
    }

    // Google sign-in placeholder
    const googleBtn = document.getElementById('google-signin');
    if (googleBtn) {
        googleBtn.addEventListener('click', function() {
            alert('Google Sign-In is a placeholder in this demo.');
        });
    }

    // Show/hide menstrual questions if gender is female
    const genderSelect = document.getElementById('gender');
    if (genderSelect) {
        genderSelect.addEventListener('change', function() {
            let menstrual = document.getElementById('menstrual-section');
            if (this.value === 'female') {
                menstrual.style.display = 'block';
            } else {
                menstrual.style.display = 'none';
            }
        });
    }

    // Option button animation
    let optionBtns = document.querySelectorAll('.option-btn');
    optionBtns.forEach(btn => {
        btn.addEventListener('mousedown', () => btn.classList.add('pressed'));
        btn.addEventListener('mouseup', () => btn.classList.remove('pressed'));
        btn.addEventListener('mouseleave', () => btn.classList.remove('pressed'));
    });
});
