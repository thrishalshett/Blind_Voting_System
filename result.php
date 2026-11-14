<?php

session_start();
require_once 'include/connection.php';

if (empty($_SESSION['isLogin'])) {
    echo "<script>alert('Kindly login to proceed');location.href='index.php'</script>";
}

require_once 'include/header.php';

?>
<style>
    /* Styling for Candidate Cards */
    .candidate-card {
        background: #ffffff;
        border: 1px solid #ddd;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .candidate-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .candidate-name {
        font-size: 1.6rem;
        font-weight: bold;
        color: #333;
    }

    .party-name {
        font-size: 1.2rem;
        font-weight: normal;
        color: #666;
    }

    .votes {
        font-size: 1.4rem;
        color: #4CAF50;
    }

    .vote-count {
        font-weight: bold;
    }

    .candidate-img {
        border: 5px solid #007bff;
        border-radius: 50%;
    }

    .btn {
        background-color: #007bff;
        color: #fff;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>
<main class="main">
    <!-- Breadcrumb Section -->
    <section id="breadcrumb" class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Voting Result</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Details Section -->
    <section class="details section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>View Voting Results</h2>
            <div><span>Explore the Results of Our</span> <span class="description-title">Inclusive Voice-Based Voting System</span></div>
        </div>


        <div class="container">
            <div class="row">
                <?php
                $qry = "SELECT * FROM candidate_details";
                $res = mysqli_query($conn, $qry);

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {

                        // Get the total votes for each candidate
                        $qry2 = "SELECT COUNT(*) AS total_votes FROM candidate_result WHERE candidate_name = '" . $row['candidate_name'] . "'";
                        $res2 = mysqli_query($conn, $qry2);

                        if (mysqli_num_rows($res2) > 0) {
                            $row2 = mysqli_fetch_assoc($res2);
                            $votes = $row2['total_votes'];
                        }
                ?>
                        <!-- Start Candidate Card -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="candidate-card shadow-lg rounded p-4">
                                <!-- Party Symbol -->
                                <div class="candidate-img" style="background-image: url('<?php echo $row['party_symbol']; ?>'); background-size: cover; background-position: center; width: 120px; height: 120px; border-radius: 50%; margin: 0 auto;"></div>

                                <!-- Candidate Info -->
                                <div class="candidate-info text-center mt-3">
                                    <h3 class="candidate-name"><?php echo $row['candidate_name']; ?></h3>
                                    <h6 class="party-name"><?php echo $row['party_name']; ?></h6>

                                    <div class="votes mt-3">
                                        <p>Total votes: <span class="vote-count"><?php echo $votes; ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Candidate Card -->

                <?php
                    }
                }
                ?>
            </div>
        </div>

    </section><!-- /Details Section -->
</main>

<?php
require_once 'include/footer.php';
?>