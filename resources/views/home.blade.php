<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>🛕 Temple Management</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <style>
    /* General Styles */
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f4;
      color: #333;
    }

    /* Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      background: #333;
      color: #fff;
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
    }

    .navbar .nav-links {
      list-style: none;
      display: flex;
    }

    .navbar .nav-links li {
      margin: 0 15px;
    }

    .navbar .nav-links a {
      color: #fff;
      text-decoration: none;
      font-size: 18px;
      transition: color 0.3s ease;
    }

    .navbar .nav-links a:hover {
      color: #ff6f61;
    }

    /* Header Slider (Fixed Height and Width) */
    /* Header Section */
.header-section {
  height: 100vh; /* Full screen height */
  position: relative;
  overflow: hidden;
}

/* Background Image */
.header-section .background-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('assets/templewallpaper/w2.jpg'); /* Add your background image */
  background-size: cover;
  background-position: center;
  z-index: 1;
  animation: zoomEffect 20s infinite alternate;
}

@keyframes zoomEffect {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(1.1);
  }
}

/* Text Slider */
.header-section .text-slider {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
  z-index: 2;
  width: 80%;
  max-width: 800px;
}

.header-section .text-slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

.header-section .text-slide.active {
  opacity: 1;
}

.header-section .text-slide h1 {
  font-size: 48px;
  color: #fff;
  text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
  animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

   /* Temple Slider Section */
.temple-slider-section {
  padding: 50px 20px;
  background: #fff;
  text-align: center;
}

.temple-slider-section h2 {
  font-size: 36px;
  margin-bottom: 40px;
}

/* Temple Slider Container */
.temple-slider {
  display: flex;
  overflow: hidden;
  width: 100%;
  position: relative;
}

/* Temple Slide */
.temple-slide {
  flex: 0 0 auto;
  width: 300px; /* Fixed width for each slide */
  margin: 0 15px;
  text-align: center;
  animation: scroll 15s linear infinite; /* Smooth scrolling animation */
}

.temple-slide img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 10px;
}

.temple-slide h3 {
  font-size: 24px;
  margin: 15px 0;
}

.temple-slide .visit-button {
  padding: 10px 20px;
  font-size: 18px;
  background: #ff6f61;
  color: #fff;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  transition: background 0.3s ease;
}

.temple-slide .visit-button:hover {
  background: #e65a50;
}

