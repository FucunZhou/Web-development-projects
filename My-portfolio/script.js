function toggleMenu() {
  const menu = document.querySelector(".menu-links");
  const icon = document.querySelector(".hamburger-icon");
  menu.classList.toggle("open");
  icon.classList.toggle("open");
}

// 回到顶部按钮
const backToTopButton = document.getElementById('back-to-top');

window.addEventListener('scroll', () => {
  if (window.pageYOffset > 300) {
    backToTopButton.classList.add('show');
  } else {
    backToTopButton.classList.remove('show');
  }
});

backToTopButton.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

// 表单验证
const contactForm = document.getElementById('contact-form');

contactForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  if (validateForm()) {
    try {
      const formData = new FormData(contactForm);
      const response = await fetch('submit_form.php', {
        method: 'POST',
        body: formData
      });
      
      if (response.ok) {
        showNotification('Message sent successfully!', 'success');
        contactForm.reset();
      } else {
        throw new Error('Server response was not OK.');
      }
    } catch (error) {
      console.error('Error:', error);
      showNotification('Failed to send message. Please try again.', 'error');
    }
  }
});

function validateForm() {
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const message = document.getElementById('message').value.trim();
  
  if (name === '' || email === '' || message === '') {
    showNotification('Please fill in all fields.', 'error');
    return false;
  }
  
  if (!isValidEmail(email)) {
    showNotification('Please enter a valid email address.', 'error');
    return false;
  }
  
  return true;
}

function isValidEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

function showNotification(message, type) {
  const notification = document.createElement('div');
  notification.textContent = message;
  notification.className = `notification ${type}`;
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.style.opacity = '0';
    setTimeout(() => notification.remove(), 500);
  }, 3000);
}

// 添加输入字段动画
const formInputs = document.querySelectorAll('.form-group input, .form-group textarea');

formInputs.forEach(input => {
  input.addEventListener('focus', () => {
    input.parentElement.classList.add('focused');
  });
  
  input.addEventListener('blur', () => {
    if (input.value === '') {
      input.parentElement.classList.remove('focused');
    }
  });
});

// 打字效果
const typingElement = document.querySelector('.typing');
const phrases = ['Web Developer', 'Problem Solver', 'Tech Enthusiast'];
let phraseIndex = 0;
let charIndex = 0;
let isDeleting = false;

function typeEffect() {
  const currentPhrase = phrases[phraseIndex];
  
  if (isDeleting) {
    typingElement.textContent = currentPhrase.substring(0, charIndex - 1);
    charIndex--;
  } else {
    typingElement.textContent = currentPhrase.substring(0, charIndex + 1);
    charIndex++;
  }
  
  if (!isDeleting && charIndex === currentPhrase.length) {
    isDeleting = true;
    setTimeout(typeEffect, 1500);
  } else if (isDeleting && charIndex === 0) {
    isDeleting = false;
    phraseIndex = (phraseIndex + 1) % phrases.length;
    setTimeout(typeEffect, 500);
  } else {
    setTimeout(typeEffect, isDeleting ? 50 : 100);
  }
}

typeEffect();
