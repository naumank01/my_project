<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($user['username']) ?> - Stack Overflow Clone</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <div class="profile-container">
        <!-- Sidebar Navigation -->
        <div class="profile-sidebar">
            <div class="profile-card">
 <ul class="nav-menu">
    <li><a href="profile_summary.php">Summary</a></li>
    <li><a href="profile_answers.php">Answers</a></li>
    <li><a href="profile_questions.php">Questions</a></li>
    <li><a href="profile_tags.php">Tags</a></li>
    <li><a href="profile_articles.php">Articles</a></li>
    <li><a href="profile_badges.php">Badges</a></li>
    <li><a href="profile_following.php">Following</a></li>
    <li><a href="profile_bounties.php">Bounties</a></li>
    <li><a href="profile_reputation.php">Reputation</a></li>
    <li><a href="profile_actions.php">All actions</a></li>
    <li><a href="profile_responses.php">Responses</a></li>
    <li><a href="profile_votes.php">Votes</a></li>
</ul>
            </div>
            
            <div class="profile-card">
                <h3>Accounts</h3>
                <ul class="nav-menu">
                    <li><strong>Stack Overflow</strong></li>
                </ul>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="profile-main">
            <div class="profile-header">
                <div class="username-container">
                    <h1><?= htmlspecialchars($user['username']) ?></h1>
                    <div class="header-actions">
                        <a href="logout.php" class="logout-btn">
                            <span class="logout-icon">⎋</span> Log out
                        </a>
                    </div>
                </div>
                <div class="profile-meta">
                    Member for <?= $memberFor ?><br>
                    Last seen <?= $lastSeen ?><br>
                    Visited <?= $visitedDays ?>
                </div>
            </div>
            
            <!-- ... rest of your sections ... -->
        </div>
    </div>
</body>
</html>