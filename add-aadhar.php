<?php
session_start();
require_once 'include/connection.php';

if (empty($_SESSION['isLogin'])) {
    echo "<script>alert('Kindly login to proceed');location.href='index.php'</script>";
}
require_once 'include/header.php';

if (isset($_POST['add_submit'])) {
    $name = addslashes(trim($_POST['name']));
    $adharno = addslashes(trim($_POST['adharno']));
    $dob = addslashes(trim($_POST['dob']));
    $checkQuery = "SELECT * FROM adhaar WHERE aadhar_number = '$adharno'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Aadhar number already exists!');location.href='add-aadhar.php'</script>";
    } else {
        $insertQuery = "INSERT INTO adhaar (name, aadhar_number, dob) VALUES ('$name', '$adharno', '$dob')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>alert('Aadhar added successfully');location.href='add-aadhar.php'</script>";
        } else {
            echo "<script>alert('Unable to process your request!');location.href='add-aadhar.php'</script>";
        }
    }
}


if (isset($_POST['edit_submit'])) {
    $edit_id = $_POST['edit_id'];
    $edit_name = addslashes(trim($_POST['edit_name']));
    $edit_adharno = addslashes(trim($_POST['edit_adharno']));
    $edit_dob = addslashes(trim($_POST['edit_dob']));

    $checkQuery = "SELECT * FROM adhaar WHERE aadhar_number = '$edit_adharno' AND id != '$edit_id'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Aadhar number already exists for another record!');location.href='add-aadhar.php'</script>";
    } else {
        $updateQuery = "UPDATE adhaar SET name='$edit_name', aadhar_number='$edit_adharno', dob='$edit_dob' WHERE id='$edit_id'";

        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('Aadhar updated successfully');location.href='add-aadhar.php'</script>";
        } else {
            echo "<script>alert('Unable to update the Aadhar details');location.href='add-aadhar.php'</script>";
        }
    }
}


if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM adhaar WHERE id = '$delete_id'";

    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Aadhar deleted successfully');location.href='add-aadhar.php'</script>";
    } else {
        echo "<script>alert('Unable to delete the Aadhar');location.href='add-aadhar.php'</script>";
    }
}
?>

