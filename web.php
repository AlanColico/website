<?php
include 'config.php';

// Fetch announcements from the database
$query = "SELECT * FROM announcements ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="design.css">
    <script src="function.js" defer></script>
    <title>Mathematics Department</title>
</head>
<body>

    <!-- Navigation Bar -->
    <header class="homepage-nav">
        <span class="menu-icon material-icons" id="menu-icon">menu</span>
        <div class="department-name">
            <h1>MATHEMATICS DEPARTMENT</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Type Something Here..." aria-label="Search">
            <button class="search-icon" aria-label="Search Button">
                <i class="material-icons">search</i>
            </button>
        </div>
    </header>

    <!-- Image Section -->
    <section class="img-container">
        <!-- Banner for Mobile View -->
        <img class="math-banner" src="banner-math.jpg" alt="Mathematics Department Banner">

        <!-- Left Side - Text -->
        <div class="img-text animated-text">
            <h1>Mathematics Department Website</h1>
            <p>Access free lesson materials, video lessons, and announcements regarding the Mathematics Department.</p>
            <button onclick="scrollToSection('section1')">Scroll Down</button>
        </div>

        <!-- Right Side - Image for Desktop -->
        <div class="math-image">
            <img src="math_logo.png" alt="Mathematics Department Logo">
        </div>
    </section>

    <!-- Sidebar Menu -->
    <nav class="menu" id="menu1">
        <button onclick="scrollToSection('section1')">
            <i class="material-icons">announcement</i> Announcement
        </button>
        <div class="learning-dropdown">
            <button onclick="scrollToSection('section2')">
                <i class="material-icons">book</i> Learning Resources
            </button>
            <div class="lr-content">
                <a href="https://drive.google.com/drive/folders/1_6bBAVpk2xByy5TZQltRw0EaYAfM1t2_?usp=drive_link">Module</a>
                <a href="https://drive.google.com/drive/folders/1IYypOrbZh94cB12sZnm2K1zJ8OcwF_e5?usp=drive_link">Activity Sheets</a>
                <a href="https://drive.google.com/drive/folders/1znXTNXDVV0h_U8go2sRQVD4_o5EpiBGe?usp=drive_link">Curriculum Guide</a>
                <a href="https://drive.google.com/drive/folders/1u5soEImElPmJc8dGHPf2sag6o5X1r3_5?usp=drive_link">Video Lessons</a>
            </div>
        </div>
        <div class="Eservice-dropdown">
            <button onclick="scrollToSection('section3')">
                <i class="material-icons">computer</i> E-Services
            </button>
            <div class="Es-content">
                <a href="https://www.khanacademy.org/" target="_blank" rel="noopener">Khan Academy</a>
                <a href="https://www.houseofmath.com/" target="_blank" rel="noopener">House of Math</a>
            </div>
        </div>
        <button onclick="scrollToSection('section4')">
            <i class="material-icons">photo_library</i> Gallery
        </button>
        <button onclick="scrollToSection('section5')">
            <i class="material-icons">settings</i> Settings
        </button>
        <button onclick="scrollToSection('section6')">
            <i class="material-icons">info</i> About
        </button>
        <div class="upload-access-container">
            <div class="Access" id="access">
                <p>Announcement Upload Access:</p>
                <input type="password" id="passkey" placeholder="Enter password">
                <button id="unlockButton">Unlock</button>
                <p id="error-message">Incorrect passkey, please try again.</p>
            </div>
        </div>
    </nav>

 <!-- Announcement Section -->
    <section id="section1" class="section Announce-section">
    <div class="seccontainer">
        <h1>ANNOUNCEMENTS</h1>
        <p>Important information and updates.</p>
        <div id="announcementList">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="announcement-item">
                    <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <?php if ($row['file_path']): ?>
                        <a href="uploads/<?php echo $row['file_path']; ?>" target="_blank">View Attached File</a>
                    <?php endif; ?>
                    <p><strong>Posted on:</strong> <?php echo $row['created_at']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    </section>
    
    <!-- Upload Box -->
    <div class="upload-box" id="upload-box">
        <h2>Upload Your Announcement</h2>
        <p>Provide the details of your announcement below:</p>
        <form method="POST" action="web.php" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" placeholder="Enter announcement title" required>

            <label for="description">Description:</label>
            <textarea id="description" rows="4" placeholder="Enter announcement details" required></textarea>

            <label for="fileUpload">Attach File:</label>
            <input type="file" id="fileUpload" accept=".jpg,.png,.pdf,.docx">

            <label for="for link">Upload link:</label>
            <input type="text" id="link" placeholder="Enter link" required>

            <button type="submit">Submit Announcement</button>
        </form>
    </div>

                        
        <section id="section2" class="section learning-section">
            <div class="learningcontainer">
            <h1>Learning Resources</h1>
            <p>Access free lesson materials</p>

            <div class="module-container">
                <div class="containers">
                    <!-- Modules Card -->
                    <a href="https://drive.google.com/drive/folders/1_6bBAVpk2xByy5TZQltRw0EaYAfM1t2_?usp=drive_link" target="_blank" class="card-link">
                        <div class="drive-card">
                            <div class="contents">
                                <!-- SVG Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffffff">
                                    <path d="M12 2L1 21h22L12 2zm0 3.3L19.6 19H4.4L12 5.3zm-1 7.7h2v5h-2v-5zm0-3h2v2h-2v-2z"/>
                                </svg>
                                <p class="para"> Lessons and Modules - Google Drive</p>
                                <span class="link">Find out more →</span>
                            </div>
                        </div>
                    </a>

                    <!-- Activity Sheets Card -->
                    <a href="https://drive.google.com/drive/folders/1IYypOrbZh94cB12sZnm2K1zJ8OcwF_e5?usp=drive_link" target="_blank" class="card-link">
                        <div class="drive-card">
                            <div class="contents">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffffff">
                                    <path d="M3 3h18v2H3V3zm0 4h18v2H3V7zm0 4h12v2H3v-2zm0 4h8v2H3v-2z"/>
                                </svg>
                                <p class="para">Activity Sheets - Google Drive</p>
                                <span class="link">Access here →</span>
                            </div>
                        </div>
                    </a>

                    <!-- Curriculum Guide Card -->
                    <a href="https://drive.google.com/drive/folders/1znXTNXDVV0h_U8go2sRQVD4_o5EpiBGe?usp=drive_link" target="_blank" class="card-link">
                        <div class="drive-card">
                            <div class="contents">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffffff">
                                    <path d="M4 4h16v2H4V4zm0 4h10v2H4V8zm0 4h8v2H4v-2zm0 4h6v2H4v-2zM20 8v10l-4-2.5L12 18V8h8z"/>
                                </svg>
                                <p class="para">Curriculum Guide - Google Drive</p>
                                <span class="link">View guide →</span>
                            </div>
                        </div>
                    </a>

                    <!-- Video Lessons Card -->
                    <a href="https://drive.google.com/drive/folders/1u5soEImElPmJc8dGHPf2sag6o5X1r3_5?usp=drive_link" target="_blank" class="card-link">
                        <div class="drive-card">
                            <div class="contents">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffffff">
                                    <path d="M10 8.64L15.27 12 10 15.36V8.64M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-2 0a7 7 0 10-14 0 7 7 0 0014 0z"/>
                                </svg>
                                <p class="para">Video Lessons - Google Drive</p>
                                <span class="link">Watch now →</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            </div>
        </section>
        <section id="section3" class="section Eservice-section">
            <div class="seccontainer">
                <h1>E-services</h1>
                <p>Learn Mathematics through these Websites</p>
            </div>
        </section>

        <section id="section4" class="section gallery-section">
            <div class="seccontainer">
                <h1>Gallery</h1>
                <p>Teachers of Mathematics Department</p>
            </div>
        </section>

        <section id="section5" class="section settings-section">
            <div class="seccontainer">
                <h1>Settings</h1>
                <p>Make changes</p>
            </div>
        </section>

        <footer> 
            <h1>About</h1>
        
        </footer>

</body>
</html>


