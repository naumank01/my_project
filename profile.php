 <?php
session_start();
include_once('connect.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

try {
    // Get user data
    $stmt = $pdo->prepare("SELECT username, email, created_at FROM users WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        die("User not found!");
    }

    // Calculate member duration
    $createdAt = new DateTime($user['created_at']);
    $now = new DateTime();
    $memberFor = $now->diff($createdAt)->format('%a days');
    
    // Last seen (approximate)
    $lastSeen = "this week";
    $visitedDays = "2 days, 1 consecutive";

    // Include PHP template (NOT HTML)
    include 'profile_template.php';

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>