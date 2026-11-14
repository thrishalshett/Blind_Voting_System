<?php
session_start();
require_once 'include/connection.php';

if (empty($_SESSION['isLogin'])) {
    echo "<script>alert('Kindly login to proceed');location.href='index.php'</script>";
}
require_once 'include/header.php';
$uploadFolder = 'party-symbols';

if (!file_exists($uploadFolder)) {
    mkdir($uploadFolder, 0777, true);
}

if (isset($_POST['add_submit'])) {

    $pname = addslashes(trim($_POST['pname']));
    $cname = addslashes(trim($_POST['cname']));
    $state = addslashes(trim($_POST['state']));
    $district = addslashes(trim($_POST['district']));
    $symbol = $_FILES['symbol']['name'];

    if ($symbol) {
        $targetFile = $uploadFolder . '/' . basename($symbol);
        if (move_uploaded_file($_FILES['symbol']['tmp_name'], $targetFile)) {
        } else {
            echo "<script>alert('Failed to upload the symbol image.');</script>";
        }
    }

    $insertQuery = "INSERT INTO candidate_details (party_name, candidate_name, state, party_symbol, district) VALUES 
    ('$pname', '$cname', '$state', '$targetFile', '$district')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "<script>alert('Candidate added successfully');location.href='add-candidate.php'</script>";
    } else {
        echo "<script>alert('Unable to process your request!');location.href='add-candidate.php'</script>";
    }
}

if (isset($_POST['edit_submit'])) {
    $id = $_POST['id'];
    $pname = addslashes(trim($_POST['pname']));
    $cname = addslashes(trim($_POST['cname']));
    $state = addslashes(trim($_POST['state']));
    $district = addslashes(trim($_POST['district']));
    $symbol = $_FILES['symbol']['name'];

    $updateQuery = "UPDATE candidate_details SET party_name='$pname', candidate_name='$cname', state='$state', district='$district'";

    if ($symbol) {
        $targetFile = $uploadFolder . '/' . basename($symbol);
        if (move_uploaded_file($_FILES['symbol']['tmp_name'], $targetFile)) {
            $updateQuery .= ", party_symbol='$targetFile'";
        }
    }

    $updateQuery .= " WHERE id='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Candidate updated successfully');location.href='add-candidate.php'</script>";
    } else {
        echo "<script>alert('Unable to update candidate!');location.href='add-candidate.php'</script>";
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $query = "SELECT party_symbol FROM candidate_details WHERE id = '$delete_id'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $symbolPath = $row['party_symbol'];

        if (file_exists($symbolPath)) {
            unlink($symbolPath);
        }
    }
    $deleteQuery = "DELETE FROM candidate_details WHERE id = '$delete_id'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Candidate deleted successfully');location.href='add-candidate.php'</script>";
    } else {
        echo "<script>alert('Unable to delete candidate!');location.href='add-candidate.php'</script>";
    }
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<main class="main">

    <section id="breadcrumb" class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
    </section>

    <section class="details section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Add Candidate</h2>
            <div>
                <span class="description-title">Entering Candidate Details</span>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h3>Candidate Details</h3>
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Add Candidate</button>

                </div>
            </div><br><br>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Party name</th>
                        <th scope="col">Candidate name</th>
                        <th scope="col">State</th>
                        <th scope="col">District</th>
                        <th scope="col">Party symbol</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM candidate_details");
                    if (mysqli_num_rows($res) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td>$i</td>";
                            echo "<td>$row[party_name]</td>";
                            echo "<td>$row[candidate_name]</td>";
                            echo "<td>$row[state]</td>";
                            echo "<td>$row[district]</td>";
                            echo "<td><img src='$row[party_symbol]' alt='Symbol' width='50' height='50'></td>";
                            echo "<td>
                              <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#edit" . $row['id'] . "'>
                                  <i class='bi bi-pencil-square'></i>
                              </button>
                            <a href='add-candidate.php?delete_id=$row[id]' class='btn btn-danger' onclick='return confirmDelete();'>
                                <i class='bi bi-trash'></i>
                            </a>
                        </td>";

                            echo "</tr>";
                            $i++;
                    ?>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="edit<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Candidate Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-label">Party Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" maxlength="100" required name="pname"
                                                            pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed"
                                                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)"
                                                            value="<?php echo $row['party_name']; ?>">
                                                    </div>

                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-label">Candidate Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" maxlength="100" required name="cname"
                                                            pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed"
                                                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)"
                                                            value="<?php echo $row['candidate_name']; ?>">
                                                    </div>

                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-label">State <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" maxlength="100" required name="state"
                                                            pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed"
                                                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)"
                                                            value="<?php echo $row['state']; ?>">
                                                    </div>

                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-label">District <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" maxlength="100" required name="district"
                                                            pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed"
                                                            onkeypress="return /^[A-Za-z\s]*$/.test(event.key)"
                                                            value="<?php echo $row['district']; ?>">
                                                    </div>

                                                    <div class="col-xl-12 mb-3">
                                                        <label class="form-label">Party Symbol</label>
                                                        <input type="file" class="form-control" name="edit_symbol">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="edit_submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Candidate Modal -->
        <!-- Modal Structure -->

        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Enter Candidate Details</h5>
                            <!-- Close Button -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">Party Name <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" class="form-control" maxlength="100" required name="pname"
                                        pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed"
                                        onkeypress="return /^[A-Za-z\s]*$/.test(event.key)">
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">Candidate Name <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" class="form-control" maxlength="100" required name="cname"
                                        pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed"
                                        onkeypress="return /^[A-Za-z\s]*$/.test(event.key)">
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">State <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" class="form-control" maxlength="100" required name="state"
                                        pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed"
                                        onkeypress="return /^[A-Za-z\s]*$/.test(event.key)">
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">District <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" class="form-control" maxlength="100" required name="district"
                                        pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed"
                                        onkeypress="return /^[A-Za-z\s]*$/.test(event.key)">
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">Party Symbol<span class="text-danger">*</span></label>
                                    <input autocomplete='off' type="file" class="form-control" required name="symbol">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="add_submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bootstrap and Custom CSS -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



    </section><!-- /Details Section -->
</main>

<!-- Include Bootstrap JS at the end of the body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php
require_once 'include/footer.php';
?>
