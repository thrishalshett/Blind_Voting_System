<?php

session_start();
require_once 'include/connection.php';

if (empty($_SESSION['isLogin'])) {

  echo "<script>alert('Kindly login to proceed');location.href='index.php'</script>";
}
require_once 'include/header.php';

?>

<main class="main">
  <!-- Breadcrumb Section -->
  <section id="breadcrumb" class="breadcrumb-section">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.html">Home</a></li>
          <li class="breadcrumb-item"><a href="#">About</a></li>
          <li class="breadcrumb-item active" aria-current="page">Blind Voting System</li>
        </ol>
      </nav>
    </div>
  </section>


  <!-- Details Section -->
  <section class="details section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>About Us</h2>
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