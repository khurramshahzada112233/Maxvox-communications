<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require __DIR__ . '/../vendor/autoload.php';

$rootPath = dirname(__DIR__);
if (class_exists(Dotenv::class) && file_exists($rootPath . '/.env')) {
    Dotenv::createImmutable($rootPath)->safeLoad();
}

function env_value(string $key, ?string $default = null): ?string
{
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

    if ($value === false || $value === null || $value === '' || strtolower((string) $value) === 'null') {
        return $default;
    }

    return (string) $value;
}

function clean_input(string $value): string
{
    return trim(preg_replace('/\s+/', ' ', strip_tags($value)) ?? '');
}

function clean_array(array $values): array
{
    return array_values(array_filter(array_map(static fn ($value): string => clean_input((string) $value), $values)));
}

function fail_with_message(string $message): never
{
    http_response_code(422);
    echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Application Error</title><style>body{font-family:Montserrat,Arial,sans-serif;background:#f4f8f8;color:#1A202C;display:grid;place-items:center;min-height:100vh;margin:0;padding:24px}.card{max-width:620px;background:#fff;border:1px solid rgba(0,128,128,.22);border-top:5px solid #008080;padding:34px;box-shadow:0 24px 80px rgba(26,32,44,.14)}h1{font-family:Arial,sans-serif;margin:0 0 12px}p{line-height:1.7;color:#667085}a{display:inline-flex;margin-top:18px;color:#008080;font-weight:800;text-decoration:none;text-transform:uppercase;letter-spacing:1px}</style></head><body><main class="card"><h1>Application could not be submitted</h1><p>' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8') . '</p><a href="apply.html">Return to application</a></main></body></html>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.html', true, 303);
    exit;
}

$allowedPositions = [
    'CSR / Frontliner',
    'Self Verifier / Self Closer',
    'Verifier / Closer',
    'QA',
    'Management',
];
$allowedGenders = ['Male', 'Female', ''];
$allowedQualifications = [
    'Intermediate / A-Level',
    'Bachelors (BA, BSc, BS, BCom)',
    'Masters',
    'DAE',
    'Other',
];
$allowedEnglishSkills = ['1 - Basic', '2', '3', '4', '5 - Fluent / Excellent'];
$allowedExperience = ['No (Fresher)', 'Yes (Experienced)'];
$allowedCampaigns = [
    'Medicare',
    'Final Expense',
    'Affordable Care Act (ACA)',
    'Not Sure / Any Campaign',
];
$allowedShifts = [
    'Night Shift (International)',
    'Day Shift',
    'Any Shift / Flexible',
];
$allowedSources = [
    'Facebook Ad / Social Media',
    'WhatsApp Job Group',
    'Friend / Staff Reference',
    'Walk-in Banner / Poster',
    'Other',
    '',
];

$application = [
    'full_name' => clean_input((string) ($_POST['full_name'] ?? '')),
    'contact' => clean_input((string) ($_POST['contact'] ?? '')),
    'applying_position' => clean_input((string) ($_POST['applying_position'] ?? '')),
    'phone_number' => clean_input((string) ($_POST['phone_number'] ?? '')),
    'cnic' => clean_input((string) ($_POST['cnic'] ?? '')),
    'gender' => clean_input((string) ($_POST['gender'] ?? '')),
    'current_residential_area' => clean_input((string) ($_POST['current_residential_area'] ?? '')),
    'highest_qualification' => clean_input((string) ($_POST['highest_qualification'] ?? '')),
    'english_skill' => clean_input((string) ($_POST['english_skill'] ?? '')),
    'prior_experience' => clean_input((string) ($_POST['prior_experience'] ?? '')),
    'previous_company_campaign_duration' => clean_input((string) ($_POST['previous_company_campaign_duration'] ?? '')),
    'campaign_applying_for' => clean_array((array) ($_POST['campaign_applying_for'] ?? [])),
    'shift_preference' => clean_input((string) ($_POST['shift_preference'] ?? '')),
    'referral_source' => clean_input((string) ($_POST['referral_source'] ?? '')),
    'additional_notes' => clean_input((string) ($_POST['additional_notes'] ?? '')),
];

$errors = [];

$requiredLabels = [
    'full_name' => 'Full Name',
    'contact' => 'Contact',
    'applying_position' => 'Applying Position',
    'phone_number' => 'Phone Number',
    'cnic' => 'CNIC',
    'current_residential_area' => 'Current Residential Area',
    'highest_qualification' => 'Highest Educational Qualification',
    'english_skill' => 'English Speaking Skill',
    'prior_experience' => 'Prior Call Center Experience',
    'shift_preference' => 'Shift Preference',
];

foreach ($requiredLabels as $key => $label) {
    if ($application[$key] === '') {
        $errors[] = $label . ' is required.';
    }
}

if ($application['campaign_applying_for'] === []) {
    $errors[] = 'Campaign Applying For is required.';
}

if (!preg_match('/^[0-9+\-\s()]{7,20}$/', $application['contact'])) {
    $errors[] = 'A valid contact number is required.';
}

if (strtolower($application['phone_number']) !== 'same' && !preg_match('/^[0-9+\-\s()]{7,20}$/', $application['phone_number'])) {
    $errors[] = 'Phone Number must be valid or "Same".';
}

if (!preg_match('/^\d{5}-\d{7}-\d$/', $application['cnic'])) {
    $errors[] = 'CNIC must use the format 37405-1234567-1.';
}

if (!in_array($application['applying_position'], $allowedPositions, true)) {
    $errors[] = 'Please select a valid applying position.';
}

if (!in_array($application['gender'], $allowedGenders, true)) {
    $errors[] = 'Please select a valid gender.';
}

if (!in_array($application['highest_qualification'], $allowedQualifications, true)) {
    $errors[] = 'Please select a valid educational qualification.';
}

if (!in_array($application['english_skill'], $allowedEnglishSkills, true)) {
    $errors[] = 'Please select a valid English speaking skill.';
}

if (!in_array($application['prior_experience'], $allowedExperience, true)) {
    $errors[] = 'Please select prior call center experience.';
}

if ($application['prior_experience'] === 'Yes (Experienced)' && $application['previous_company_campaign_duration'] === '') {
    $errors[] = 'Previous Company, Campaign & Duration is required for experienced applicants.';
}

foreach ($application['campaign_applying_for'] as $campaign) {
    if (!in_array($campaign, $allowedCampaigns, true)) {
        $errors[] = 'Please select a valid campaign option.';
        break;
    }
}

if (!in_array($application['shift_preference'], $allowedShifts, true)) {
    $errors[] = 'Please select a valid shift preference.';
}

if (!in_array($application['referral_source'], $allowedSources, true)) {
    $errors[] = 'Please select a valid referral source.';
}

$storedFileName = 'No CV uploaded';
$storedPath = null;
$originalCvName = null;

if (isset($_FILES['cv']) && ($_FILES['cv']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
    $cv = $_FILES['cv'];
    $maxSize = 5 * 1024 * 1024;
    $allowedExtensions = ['pdf', 'doc', 'docx'];
    $allowedMimeTypes = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/octet-stream',
    ];

    if (($cv['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        $errors[] = 'The CV upload failed. Please try again.';
    } elseif (($cv['size'] ?? 0) > $maxSize) {
        $errors[] = 'The CV must be 5 MB or smaller.';
    } else {
        $extension = strtolower(pathinfo((string) $cv['name'], PATHINFO_EXTENSION));
        $detectedMime = is_uploaded_file($cv['tmp_name']) ? (mime_content_type($cv['tmp_name']) ?: '') : '';

        if (!in_array($extension, $allowedExtensions, true)) {
            $errors[] = 'Only PDF, DOC, and DOCX CV files are accepted.';
        } elseif ($detectedMime !== '' && !in_array($detectedMime, $allowedMimeTypes, true)) {
            $errors[] = 'The uploaded CV file type is not accepted.';
        } else {
            $uploadDir = __DIR__ . '/uploads/cv';
            if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
                $errors[] = 'Unable to prepare the CV upload directory.';
            } else {
                $safeName = preg_replace('/[^a-zA-Z0-9_-]+/', '-', strtolower($application['full_name'])) ?: 'candidate';
                $storedFileName = $safeName . '-' . date('Ymd-His') . '-' . bin2hex(random_bytes(4)) . '.' . $extension;
                $storedPath = $uploadDir . '/' . $storedFileName;
                $originalCvName = basename((string) $cv['name']);

                if (!is_uploaded_file($cv['tmp_name']) || !move_uploaded_file($cv['tmp_name'], $storedPath)) {
                    $errors[] = 'Unable to save the uploaded CV.';
                    $storedPath = null;
                }
            }
        }
    }
}

if ($errors) {
    fail_with_message(implode(' ', array_unique($errors)));
}

$submittedAt = date('F j, Y g:i A');
$displayFields = [
    'Full Name' => $application['full_name'],
    'Contact' => $application['contact'],
    'Applying Position' => $application['applying_position'],
    'Phone Number' => $application['phone_number'],
    'CNIC' => $application['cnic'],
    'Gender' => $application['gender'] !== '' ? $application['gender'] : 'Not provided',
    'Current Residential Area' => $application['current_residential_area'],
    'Highest Educational Qualification' => $application['highest_qualification'],
    'English Speaking Skill' => $application['english_skill'],
    'Prior Call Center Experience' => $application['prior_experience'],
    'Previous Company, Campaign & Duration' => $application['previous_company_campaign_duration'] !== '' ? $application['previous_company_campaign_duration'] : 'Not applicable',
    'Campaign Applying For' => implode(', ', $application['campaign_applying_for']),
    'Shift Preference' => $application['shift_preference'],
    'How did you hear about MaxVox?' => $application['referral_source'] !== '' ? $application['referral_source'] : 'Not provided',
    'Upload CV' => $storedFileName,
    'Additional Notes' => $application['additional_notes'] !== '' ? $application['additional_notes'] : 'Not provided',
];

$rows = '';
foreach ($displayFields as $label => $value) {
    $rows .= '<tr><th style="text-align:left;padding:13px 15px;background:#f4f8f8;border-bottom:1px solid #e4eeee;color:#1A202C;width:38%;font-size:13px;text-transform:uppercase;letter-spacing:.8px;">' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</th><td style="padding:13px 15px;border-bottom:1px solid #e4eeee;color:#243044;font-size:14px;line-height:1.55;">' . nl2br(htmlspecialchars($value, ENT_QUOTES, 'UTF-8')) . '</td></tr>';
}

$emailBody = '<!doctype html><html><body style="margin:0;background:#f4f8f8;font-family:Arial,sans-serif;color:#1A202C;">'
    . '<div style="max-width:780px;margin:0 auto;padding:28px;">'
    . '<div style="background:linear-gradient(135deg,#1A202C,#008080);padding:30px;border-top:5px solid #008080;color:#fff;">'
    . '<h1 style="margin:0;font-size:30px;letter-spacing:.5px;">New Job Application</h1>'
    . '<p style="margin:8px 0 0;color:rgba(255,255,255,.78);">MaxVox Communications recruitment portal</p>'
    . '</div>'
    . '<div style="background:#fff;border:1px solid #dce8e8;border-top:0;padding:24px;">'
    . '<h2 style="margin:0 0 6px;font-size:21px;color:#1A202C;">Applicant: ' . htmlspecialchars($application['full_name'], ENT_QUOTES, 'UTF-8') . '</h2>'
    . '<p style="margin:0 0 18px;color:#667085;">Submitted on ' . htmlspecialchars($submittedAt, ENT_QUOTES, 'UTF-8') . '</p>'
    . '<table role="presentation" cellspacing="0" cellpadding="0" style="width:100%;border-collapse:collapse;border:1px solid #e4eeee;border-bottom:0;">' . $rows . '</table>'
    . '<p style="margin:18px 0 0;color:#667085;">CV status: <strong>' . htmlspecialchars($storedFileName, ENT_QUOTES, 'UTF-8') . '</strong></p>'
    . '</div></div></body></html>';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = env_value('MAIL_HOST', '127.0.0.1');
    $mail->Port = (int) env_value('MAIL_PORT', '2525');
    $mail->SMTPAuth = env_value('MAIL_USERNAME') !== null || env_value('MAIL_PASSWORD') !== null;

    if ($mail->SMTPAuth) {
        $mail->Username = env_value('MAIL_USERNAME', '');
        $mail->Password = env_value('MAIL_PASSWORD', '');
    }

    $encryption = strtolower((string) env_value('MAIL_ENCRYPTION', (string) env_value('MAIL_SCHEME', '')));
    if (in_array($encryption, ['tls', 'ssl', 'smtps'], true)) {
        $mail->SMTPSecure = $encryption === 'ssl' || $encryption === 'smtps'
            ? PHPMailer::ENCRYPTION_SMTPS
            : PHPMailer::ENCRYPTION_STARTTLS;
    }

    $fromAddress = env_value('MAIL_FROM_ADDRESS', 'no-reply@maxvoxcommunications.com');
    $fromName = env_value('MAIL_FROM_NAME', 'MaxVox Communications');
    $mail->setFrom($fromAddress, $fromName);
    $mail->addAddress('hr@maxvoxcommunications.com');
    $mail->Subject = 'New Job Application - ' . $application['full_name'];
    $mail->isHTML(true);
    $mail->Body = $emailBody;
    $mail->AltBody = "New Job Application\n\n"
        . "Applicant: {$application['full_name']}\n"
        . "Contact: {$application['contact']}\n"
        . "Position: {$application['applying_position']}\n"
        . "Campaign: " . implode(', ', $application['campaign_applying_for']) . "\n"
        . "Shift: {$application['shift_preference']}\n"
        . "Submitted: {$submittedAt}";

    if ($storedPath !== null && is_file($storedPath)) {
        $mail->addAttachment($storedPath, $originalCvName ?? basename($storedPath));
    }

    $mail->send();
} catch (Exception $exception) {
    fail_with_message('The application was saved, but the email could not be sent. Please check SMTP settings. Mailer error: ' . $mail->ErrorInfo);
}

header('Location: application-success.html', true, 303);
exit;