/* Infinite Scroll Animation */
@keyframes scroll {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%); /* Move slides to the left */
  }
}

    /* Services Section */
    .services {
      padding: 50px 20px;
      background: #f4f4f4;
      text-align: center;
    }

    .services h2 {
      font-size: 36px;
      margin-bottom: 40px;
    }

    .cards {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
    }

    .card {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      width: 30%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin: 10px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .card h3 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    /* About Us Section */
    .about {
      padding: 50px 20px;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .about-image {
      width: 50%;
    }

    .about-image img {
      width: 100%;
      border-radius: 10px;
      transition: transform 0.3s ease;
    }

    .about-image img:hover {
      transform: scale(1.05);
    }

    .about-text {
      width: 50%;
      padding: 0 20px;
    }

    .about-text h2 {
      font-size: 36px;
      margin-bottom: 20px;
    }

    .about-text p {
      font-size: 18px;
      line-height: 1.6;
    }

    /* Contact Us Section */
    .contact {
      padding: 50px 20px;
      background: #f4f4f4;
      text-align: center;
    }

    .contact h2 {
      font-size: 36px;
      margin-bottom: 40px;
    }

    .contact form {
      max-width: 600px;
      margin: 0 auto;
    }

    .contact input,
    .contact textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .contact button {
      padding: 10px 20px;
      font-size: 18px;
      background: #ff6f61;
      color: #fff;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      transition: background 0.3s ease;
    }

    .contact button:hover {
      background: #e65a50;
    }

    /* Footer */
    .footer {
      background: #333;
      color: #fff;
      text-align: center;
      padding: 20px;
    }

    .footer-content {
      max-width: 1200px;
      margin: 0 auto;
    }

    .social-links {
      list-style: none;
      padding: 0;
      display: flex;
      justify-content: center;
    }

    .social-links li {
      margin: 0 10px;
    }

    .social-links a {
      color: #fff;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .social-links a:hover {
      color: #ff6f61;
    }

    /* Back to Top Button */
    .back-to-top {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #ff6f61;
      color: #fff;
      padding: 10px 15px;
      border-radius: 50%;
      cursor: pointer;
      display: none;
      transition: background 0.3s ease;
    }

    .back-to-top:hover {
      background: #e65a50;
    }
  </style>
</head>
<body>
    @php
    $user = Auth::user();
@endphp

<!-- Navbar -->
<nav class="navbar animate__animated animate__fadeInDown" style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background: black; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);">
    <div class="logo" style="color: white; font-weight: bold; font-size: 20px;">🛕 Temple Management</div>

    <ul class="nav-links" style="list-style: none; display: flex; gap: 20px; margin: 0; padding: 0;">
        <li style="padding: 10px;"><a href="#home" style="color: white; text-decoration: none; transition: 0.3s;" onmouseover="this.style.color='#ffcc00'" onmouseout="this.style.color='white'">Home</a></li>
        <li style="padding: 10px;"><a href="#services" style="color: white; text-decoration: none; transition: 0.3s;" onmouseover="this.style.color='#ffcc00'" onmouseout="this.style.color='white'">Services</a></li>
        <li style="padding: 10px;"><a href="#about" style="color: white; text-decoration: none; transition: 0.3s;" onmouseover="this.style.color='#ffcc00'" onmouseout="this.style.color='white'">About Us</a></li>
        <li style="padding: 10px;"><a href="#contact" style="color: white; text-decoration: none; transition: 0.3s;" onmouseover="this.style.color='#ffcc00'" onmouseout="this.style.color='white'">Contact Us</a></li>

        @if (!$user)
            <li style="padding: 10px;">
                <a href="{{ route('login') }}" style="color: white; text-decoration: none; transition: 0.3s;" onmouseover="this.style.color='#ffcc00'" onmouseout="this.style.color='white'">Login</a>
            </li>
        @else
            <!-- User Dropdown -->
            <li style="position: relative; padding: 10px; cursor: pointer;">
                <a href="#" style="text-decoration: none; color: white; transition: 0.3s;" onmouseover="this.style.color='#ffcc00'" onmouseout="this.style.color='white'">
                    Hello, {{ $user->first_name }} ▼
                </a>
                <ul class="dropdown-menu" style="display: none; position: absolute; background: #333; box-shadow: 0px 4px 6px rgba(255, 255, 255, 0.1); border-radius: 5px; width: 150px; right: 0; padding: 0; margin: 0; list-style: none;">
                    <li style="border-bottom: 1px solid #555;">
                        <a href="{{ route('user.profile') }}" style="display: block; padding: 10px; text-decoration: none; color: white; transition: 0.3s;" onmouseover="this.style.backgroundColor='#444'; this.style.color='#ffcc00'" onmouseout="this.style.backgroundColor='#333'; this.style.color='white'">
                            My Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" style="display: block; padding: 10px; text-decoration: none; color: white; transition: 0.3s;" onmouseover="this.style.backgroundColor='#444'; this.style.color='#ffcc00'" onmouseout="this.style.backgroundColor='#333'; this.style.color='white'">
                            Logout
                        </a>
                    </li>
                </ul>
            </li>

            <!-- JavaScript for Hover Effect -->
            <script>
                document.querySelector("li[style*='position: relative']").addEventListener("mouseover", function() {
                    this.querySelector(".dropdown-menu").style.display = "block";
                });
                document.querySelector("li[style*='position: relative']").addEventListener("mouseleave", function() {
                    this.querySelector(".dropdown-menu").style.display = "none";
                });
            </script>
        @endif
    </ul>
</nav>

  <section class="header-section">
    <div class="background-image"></div>
    <div class="text-slider">
      <div class="text-slide active">
        <h1>🕉️ "God is within you, around you, and everywhere."</h1>
      </div>
      <div class="text-slide">
        <h1>🙏 "Prayer is the key to heaven, and faith unlocks the door."</h1>
      </div>
      <div class="text-slide">
        <h1>🛕 "In the temple of God, every soul finds peace."</h1>
      </div>
      <div class="text-slide">
        <h1>🌟 "Faith is the light that guides us through darkness."</h1>
      </div>
    </div>
  </section>

  <!-- Temple Slider -->
<!-- Temple Slider Section -->
<section class="temple-slider-section">
  <h2>🛕 Explore Temples</h2>
  <div class="temple-slider">
    @foreach ($temples as $temple)
    <div class="temple-slide">
      <img src="{{ asset($temple->main_image) }}" alt="Temple 1">
      <h4>🛕 {{ $temple->name }}</h4>
      {{-- <button class="visit-button">Visit Temple 🙏</button> --}}
      <a href="{{ route('admin.viewTemple',$temple->id) }}" class="visit-button" style="text-decoration: none">Visit Temple</a>
    </div>
    @endforeach
  </div>
</section>

  <!-- Services Section -->
  <section class="services" id="services">
    <h2>Our Services 🛠️</h2>
    <div class="cards">
      <div class="card">
        <h3>Live Darshan 📹</h3>
        <p>Watch live darshan from the temple.</p>
      </div>
      <div class="card">
        <h3>Temple Information ℹ️</h3>
        <p>Get detailed information about the temple.</p>
      </div>
      <div class="card">
        <h3>Darshan Booking 🎟️</h3>
        <p>Book your darshan slots online.</p>
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section class="about" id="about">
    <div class="about-image">
      <img src="{{ asset('assets/templeImages/1/fetureimages/17379520938630.jpg') }}" alt="About Temple">
    </div>
    <div class="about-text">
      <h2>About Us 🌟</h2>
      <p>Welcome to our temple management system! We are dedicated to providing seamless services for devotees, including live darshan, temple information, and online booking. Our mission is to bring the divine experience closer to you. 🙏</p>
    </div>
  </section>

  <!-- Contact Us Section -->
  <section class="contact" id="contact">
    <h2>Contact Us 📞</h2>
    <form>
      <input type="text" placeholder="Your Name" required>
      <input type="email" placeholder="Your Email" required>
      <textarea placeholder="Your Message" rows="5" required></textarea>
      <button type="submit">Send Message 📨</button>
    </form>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-content">
      <p>© 2023 Temple Management. All rights reserved. 🛕</p>
      <ul class="social-links">
        <li><a href="#">Facebook</a></li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">Instagram</a></li>
      </ul>
    </div>
  </footer>

  <!-- Back to Top Button -->
  <div class="back-to-top" onclick="scrollToTop()">⬆️</div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    // Initialize Swiper for Header Slider
   // Text Slider Logic
const textSlides = document.querySelectorAll('.text-slide');
let currentSlide = 0;

function showNextSlide() {
  // Hide current slide
  textSlides[currentSlide].classList.remove('active');

  // Move to the next slide
  currentSlide = (currentSlide + 1) % textSlides.length;

  // Show the next slide
  textSlides[currentSlide].classList.add('active');
}

// Change slide every 20 seconds
setInterval(showNextSlide, 20000);

    // Initialize Swiper for Temple Slider
    new Swiper('.temple-slider .swiper', {
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      autoplay: {
        delay: 3000,
      },
    });

    // Back to Top Button
    const backToTopButton = document.querySelector('.back-to-top');
    window.addEventListener('scroll', () => {
      if (window.scrollY > 300) {
        backToTopButton.style.display = 'block';
      } else {
        backToTopButton.style.display = 'none';
      }
    });

    function scrollToTop() {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  </script>
</body>
</html>
