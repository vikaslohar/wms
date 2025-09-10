<?php
// Function to generate financial years (current and past 5)
function getFinancialYears($count = 15) {
    $years = [];
    $currentYear = date('Y');
    $currentMonth = date('n');
    if ($currentMonth < 4) {
        $currentYear--;
    }

    for ($i = 0; $i < $count; $i++) {
        $start = $currentYear - $i;
        $end = $start + 1;
        $years[] = "$start-$end";
    }
    return $years;
}

// Ordered months in FY (April to March)
$months = [
    "April" => 4,
    "May" => 5,
    "June" => 6,
    "July" => 7,
    "August" => 8,
    "September" => 9,
    "October" => 10,
    "November" => 11,
    "December" => 12,
    "January" => 1,
    "February" => 2,
    "March" => 3,
];

$selectedYear = '';
$selectedMonth = '';
$startDate = '';
$endDate = '';
$monthList = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedYear = $_POST['financial_year'] ?? '';
    $selectedMonth = $_POST['month'] ?? '';

    if (!empty($selectedYear)) {
        [$startYear, $endYear] = explode('-', $selectedYear);

        if (!empty($selectedMonth) && isset($months[$selectedMonth])) {
            // Specific month selected
            $monthNum = $months[$selectedMonth];
            $year = ($monthNum >= 4) ? $startYear : $endYear;

            $startDate = date("Y-m-d", strtotime("$year-$monthNum-01"));
            $endDate = date("Y-m-t", strtotime($startDate));
        } else {
            // Month is ALL — build array of all months in FY
            foreach ($months as $monthName => $monthNum) {
                $year = ($monthNum >= 4) ? $startYear : $endYear;
                $start = date("Y-m-01", strtotime("$year-$monthNum-01"));
                $end = date("Y-m-t", strtotime($start));
                $monthList[] = [
                    'month' => $monthName,
                    'start_date' => $start,
                    'end_date' => $end
                ];
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Financial Year & Month Selector</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Select Financial Year and Month</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="financial_year" class="form-label">Financial Year <span class="text-danger">*</span></label>
            <select name="financial_year" id="financial_year" class="form-select" required>
                <option value="">-- Select Financial Year --</option>
                <?php foreach (getFinancialYears() as $year): ?>
                    <option value="<?= $year ?>" <?= ($year === $selectedYear) ? 'selected' : '' ?>>
                        <?= $year ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="month" class="form-label">Month (Optional)</label>
            <select name="month" id="month" class="form-select">
                <option value="">ALL</option>
                <?php foreach (array_keys($months) as $month): ?>
                    <option value="<?= $month ?>" <?= ($month === $selectedMonth) ? 'selected' : '' ?>>
                        <?= $month ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($selectedYear)): ?>
        <div class="alert alert-info mt-4">
            <p><strong>Financial Year:</strong> <?= htmlspecialchars($selectedYear) ?></p>
            <p><strong>Month:</strong> <?= $selectedMonth ? htmlspecialchars($selectedMonth) : 'ALL' ?></p>

            <?php if ($selectedMonth && $startDate && $endDate): ?>
                <p><strong>Start Date:</strong> <?= $startDate ?></p>
                <p><strong>End Date:</strong> <?= $endDate ?></p>

            <?php elseif (!$selectedMonth && count($monthList)): ?>
                <h5 class="mt-4">All Months in Financial Year <?= htmlspecialchars($selectedYear) ?>:</h5>
                <ul class="list-group">
                    <?php foreach ($monthList as $item): ?>
                        <li class="list-group-item">
                            <strong><?= $item['month'] ?>:</strong>
                            <?= $item['start_date'] ?> to <?= $item['end_date'] ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
