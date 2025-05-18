<?php
session_start();
// Use the session username if available, otherwise fallback to GitHub login or generic "User"
$username = isset($_SESSION['username']) ? $_SESSION['username'] : (isset($_SESSION['login']) ? $_SESSION['login'] : 'User');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($username) ?> - Profile Summary</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profile.css">
    <style>
        body {
            background: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .profile-header-main {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 16px;
        }
        .profile-avatar {
            width: 160px;
            height: 160px;
            border-radius: 12px;
            background: #f0f5f8;
            object-fit: cover;
            border: none;
        }
        .header-details {
            flex: 1;
        }
        .header-details h1 {
            font-size: 3rem;
            font-weight: 500;
            margin: 0;
        }
        .profile-meta {
            color: #606770;
            font-size: 1.1rem;
            display: flex;
            gap: 24px;
            align-items: center;
            margin-top: 8px;
        }
        .profile-actions {
            margin-left: auto;
            display: flex;
            gap: 12px;
        }
        .profile-actions button,
        .profile-actions a {
            padding: 8px 18px;
            font-size: 1rem;
            border-radius: 7px;
            border: 1px solid #cfd8dc;
            background: #fff;
            cursor: pointer;
            transition: background 0.2s;
        }
        .profile-actions a {
            text-decoration: none;
            color: #222;
        }
        .profile-actions button:hover,
        .profile-actions a:hover {
            background: #f0f5f8;
        }
        .profile-container-main {
            display: flex;
            background: #fff;
            min-height: 100vh;
        }
        .profile-sidebar-main {
            width: 250px;
            background: #fff;
            border-right: 1px solid #e4e6e8;
            padding: 24px 0 16px 0;
            display: flex;
            flex-direction: column;
        }
        .nav-menu-main {
            list-style: none;
            padding: 0;
            margin: 0;
            margin-bottom: 18px;
        }
        .nav-menu-main li {
            margin: 4px 0;
        }
        .nav-menu-main a {
            display: block;
            padding: 10px 24px;
            color: #222;
            text-decoration: none;
            border-radius: 22px;
            font-size: 1.1rem;
            transition: background 0.12s, color 0.12s;
        }
        .nav-menu-main a.active,
        .nav-menu-main a:focus,
        .nav-menu-main a:hover {
            background: #f2f4f8;
            color: #f48024;
        }
        .nav-menu-main li.selected a {
            background: #f48024;
            color: #fff;
            font-weight: 500;
        }
        .profile-content-main {
            flex: 1;
            padding: 36px 42px 0 42px;
        }
        .profile-tabs {
            display: flex;
            gap: 8px;
            margin-bottom: 12px;
        }
        .profile-tabs a {
            padding: 8px 24px;
            font-size: 1.1rem;
            border-radius: 22px;
            text-decoration: none;
            color: #222;
            background: none;
            border: none;
            transition: background 0.12s, color 0.12s;
        }
        .profile-tabs a.selected,
        .profile-tabs a:focus,
        .profile-tabs a:hover {
            background: #f48024;
            color: #fff;
        }
        .profile-section-title {
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 24px;
        }
        .summary-cards {
            display: flex;
            gap: 32px;
            margin-top: 16px;
            flex-wrap: wrap;
        }
        .summary-card {
            flex: 1 1 280px;
            background: #fff;
            border: 1px solid #e2e6ea;
            border-radius: 12px;
            padding: 36px 28px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-width: 280px;
            box-sizing: border-box;
            min-height: 250px;
        }
        .summary-card img,
        .summary-card .summary-icon {
            width: 56px;
            height: 56px;
            margin-bottom: 16px;
            color: #bbc4ca;
            font-size: 56px;
        }
        .summary-card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 8px;
            text-align: center;
        }
        .summary-card-desc {
            color: #5f6c7b;
            font-size: 1.05rem;
            text-align: center;
            margin-bottom: 8px;
        }
        .summary-card-link {
            margin-top: 6px;
            color: #0074cc;
            text-decoration: underline;
            cursor: pointer;
        }
        .summary-card .primary-btn {
            margin-top: 18px;
            background: #1558d6;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px 30px;
            font-size: 1.12rem;
            cursor: pointer;
            font-weight: 500;
        }
        .back-btn {
            margin-bottom: 22px;
            margin-left: -2px;
            margin-top: 10px;
            display: inline-flex;
            align-items: center;
            background: #f0f5f8;
            color: #222;
            border: 1px solid #d7dbe0;
            border-radius: 7px;
            padding: 7px 18px;
            font-size: 1.03rem;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.18s;
        }
        .back-btn:hover {
            background: #e9ecef;
        }
        .back-btn svg {
            margin-right: 7px;
        }
        @media (max-width: 1000px) {
            .profile-content-main {
                padding: 24px 6vw 0 6vw;
            }
            .summary-cards {
                flex-direction: column;
                gap: 22px;
            }
            .summary-card {
                min-width: unset;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container-main">
        <!-- Sidebar -->
        <nav class="profile-sidebar-main">
            <ul class="nav-menu-main">
                <li><a href="profile_summary.php" class="active">Summary</a></li>
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
        </nav>

        <!-- Main Content -->
        <main class="profile-content-main">
            <!-- Back Button -->
            <a href="profile_template.php" class="back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#666" viewBox="0 0 24 24"><path d="M15.7 5.3a1 1 0 0 0-1.4 0l-6 6a1 1 0 0 0 0 1.4l6 6a1 1 0 1 0 1.4-1.4L10.42 12l5.3-5.3a1 1 0 0 0 0-1.4z"/></svg>
                Back to Profile
            </a>
            <!-- Header -->
            <div class="profile-header-main">
                <img src="https://i.imgur.com/4M34hi2.png" alt="Avatar" class="profile-avatar">
                <div class="header-details">
                    <h1><?= htmlspecialchars($username) ?></h1>
                    <div class="profile-meta">
                        <span> <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle;" width="18" height="18" fill="#606770" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 18a8 8 0 110-16 8 8 0 010 16zm0-10a2 2 0 100 4 2 2 0 000-4zm1 7h-2v-2h2v2z"/></svg> Member for 5 days</span>
                        <span> <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle;" width="18" height="18" fill="#606770" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zm0 18H5V8h14v13zm0-15H5V5h14v1zm-7 3a6 6 0 110 12 6 6 0 010-12zm0 2a4 4 0 100 8 4 4 0 000-8z"/></svg> Last seen this week</span>
                        <span> <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align:middle;" width="18" height="18" fill="#606770" viewBox="0 0 24 24"><path d="M19 3h-1V1h-2v2H8V1H6v2H5a2 2 0 00-2 2v16a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2zm0 18H5V8h14v13zm0-15H5V5h14v1zm-7 3a6 6 0 110 12 6 6 0 010-12zm0 2a4 4 0 100 8 4 4 0 000-8z"/></svg> Visited 3 days, 1 consecutive</span>
                    </div>
                </div>
                <div class="profile-actions">
                    <button>Edit profile</button>
                    <a href="#" style="display: flex; align-items: center; gap: 5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#1558d6" viewBox="0 0 24 24"><path d="M12 7c-2.757 0-5 2.243-5 5 0 2.757 2.243 5 5 5 2.757 0 5-2.243 5-5 0-2.757-2.243-5-5-5zm0 8c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zm7-7V7c0-4.963-4.037-9-9-9S1 2.037 1 7v1C.447 8 0 8.447 0 9v12c0 1.104.896 2 2 2h20c1.104 0 2-.896 2-2V9c0-.553-.447-1-1-1zm-2-1v1H7V6c0-3.859 3.141-7 7-7s7 3.141 7 7z"/></svg>
                        Network profile
                    </a>
                </div>
            </div>

            <!-- Tabs -->
            <div class="profile-tabs">
                <a href="#" class="selected">Activity</a>
                <a href="#">Saves</a>
                <a href="#">Settings</a>
            </div>

            <!-- Main Section -->
            <h2 class="profile-section-title">Summary</h2>
            <div class="summary-cards">
                <!-- Card 1 -->
                <div class="summary-card">
                    <div class="summary-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="#bbc4ca" viewBox="0 0 24 24"><path d="M20.285 2.859l-1.285 1.285-7.285 7.285 1.415 1.414 7.285-7.285 1.285-1.285zm-2.285 2.286l-1.285 1.285-4.285 4.285 1.415 1.415 4.285-4.285 1.285-1.285zm-2.285 2.286l-1.285 1.285-1.285 1.285 1.415 1.414 1.285-1.285 1.285-1.285zM6.857 11.143l-1.286 1.285c-2.285 2.285-2.285 6.001 0 8.286s6.001 2.285 8.286 0l1.286-1.285-1.414-1.415-1.286 1.285c-1.561 1.561-4.095 1.561-5.656 0s-1.561-4.095 0-5.656l1.286-1.285-1.414-1.415z"/></svg>
                    </div>
                    <div class="summary-card-title">
                        Reputation is how the community thanks you
                    </div>
                    <div class="summary-card-desc">
                        When users upvote your helpful posts, you'll earn reputation and unlock new privileges.
                    </div>
                    <a href="#" class="summary-card-link">Learn more about <span style="text-decoration:underline;">reputation</span> and <span style="text-decoration:underline;">privileges</span></a>
                </div>
                <!-- Card 2 -->
                <div class="summary-card">
                    <div class="summary-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="#bbc4ca" viewBox="0 0 24 24"><path d="M12 2C6.486 2 2 6.486 2 12c0 5.514 4.486 10 10 10s10-4.486 10-10c0-5.514-4.486-10-10-10zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
                    </div>
                    <div class="summary-card-title">
                        Earn badges for helpful actions
                    </div>
                    <div class="summary-card-desc">
                        Badges are bits of digital flair that you get when you participate in especially helpful ways.
                    </div>
                    <button class="primary-btn">Take the Tour and earn your first badge</button>
                </div>
                <!-- Card 3 -->
                <div class="summary-card">
                    <div class="summary-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="#bbc4ca" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.63-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.45 4.73L5.82 21z"/></svg>
                    </div>
                    <div class="summary-card-title">
                        Measure your impact
                    </div>
                    <div class="summary-card-desc">
                        Your posts and helpful actions here help hundreds or thousands of people searching for help.
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>