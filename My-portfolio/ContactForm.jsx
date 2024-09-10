import React, { useState, useEffect } from 'react';

const ContactForm = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: ''
  });
  const [notification, setNotification] = useState(null);
  const [isDarkMode, setIsDarkMode] = useState(false);

  useEffect(() => {
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === 'dark') {
      setIsDarkMode(true);
      document.documentElement.setAttribute('data-theme', 'dark');
    }
  }, []);

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (validateForm()) {
      try {
        const response = await fetch('submit_form.php', {
          method: 'POST',
          body: JSON.stringify(formData),
          headers: {
            'Content-Type': 'application/json'
          }
        });
        
        if (response.ok) {
          showNotification('Message sent successfully!', 'success');
          setFormData({ name: '', email: '', message: '' });
        } else {
          throw new Error('Server response was not OK.');
        }
      } catch (error) {
        console.error('Error:', error);
        showNotification('Failed to send message. Please try again.', 'error');
      }
    }
  };

  const toggleTheme = () => {
    if (isDarkMode) {
      document.documentElement.setAttribute('data-theme', 'light');
      localStorage.setItem('theme', 'light');
    } else {
      document.documentElement.setAttribute('data-theme', 'dark');
      localStorage.setItem('theme', 'dark');
    }
    setIsDarkMode(!isDarkMode);
  };

  const validateForm = () => {
    // ... 验证逻辑 ...
  };

  const showNotification = (message, type) => {
    setNotification({ message, type });
    setTimeout(() => setNotification(null), 3000);
  };

  return (
    <section id="contact" className="section">
      <p className="section__text__p1">Get in Touch</p>
      <h1 className="title">Contact Me</h1>
      <div className="theme-switch-wrapper">
        <label className="theme-switch" htmlFor="checkbox">
          <input
            type="checkbox"
            id="checkbox"
            checked={isDarkMode}
            onChange={toggleTheme}
          />
          <div className="slider round"></div>
        </label>
        <em>Switch Theme</em>
      </div>
      <form onSubmit={handleSubmit} className="contact-form">
        <div className="form-group">
          <input
            type="text"
            name="name"
            value={formData.name}
            onChange={handleChange}
            placeholder="Your Name"
            required
          />
        </div>
        <div className="form-group">
          <input
            type="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            placeholder="Your Email"
            required
          />
        </div>
        <div className="form-group">
          <textarea
            name="message"
            value={formData.message}
            onChange={handleChange}
            placeholder="Your Message"
            required
          ></textarea>
        </div>
        <button type="submit" className="btn btn-color-1">Send Message</button>
      </form>
      {notification && (
        <div className={`notification ${notification.type}`}>
          {notification.message}
        </div>
      )}
    </section>
  );
};

export default ContactForm;