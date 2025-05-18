<?php
session_start();
require_once 'database.php';
$username = $_SESSION['username'] ?? '';
$gender = $_SESSION['gender'] ?? '';
$location = $_SESSION['location'] ?? '';
$healthType = $_SESSION['health_type'] ?? '';
$isFemale = ($gender === 'female');

// Questions for both types
$questions = [
    'physical' => [
        'How severe are your current symptoms? (1 = mild, 5 = severe)' => 'symptom_severity',
        'How often do you eat junk food? (1 = never, 5 = daily)' => 'junk_food',
        'Do you have any previous health reports? (1 = none, 5 = many)' => 'health_reports',
        'Do you feel tired or fatigued? (1 = never, 5 = always)' => 'fatigue',
    ],
    'mental' => [
        'How often do you feel stressed? (1 = never, 5 = always)' => 'stress',
        'How well do you sleep? (1 = very well, 5 = very poor)' => 'sleep',
        'Do you feel anxious or low? (1 = never, 5 = always)' => 'anxiety',
        'How is your appetite? (1 = excellent, 5 = very poor)' => 'appetite',
    ]
];
// If female and physical, add menstrual questions
if ($isFemale && $healthType === 'physical') {
    $questions['physical']['Are your periods regular? (1 = yes, 5 = no)'] = 'periods_regular_scale';
    $questions['physical']['Do you have menstrual pain? (1 = none, 5 = severe)'] = 'menstrual_pain_scale';
}

// If answers are submitted, process and show suggestions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitted'])) {
    $scores = array_map('intval', $_POST);
    unset($scores['submitted']);
    // Calculate severity
    $avg = array_sum($scores) / count($scores);
    if ($avg <= 2) $severity = 'Mild';
    elseif ($avg <= 3.5) $severity = 'Moderate';
    else $severity = 'Severe';

    // Suggestions (demo)
    $medicines = [
        'Mild' => ['Paracetamol 500mg (if fever)', 'ORS (if dehydration)', 'Rest'],
        'Moderate' => ['Consult doctor soon', 'Continue basic medicines', 'Increase hydration'],
        'Severe' => ['Immediate doctor consult', 'Avoid self-medication', 'Emergency care if needed']
    ];
    $food = [
        'Mild' => ['Fruits, vegetables', 'Plenty of water', 'Avoid junk food'],
        'Moderate' => ['Light meals', 'Soups', 'Cut down on sugar/oil'],
        'Severe' => ['Easily digestible food', 'Frequent small meals', 'No outside food']
    ];
    // Mental health suggestions
    $mental_suggestions = [
        'Mild' => [
            'Practice mindfulness or meditation daily.',
            'Engage in regular physical activity.',
            'Maintain a consistent sleep schedule.',
            'Connect with friends and family.'
        ],
        'Moderate' => [
            'Consider speaking with a counselor or therapist.',
            'Try journaling your thoughts and feelings.',
            'Limit screen time and news consumption.',
            'Engage in creative hobbies.'
        ],
        'Severe' => [
            'Seek professional mental health support immediately.',
            'Reach out to a trusted person for help.',
            'Avoid isolation—connect with support groups.',
            'Remember that you are not alone and help is available.'
        ]
    ];
    // Doctor selection
    $doctorList = $doctors[$location][$healthType];
    // If female & gynic, filter only gynic doctors
    if ($isFemale && $healthType === 'physical') {
        $doctorList = array_filter($doctorList, function($doc) {
            return stripos($doc['experience'], 'gynic') !== false;
        });
    }
    echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Suggestions - Track-Well</title>';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">';
    echo '<link rel="stylesheet" href="assets/css/styles.css"></head><body>';
    echo '<div class="container py-5">';
    echo '<div class="card p-4 shadow-sm mx-auto" style="max-width:600px;">';
    echo '<h2 class="mb-3 text-center">Your Results, '.htmlspecialchars($username).'!</h2>';
    echo '<div class="mb-2"><strong>Severity:</strong> <span class="badge bg-'.($severity=='Mild'?'success':($severity=='Moderate'?'warning text-dark':'danger')).'">'.$severity.'</span></div>';
    echo '<div class="mb-3"><strong>Suggested Medicines:</strong><ul>';
    foreach ($medicines[$severity] as $med) echo '<li>'.$med.'</li>';
    echo '</ul></div>';
    echo '<div class="mb-3"><strong>Food Plan:</strong><ul>';
    foreach ($food[$severity] as $f) echo '<li>'.$f.'</li>';
    echo '</ul></div>';
    // Display mental health suggestions if selected
    if ($healthType === 'mental') {
        echo '<div class="mb-3"><strong>Mental Health Suggestions for Overcoming Challenges:</strong><ul>';
        foreach ($mental_suggestions[$severity] as $suggestion) {
            echo '<li>' . htmlspecialchars($suggestion) . '</li>';
        }
        echo '</ul></div>';
    }
    echo '<div class="mb-3"><strong>Doctors in '.ucfirst($location).':</strong>';
    if (empty($doctorList)) {
        echo '<div class="text-danger">No suitable doctors found for your selection.</div>';
    } else {
        echo '<ul>';
        foreach ($doctorList as $doc) {
            echo '<li><b>'.$doc['name'].'</b> - '.$doc['doctor'].' ('.$doc['experience'].')<br>';
            echo '<a href="tel:'.$doc['phone'].'" class="btn btn-sm btn-outline-success my-1">Call</a> ';
            echo '<a href="'.$doc['maps'].'" target="_blank" class="btn btn-sm btn-outline-primary my-1">View on Map</a></li>';
        }
        echo '</ul>';
    }
    echo '</div>';
    echo '<a href="index.php" class="btn btn-link w-100">Back to Home</a>';
    echo '</div></div>';
    echo '<script src="assets/js/main.js"></script></body></html>';
    exit();
}
// Show questionnaire form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Questionnaire - Track-Well</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container d-flex flex-column align-items-center justify-content-center min-vh-100">
        <div class="card p-4 shadow-sm" style="min-width: 320px; max-width: 600px;">
            <h2 class="mb-3 text-center"><?php echo ucfirst($healthType); ?> Health Questionnaire</h2>
            <form method="post">
                <?php
                foreach ($questions[$healthType] as $q => $name) {
                    echo '<div class="mb-3">';
                    echo '<label class="form-label">'.$q.'</label>';
                    echo '<input type="range" class="form-range" min="1" max="5" step="1" name="'.$name.'" value="3" oninput="this.nextElementSibling.value = this.value">';
                    echo '<output style="margin-left:10px;">3</output>';
                    echo '</div>';
                }
                ?>
                <input type="hidden" name="submitted" value="1">
                <button type="submit" class="btn btn-custom w-100">Get Suggestions</button>
            </form>
            <a href="questionnaire.php" class="btn btn-link w-100">Back</a>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>
