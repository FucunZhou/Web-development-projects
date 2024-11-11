<?php
session_start();

// Check if the user has agreed to the disclaimer
if (!isset($_SESSION['agreed']) || $_SESSION['agreed'] !== true) {
    header('Location: Disclaimer.php');
    exit;
}


include 'header.php';

// Function to determine the previous page
function getPreviousPage()
{
    if (isset($_SESSION['contact_method'])) {
        if ($_SESSION['contact_method'] == 'phone') {
            return 'ContactTime.php';
        }
    }
    return 'CustomerInfo.php';
}

$errors = [];

// Only process when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate principal
    if (!isset($_POST["principal"]) || empty($_POST["principal"])) {
        $errors[] = "Principal amount is required.";
    } elseif (!is_numeric($_POST["principal"]) || floatval($_POST["principal"]) <= 0) {
        $errors[] = "Principal amount must be a positive number.";
    }

    // Validate years
    if (!isset($_POST["years"]) || empty($_POST["years"])) {
        $errors[] = "Years to deposit is required.";
    } elseif (!ctype_digit($_POST["years"]) || intval($_POST["years"]) < 1 || intval($_POST["years"]) > 25) {
        $errors[] = "Years to deposit must be a whole number between 1 and 25.";
    }

    // If no errors, proceed with calculation
    if (empty($errors)) {
        $principal = floatval($_POST["principal"]);
        $years = intval($_POST["years"]);
        $rate = 0.03; // 3% annual interest rate
    }
}
?>

<h2 class="mb-4">Deposit Calculator</h2>

<?php
// Display validation errors if any
if (!empty($errors)) {
    echo '<div class="alert alert-danger" role="alert">';
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
}
?>

<form method="post" action="" novalidate>
    <div class="mb-3">
        <label for="principal" class="form-label">Principal Amount ($):</label>
        <input type="text" class="form-control" id="principal" name="principal" required
            value="<?php echo isset($_POST['principal']) ? htmlspecialchars($_POST['principal']) : ''; ?>">
    </div>

    <div class="mb-3">
        <label for="years" class="form-label">Years to Deposit:</label>
        <select class="form-select" id="years" name="years" required>
            <option value="" disabled <?php echo !isset($_POST['years']) ? 'selected' : ''; ?>>Select One</option>
            <?php
            for ($i = 1; $i <= 25; $i++) {
                $selected = (isset($_POST['years']) && $_POST['years'] == $i) ? 'selected' : '';
                echo "<option value='$i' $selected>$i " . ($i == 1 ? "year" : "years") . "</option>";
            }
            ?>
        </select>
    </div>

    <div class="mb-3">
        <button type="button" class="btn btn-secondary" onclick="window.location.href='<?php echo getPreviousPage(); ?>'">Previous</button>
        <button type="submit" class="btn btn-primary">Calculate</button>
        <button type="button" class="btn btn-success" onclick="window.location.href='Complete.php'">Complete</button>
    </div>
</form>

<?php
// Display calculation results if form was submitted and there are no errors
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors) && isset($principal) && isset($years)) {
    echo "<h3 class='mt-4'>Calculation Results</h3>";
    echo "<p>Following is the results of the calculation at the current interest rate of 3%.</p>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-bordered'>";
    echo "<thead class='table-dark'><tr><th>Year</th><th>Principal at Year Start</th><th>Interest for the Year</th><th>Principal at Year End</th></tr></thead>";
    echo "<tbody>";

    for ($year = 1; $year <= $years; $year++) {
        $interest = $principal * $rate;
        $endPrincipal = $principal + $interest;

        echo "<tr>";
        echo "<td>$year</td>";
        echo "<td>$" . number_format($principal, 2) . "</td>";
        echo "<td>$" . number_format($interest, 2) . "</td>";
        echo "<td>$" . number_format($endPrincipal, 2) . "</td>";
        echo "</tr>";

        $principal = $endPrincipal;
    }

    echo "</tbody></table></div>";
}
?>

<?php include 'footer.php'; ?>