<main class="main">
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

    <section class="details section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Add Aadhar</h2>
            <div>
                <span class="description-title">Entering Aadhar Details of Blind Persons</span>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <h3>Aadhar Details</h3>
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">Add Aadhar</button>
                </div>
            </div><br><br>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Aadhar Number</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM adhaar");
                    if (mysqli_num_rows($res) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<tr>";
                            echo "<td>$i</td>";
                            echo "<td>$row[name]</td>";
                            echo "<td>$row[aadhar_number]</td>";
                            echo "<td>" . date("F j, Y", strtotime($row['dob'])) . "</td>";
                            echo "<td>
                                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editModal" . $row['id'] . "'>
                                    <i class='bi bi-pencil-square'></i>
                                </button>
                                <a href='add-aadhar.php?delete_id=$row[id]' class='btn btn-danger' onclick='return confirmDelete(\"Are you sure you want to delete this Aadhar?\");'>
                                    <i class='bi bi-trash'></i>
                                </a>
                            </td>";
                            echo "</tr>";
                            echo "
                            <div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <form method='post'>
                                        <input type='hidden' name='edit_id' value='" . $row['id'] . "'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='editModalLabel'>Edit Aadhar Details</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <div class='row'>
                                                    <div class='col-xl-12 mb-3'>
                                                        <label class='form-label'>Enter Aadhar Name <span class='text-danger'>*</span></label>
                                                        <input autocomplete='off' type='text' class='form-control' maxlength='100' required name='edit_name' 
                                                            value='" . $row['name'] . "' pattern='[A-Za-z\s]+' 
                                                            title='Only alphabets and spaces are allowed' 
                                                            onkeypress='return /^[A-Za-z\s]*$/.test(event.key)'>
                                                    </div>

                                                    <div class='col-xl-12 mb-3'>
                                                        <label class='form-label'>Enter Aadhar Number <span class='text-danger'>*</span></label>
                                                        <input autocomplete='off' type='text' class='form-control' pattern='[0-9]{12}' required name='edit_adharno' 
                                                            value='" . $row['aadhar_number'] . "' title='Please enter exactly 12 digits' maxlength='12' 
                                                            oninput='this.value=this.value.replace(/[^0-9]/g, \"\").slice(0,12)'>
                                                    </div>

                                                    <div class='col-xl-12 mb-3'>
                                                        <label class='form-label'>DOB <span class='text-danger'>*</span></label>
                                                        <input autocomplete='off' type='date' class='form-control' required name='edit_dob' id='edit_dob' 
                                                            value='" . $row['dob'] . "'>
                                                            <small id='dobError' class='text-danger'></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                <button type='submit' name='edit_submit' class='btn btn-primary'>Save changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            ";
                            $i++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Enter Aadhar Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">Enter Aadhar Name <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" class="form-control" maxlength="100" required name="name"
                                        pattern="[A-Za-z\s]+" title="Only alphabets and spaces are allowed" onkeypress="return /^[A-Za-z\s]*$/.test(event.key)">
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">Enter Aadhar Number <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="text" class="form-control" pattern="[0-9]{12}" required name="adharno"
                                        title="Please enter exactly 12 digits" maxlength="12"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)">
                                </div>

                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">Date Of Birth <span class="text-danger">*</span></label>
                                    <input autocomplete="off" type="date" class="form-control" required name="dob" id="dob">
                                    <small id="dobError" class="text-danger"></small>
                                </div>

                                <script>
                                    document.getElementById('dob').addEventListener('change', function() {
                                        const dobInput = new Date(this.value);
                                        const today = new Date();

                                        // Calculate age
                                        let age = today.getFullYear() - dobInput.getFullYear();
                                        const monthDiff = today.getMonth() - dobInput.getMonth();

                                        // Adjust age if the birthday hasn't occurred yet this year
                                        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobInput.getDate())) {
                                            age--;
                                        }

                                        const errorMsg = document.getElementById('dobError');
                                        if (age < 18) {
                                            errorMsg.textContent = "You must be at least 18 years old.";
                                            this.value = ''; // Clear the input if invalid
                                        } else {
                                            errorMsg.textContent = '';
                                        }
                                    });
                                </script>


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
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // window.onload = function() {
    //     const dobInput = document.getElementById('dob');
    //     const today = new Date();
    //     const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
    //     const formattedDate = maxDate.toISOString().split('T')[0];
    //     dobInput.max = formattedDate;
    //     dobInput.value = formattedDate;
    // }

    // window.onload = function() {
    //     const dobInput = document.getElementById('edit_dob');
    //     const today = new Date();
    //     const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
    //     const formattedDate = maxDate.toISOString().split('T')[0];

    //     dobInput.max = formattedDate;
    // }
    window.onload = function() {
    // For add form
    const dobInput = document.getElementById('dob');
    const today = new Date();
    const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
    const formattedDate = maxDate.toISOString().split('T')[0];
   
    if(dobInput) {
        dobInput.max = formattedDate;
        dobInput.min = '1900-01-01'; // Optional: Set a reasonable minimum date
    }

    // For edit form
    const editDobInput = document.getElementById('edit_dob');
    if(editDobInput) {
        editDobInput.max = formattedDate;
        editDobInput.min = '1900-01-01'; // Optional: Set a reasonable minimum date
    }
}
</script>
<script>
   document.getElementById('dob').addEventListener('change', function() {
    const dobInput = new Date(this.value);
    const today = new Date();
    const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
   
    const errorMsg = document.getElementById('dobError');
    if (dobInput > maxDate) {
        errorMsg.textContent = "You must be at least 18 years old.";
        this.value = maxDate.toISOString().split('T')[0]; // Set to maximum allowed date
    } else {
        errorMsg.textContent = '';
    }
});

document.getElementById('edit_dob').addEventListener('change', function() {
    const dobInput = new Date(this.value);
    const today = new Date();
    const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
   
    const errorMsg = document.getElementById('dobError');
    if (dobInput > maxDate) {
        errorMsg.textContent = "You must be at least 18 years old.";
        this.value = maxDate.toISOString().split('T')[0]; // Set to maximum allowed date
    } else {
        errorMsg.textContent = '';
    }
});
</script>
<?php
require_once 'include/footer.php';
?>
