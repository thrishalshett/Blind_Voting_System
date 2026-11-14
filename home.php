<?php

session_start();
require_once 'include/connection.php';

if (empty($_SESSION['isLogin'])) {

    echo "<script>alert('Kindly login to proceed');location.href='index.php'</script>";
}
require_once 'include/header.php';

?>

  <main class="main">

   <!-- Hero Section -->
<section id="hero" class="hero section dark-background">
  <img src="assets/img/hero-bg-2.jpg" alt="" class="hero-bg">

  <div class="container">
    <div class="row gy-4 justify-content-between">
      <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
        <img src="assets/img/pexels-cottonbro-4669141.jpg" class="img-fluid animated" alt="">
      </div>

      <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-in">
        <h1>Voice-Based Voting System for Blind Persons</h1>
        <p>Empowering the visually impaired to participate in elections with ease and security through voice commands. Our system ensures inclusivity, security, and independence in the voting process.</p>
        <div class="d-flex">
          <a href="about.php" class="btn-get-started">Read More</a>
          <!-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center">
            <i class="bi bi-play-circle"></i><span>Watch Demo</span> -->
          </a>
        </div>
      </div>
    </div>
  </div>

  <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
    <defs>
      <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
    </defs>
    <g class="wave1">
      <use xlink:href="#wave-path" x="50" y="3"></use>
    </g>
    <g class="wave2">
      <use xlink:href="#wave-path" x="50" y="0"></use>
    </g>
    <g class="wave3">
      <use xlink:href="#wave-path" x="50" y="9"></use>
    </g>
  </svg>

</section>

<section id="about" class="about section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row align-items-xl-center gy-5">

      <div class="col-xl-5 content">
        <h3>About Us</h3>
        <h2>Voice-Based Voting System for Blind Persons</h2>
        <p>Our voice-based voting system is designed to ensure that visually impaired individuals can participate in elections independently and securely. By utilizing advanced speech recognition technology, the system allows blind voters to cast their votes using simple voice commands, making the process accessible, efficient, and private. This system is a step toward empowering all citizens, ensuring their voices are heard in the democratic process.</p>
      </div>

      <div class="col-xl-7">
        <div class="row gy-4 icon-boxes">

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <i class="bi bi-mic"></i>
              <h3>Voice-Powered Voting</h3>
              <p>Our system allows blind voters to cast their votes by simply speaking the option number, making the process seamless and accessible.</p>
            </div>
          </div> <!-- End Icon Box -->

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <i class="bi bi-shield-lock"></i>
              <h3>Secure Voting</h3>
              <p>Voice authentication ensures that only eligible voters can participate, protecting the integrity and confidentiality of the vote.</p>
            </div>
          </div> <!-- End Icon Box -->

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <i class="bi bi-headset"></i>
              <h3>Real-time Feedback</h3>
              <p>The system provides real-time audio feedback to guide the voter through the process, ensuring they are informed every step of the way.</p>
            </div>
          </div> <!-- End Icon Box -->

          <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <i class="bi bi-bar-chart-line"></i>
              <h3>Inclusive Elections</h3>
              <p>Our system makes elections more inclusive by providing a platform where blind individuals can independently make their voting decisions.</p>
            </div>
          </div> <!-- End Icon Box -->

        </div>
      </div>

    </div>
  </div>

</section><!-- /About Section -->


<!-- Details Section -->
<section class="details section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Details</h2>
    <div><span>Learn About Our</span> <span class="description-title">Voice-Based Voting System for Blind Persons</span></div>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4 align-items-center features-item">
      <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
        <img src="assets/img/details-1.png" class="img-fluid" alt="">
      </div>
      <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
        <h3>Empowering Blind Voters through Voice Commands</h3>
        <p class="fst-italic">
          Our voice-based voting system is designed to provide independence to blind individuals by allowing them to cast their votes using only their voice. The system is intuitive, simple to use, and ensures privacy.
        </p>
        <ul>
          <li><i class="bi bi-check"></i><span> Voice recognition ensures secure voting without the need for a physical interface.</span></li>
          <li><i class="bi bi-check"></i><span> Real-time audio feedback guides users through the voting process.</span></li>
          <li><i class="bi bi-check"></i><span> Accessible and easy-to-use interface for a seamless voting experience.</span></li>
        </ul>
      </div>
    </div><!-- Features Item -->

    <div class="row gy-4 align-items-center features-item">
      <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
        <img src="assets/img/details-2.png" class="img-fluid" alt="">
      </div>
      <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
        <h3>Voice-Powered Election Process</h3>
        <p class="fst-italic">
          The system allows voters to provide their Aadhar card number, which is verified for authentication. Once authenticated, the voter can hear a list of candidates and their parties, and simply choose the option they want by saying the corresponding number.
        </p>
        <p>
          With the integration of speech recognition technology, the entire election process becomes accessible. The system can recognize both simple commands and numeric inputs, making it easier for blind voters to make informed decisions independently.
        </p>
      </div>
    </div><!-- Features Item -->

    <div class="row gy-4 align-items-center features-item">
      <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
        <img src="assets/img/details-3.png" class="img-fluid" alt="">
      </div>
      <div class="col-md-7" data-aos="fade-up">
        <h3>Privacy and Security in Voting</h3>
        <p>
          The system ensures complete privacy during the voting process. Voters' choices are not recorded or shared, and their identity is verified using secure biometric data. The technology behind the voice commands ensures that only authorized users can cast their vote.
        </p>
        <ul>
          <li><i class="bi bi-check"></i><span> Secure voice authentication ensures only eligible voters can vote.</span></li>
          <li><i class="bi bi-check"></i><span> No physical interaction is required, making the process fully autonomous.</span></li>
          <li><i class="bi bi-check"></i><span> Real-time feedback ensures accuracy in the selection process.</span></li>
        </ul>
      </div>
    </div><!-- Features Item -->

    <div class="row gy-4 align-items-center features-item">
      <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out">
        <img src="assets/img/details-4.png" class="img-fluid" alt="">
      </div>
      <div class="col-md-7 order-2 order-md-1" data-aos="fade-up">
        <h3>Accessible Voting System for All</h3>
        <p class="fst-italic">
          Our voice-based voting system bridges the gap for blind voters, offering them a modern, efficient, and secure way to participate in the democratic process. It enables them to exercise their right to vote independently and without assistance.
        </p>
        <p>
          By removing traditional barriers, we make elections more inclusive for individuals with visual impairments, empowering them to make their voices heard in the electoral process.
        </p>
      </div>
    </div><!-- Features Item -->

  </div>

</section><!-- /Details Section -->


  </main>
  <?php
require_once 'include/footer.php';
?>
