<?php
require 'auth.php';

// Get selected subject from URL
$subject = isset($_GET['subject']) ? $_GET['subject'] : 'physics';
$subject_titles = [
    'physics' => 'Physics Quiz',
    'math' => 'Mathematics Quiz',
    'computer' => 'Computer Science Quiz',
    'chemistry' => 'Chemistry Quiz'
];
$page_title = isset($subject_titles[$subject]) ? $subject_titles[$subject] : 'Quiz';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($page_title) ?> - Tech Masters</title>
    <link rel="stylesheet" href="quiz.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
</head>
<body>

  <nav class="navbar">
        <div class="logo">Tech Masters</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="subjects.php">Subjects</a></li>
            <li><a href="notes.php">Notes</a></li>
            <li><a href="quiz.php" style="color: #facc15;">Quiz</a></li>
             <li><a href="ai_search.php" style="color: orange;">AI Help</a></li>
              <li><a href="bookmarks.php" style="color: #ffc107;">🔖 Bookmarks</a></li>
            <li><a href="contact.php">Contact</a></li>
           <li style="position: relative;">
    <details>
       <summary style="
    cursor: pointer;
    color: rgb(217, 231, 238);
    font-weight: 600;
    padding: 4px 16px;
    border-radius: 20px;
    background: rgba(56, 189, 248, 0.12);
   list-style:none;
">
    <?= htmlspecialchars($username) ?>
</summary>
        <div style="
            position: absolute;
            top: 35px;
            right: 0;
            background: #0f172a;
            padding: 10px;
            border-radius: 6px;
            min-width: 140px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
            z-index: 999;
        ">
            <a href="profile.php" style="display:block; margin-bottom:8px;">
                Profile
            </a>
            <a href="logout.php" style="display:block;">
                Logout
            </a>
        </div>
    </details>
</li>
            
        </ul>
    </nav>


<div class="quiz-container">
    <!-- Subject Selection Sidebar -->
    <div class="quiz-sidebar">
        <h3><i class="fas fa-book-open"></i> Subjects</h3>
        <ul class="subject-list">
            <li <?= $subject == 'physics' ? 'class="active"' : '' ?>>
                <a href="?subject=physics"><i class="fas fa-atom"></i> Physics</a>
            </li>
            <li <?= $subject == 'math' ? 'class="active"' : '' ?>>
                <a href="?subject=math"><i class="fas fa-calculator"></i> Mathematics</a>
            </li>
            <li <?= $subject == 'computer' ? 'class="active"' : '' ?>>
                <a href="?subject=computer"><i class="fas fa-laptop-code"></i> Computer Science</a>
            </li>
            <li <?= $subject == 'chemistry' ? 'class="active"' : '' ?>>
                <a href="?subject=chemistry"><i class="fas fa-flask"></i> Chemistry</a>
            </li>
        </ul>
        
        <!-- Daily High Score Card -->
        <div class="high-score-card">
            <h4><i class="fas fa-trophy"></i> Today's Best Score</h4>
            <div id="dailyHighScore">
                <div class="no-high-score">
                    <i class="fas fa-chart-line"></i>
                    <p>No scores yet today</p>
                    <small>Be the first to set a record!</small>
                </div>
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="quiz-stats">
            <h4><i class="fas fa-chart-bar"></i> Your Stats</h4>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value" id="currentStreak">0</div>
                    <div class="stat-label">Today</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="totalQuizzes">0</div>
                    <div class="stat-label">Total</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value" id="bestScore">0%</div>
                    <div class="stat-label">Best</div>
                </div>
            </div>
        </div>
        
        <!-- Your Best Scores -->
        <div class="all-time-scores" id="allTimeScores">
            <h4><i class="fas fa-ranking-star"></i> Your Best Scores</h4>
            <div id="allTimeScoreList">
                <div class="no-all-time">
                    <i class="fas fa-trophy"></i>
                    <p>Take a quiz to see your scores!</p>
                </div>
            </div>
        </div>
        
        <!-- Quiz Info -->
        <div class="quiz-info">
            <h4><i class="fas fa-info-circle"></i> Quiz Rules</h4>
            <ul class="rules-list">
                <li><i class="fas fa-check-circle"></i> 20 questions per quiz</li>
                <li><i class="fas fa-check-circle"></i> 15 minute time limit</li>
                <li><i class="fas fa-check-circle"></i> Must answer to proceed</li>
            </ul>
        </div>
    </div>
    
    <!-- Main Quiz Area -->
    <div class="quiz-main">
        <div class="quiz-header">
            <h1><?= htmlspecialchars($page_title) ?></h1>
            <div class="quiz-meta">
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>Time: <span id="timer">15:00</span></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-question-circle"></i>
                    <span>Question: <span id="questionCounter">1/20</span></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-star"></i>
                    <span>Score: <span id="points">0</span></span>
                </div>
            </div>
        </div>
        
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>
        
        <div id="quizContent">
            <!-- Quiz content will be loaded here -->
        </div>
        
        <div class="quiz-controls" id="quizControls">
            <button class="control-btn" id="prevBtn" onclick="prevQuestion()">
                <i class="fas fa-arrow-left"></i> Previous
            </button>
            <button class="control-btn" id="nextBtn" onclick="nextQuestion()">
                Next <i class="fas fa-arrow-right"></i>
            </button>
            <button class="control-btn submit-btn" id="submitBtn" onclick="submitQuiz()" style="display: none;">
                <i class="fas fa-paper-plane"></i> Submit Quiz
            </button>
        </div>
    </div>
</div>

<script>
    // Large Question Bank for Each Subject
    const questionBanks = {
        physics: [
            {
                question: "What is the SI unit of force?",
                options: ["Newton", "Joule", "Watt", "Pascal"],
                answer: "Newton",
                explanation: "Force is measured in Newtons (N)"
            },
            {
                question: "Which law states that every action has an equal and opposite reaction?",
                options: ["Newton's First Law", "Newton's Second Law", "Newton's Third Law", "Law of Gravity"],
                answer: "Newton's Third Law",
                explanation: "Newton's Third Law of Motion"
            },
            {
                question: "What is the speed of light in vacuum?",
                options: ["3 × 10^6 m/s", "3 × 10^8 m/s", "3 × 10^10 m/s", "3 × 10^12 m/s"],
                answer: "3 × 10^8 m/s",
                explanation: "Light travels at approximately 299,792,458 m/s in vacuum"
            },
            {
                question: "Which of these is a vector quantity?",
                options: ["Mass", "Temperature", "Speed", "Velocity"],
                answer: "Velocity",
                explanation: "Velocity has both magnitude and direction"
            },
            {
                question: "What is the formula for kinetic energy?",
                options: ["mv", "mgh", "½mv²", "Fd"],
                answer: "½mv²",
                explanation: "KE = ½ × mass × velocity²"
            },
            {
                question: "Which electromagnetic wave has the longest wavelength?",
                options: ["Gamma rays", "X-rays", "Radio waves", "Ultraviolet"],
                answer: "Radio waves",
                explanation: "Radio waves have the longest wavelength in the EM spectrum"
            },
            {
                question: "What does 'g' represent in physics?",
                options: ["Gravitational force", "Acceleration due to gravity", "Gravitational constant", "Gram"],
                answer: "Acceleration due to gravity",
                explanation: "g = 9.8 m/s² on Earth's surface"
            },
            {
                question: "Which device converts mechanical energy to electrical energy?",
                options: ["Motor", "Generator", "Transformer", "Battery"],
                answer: "Generator",
                explanation: "Generators convert mechanical rotation to electricity"
            },
            {
                question: "What is the unit of electric current?",
                options: ["Volt", "Ampere", "Ohm", "Watt"],
                answer: "Ampere",
                explanation: "Current is measured in Amperes (A)"
            },
            {
                question: "Which lens converges light rays?",
                options: ["Concave lens", "Convex lens", "Plano-concave", "Cylindrical"],
                answer: "Convex lens",
                explanation: "Convex lenses converge parallel light rays"
            },
            {
                question: "What is the principle behind a rocket's motion?",
                options: ["Bernoulli's principle", "Conservation of energy", "Newton's third law", "Archimedes' principle"],
                answer: "Newton's third law",
                explanation: "Action-reaction principle propels rockets"
            },
            {
                question: "Which has the highest frequency?",
                options: ["Infrared", "Visible light", "Ultraviolet", "Microwave"],
                answer: "Ultraviolet",
                explanation: "UV has higher frequency than IR, visible light, and microwaves"
            },
            {
                question: "What is the unit of power?",
                options: ["Joule", "Watt", "Volt", "Newton"],
                answer: "Watt",
                explanation: "Power = Work/Time, measured in Watts"
            },
            {
                question: "Which particle is found in the nucleus of an atom?",
                options: ["Electron", "Neutron", "Positron", "Photon"],
                answer: "Neutron",
                explanation: "Neutrons and protons are in the nucleus"
            },
            {
                question: "What is the formula for density?",
                options: ["mass × volume", "mass/volume", "volume/mass", "weight/area"],
                answer: "mass/volume",
                explanation: "Density = Mass ÷ Volume"
            },
            {
                question: "Which color of light has the shortest wavelength?",
                options: ["Red", "Green", "Blue", "Violet"],
                answer: "Violet",
                explanation: "Violet light has the shortest wavelength in visible spectrum"
            },
            {
                question: "What is the principle of conservation of energy?",
                options: ["Energy can be created", "Energy can be destroyed", "Energy changes form", "Energy disappears"],
                answer: "Energy changes form",
                explanation: "Energy cannot be created or destroyed, only transformed"
            },
            {
                question: "Which instrument measures atmospheric pressure?",
                options: ["Thermometer", "Barometer", "Hygrometer", "Anemometer"],
                answer: "Barometer",
                explanation: "Barometers measure atmospheric pressure"
            },
            {
                question: "What is the formula for Ohm's Law?",
                options: ["V = IR", "P = IV", "E = mc²", "F = ma"],
                answer: "V = IR",
                explanation: "Voltage = Current × Resistance"
            },
            {
                question: "Which type of mirror always forms a virtual image?",
                options: ["Plane mirror", "Concave mirror", "Convex mirror", "Spherical mirror"],
                answer: "Convex mirror",
                explanation: "Convex mirrors always produce virtual, diminished images"
            },
            {
                question: "What is the SI unit of frequency?",
                options: ["Hertz", "Decibel", "Watt", "Tesla"],
                answer: "Hertz",
                explanation: "Frequency is measured in Hertz (Hz)"
            },
            {
                question: "Which law explains why ice floats on water?",
                options: ["Pascal's law", "Archimedes' principle", "Bernoulli's principle", "Hooke's law"],
                answer: "Archimedes' principle",
                explanation: "Ice is less dense than water due to Archimedes' principle"
            },
            {
                question: "What is the value of acceleration due to gravity on Earth?",
                options: ["8.9 m/s²", "9.8 m/s²", "10 m/s²", "9.5 m/s²"],
                answer: "9.8 m/s²",
                explanation: "g ≈ 9.8 m/s² on Earth's surface"
            },
            {
                question: "Which circuit component stores electrical energy?",
                options: ["Resistor", "Capacitor", "Transistor", "Diode"],
                answer: "Capacitor",
                explanation: "Capacitors store electrical charge"
            },
            {
                question: "What is the formula for work done?",
                options: ["F × d", "m × v", "½mv²", "mgh"],
                answer: "F × d",
                explanation: "Work = Force × displacement in direction of force"
            }
        ],
        math: [
            {
                question: "What is 15% of 200?",
                options: ["20", "25", "30", "35"],
                answer: "30",
                explanation: "15% of 200 = (15/100) × 200 = 30"
            },
            {
                question: "If x + 5 = 12, what is x?",
                options: ["5", "6", "7", "8"],
                answer: "7",
                explanation: "x = 12 - 5 = 7"
            },
            {
                question: "What is the area of a circle with radius 7cm?",
                options: ["44 cm²", "154 cm²", "22 cm²", "88 cm²"],
                answer: "154 cm²",
                explanation: "Area = πr² = (22/7)×7×7 = 154 cm²"
            },
            {
                question: "What is the value of π (pi) to two decimal places?",
                options: ["3.14", "3.41", "3.16", "3.18"],
                answer: "3.14",
                explanation: "π ≈ 3.14159..."
            },
            {
                question: "If a triangle has angles 60° and 70°, what is the third angle?",
                options: ["40°", "50°", "60°", "70°"],
                answer: "50°",
                explanation: "Sum of angles = 180°, so 180 - (60+70) = 50°"
            },
            {
                question: "What is the square root of 144?",
                options: ["11", "12", "13", "14"],
                answer: "12",
                explanation: "12 × 12 = 144"
            },
            {
                question: "Simplify: 3(x + 4) + 2(x - 1)",
                options: ["5x + 10", "5x + 14", "5x + 12", "5x + 8"],
                answer: "5x + 10",
                explanation: "3x + 12 + 2x - 2 = 5x + 10"
            },
            {
                question: "What is 2³ × 2²?",
                options: ["2⁵", "2⁶", "4⁵", "4⁶"],
                answer: "2⁵",
                explanation: "2³ × 2² = 2^(3+2) = 2⁵ = 32"
            },
            {
                question: "What is the perimeter of a square with side 5cm?",
                options: ["15 cm", "20 cm", "25 cm", "30 cm"],
                answer: "20 cm",
                explanation: "Perimeter = 4 × side = 4 × 5 = 20 cm"
            },
            {
                question: "Solve: 2x - 7 = 15",
                options: ["x = 4", "x = 8", "x = 11", "x = 12"],
                answer: "x = 11",
                explanation: "2x = 15 + 7 = 22, so x = 11"
            },
            {
                question: "What is the mean of: 5, 7, 9, 11, 13?",
                options: ["8", "9", "10", "11"],
                answer: "9",
                explanation: "(5+7+9+11+13)/5 = 45/5 = 9"
            },
            {
                question: "Factor: x² - 9",
                options: ["(x-3)(x+3)", "(x-9)(x+1)", "(x-3)²", "(x+3)²"],
                answer: "(x-3)(x+3)",
                explanation: "Difference of squares: a² - b² = (a-b)(a+b)"
            },
            {
                question: "What is 0.75 as a fraction?",
                options: ["3/4", "1/2", "2/3", "4/5"],
                answer: "3/4",
                explanation: "0.75 = 75/100 = 3/4"
            },
            {
                question: "If y = 2x + 3, what is y when x = 4?",
                options: ["9", "10", "11", "12"],
                answer: "11",
                explanation: "y = 2(4) + 3 = 8 + 3 = 11"
            },
            {
                question: "What is the volume of a cube with side 3cm?",
                options: ["9 cm³", "18 cm³", "27 cm³", "36 cm³"],
                answer: "27 cm³",
                explanation: "Volume = side³ = 3³ = 27 cm³"
            },
            {
                question: "What is the value of 5! (5 factorial)?",
                options: ["100", "110", "120", "130"],
                answer: "120",
                explanation: "5! = 5×4×3×2×1 = 120"
            },
            {
                question: "What is the next prime number after 17?",
                options: ["18", "19", "20", "21"],
                answer: "19",
                explanation: "19 is the next prime number"
            },
            {
                question: "Convert 2.5 hours to minutes",
                options: ["120 minutes", "140 minutes", "150 minutes", "160 minutes"],
                answer: "150 minutes",
                explanation: "2.5 × 60 = 150 minutes"
            },
            {
                question: "What is the slope of y = 3x + 2?",
                options: ["2", "3", "5", "x"],
                answer: "3",
                explanation: "In y = mx + b, m is the slope"
            },
            {
                question: "What is 7² + 8²?",
                options: ["100", "105", "110", "113"],
                answer: "113",
                explanation: "49 + 64 = 113"
            },
            {
                question: "What is the LCM of 6 and 8?",
                options: ["12", "18", "24", "36"],
                answer: "24",
                explanation: "Least Common Multiple of 6 and 8 is 24"
            },
            {
                question: "Simplify: √(25 × 4)",
                options: ["5", "10", "20", "50"],
                answer: "10",
                explanation: "√(100) = 10"
            },
            {
                question: "What is the decimal equivalent of 3/8?",
                options: ["0.325", "0.375", "0.425", "0.475"],
                answer: "0.375",
                explanation: "3 ÷ 8 = 0.375"
            },
            {
                question: "If a car travels 240 km in 3 hours, what is its speed?",
                options: ["60 km/h", "70 km/h", "80 km/h", "90 km/h"],
                answer: "80 km/h",
                explanation: "Speed = Distance/Time = 240/3 = 80 km/h"
            },
            {
                question: "What is the value of sin 30°?",
                options: ["0", "0.5", "0.707", "1"],
                answer: "0.5",
                explanation: "sin 30° = 1/2 = 0.5"
            }
        ],
        computer: [
            {
                question: "What does CPU stand for?",
                options: ["Central Processing Unit", "Computer Processing Unit", "Central Program Unit", "Computer Program Unit"],
                answer: "Central Processing Unit",
                explanation: "CPU is the brain of the computer"
            },
            {
                question: "Which language is used for web styling?",
                options: ["HTML", "CSS", "JavaScript", "Python"],
                answer: "CSS",
                explanation: "CSS (Cascading Style Sheets) styles web pages"
            },
            {
                question: "What is the binary equivalent of decimal 10?",
                options: ["1010", "1100", "1001", "1110"],
                answer: "1010",
                explanation: "10 in decimal = 1010 in binary"
            },
            {
                question: "Which protocol is used for email?",
                options: ["HTTP", "FTP", "SMTP", "TCP"],
                answer: "SMTP",
                explanation: "SMTP (Simple Mail Transfer Protocol) sends emails"
            },
            {
                question: "What does RAM stand for?",
                options: ["Random Access Memory", "Read Access Memory", "Random Available Memory", "Read Available Memory"],
                answer: "Random Access Memory",
                explanation: "RAM is temporary, volatile memory"
            },
            {
                question: "Which company developed Windows OS?",
                options: ["Apple", "Microsoft", "Google", "IBM"],
                answer: "Microsoft",
                explanation: "Microsoft Corporation developed Windows"
            },
            {
                question: "What is the extension of a Python file?",
                options: [".java", ".py", ".cpp", ".html"],
                answer: ".py",
                explanation: "Python files have .py extension"
            },
            {
                question: "Which is NOT a programming language?",
                options: ["Java", "C++", "Photoshop", "Python"],
                answer: "Photoshop",
                explanation: "Photoshop is image editing software"
            },
            {
                question: "What does URL stand for?",
                options: ["Uniform Resource Locator", "Universal Resource Link", "Uniform Resource Link", "Universal Resource Locator"],
                answer: "Uniform Resource Locator",
                explanation: "URL is a web address"
            },
            {
                question: "Which is the largest unit of storage?",
                options: ["Kilobyte", "Megabyte", "Gigabyte", "Terabyte"],
                answer: "Terabyte",
                explanation: "1 TB = 1024 GB"
            },
            {
                question: "What does HTML stand for?",
                options: ["Hyper Text Markup Language", "High Tech Modern Language", "Hyper Transfer Markup Language", "High Text Modern Language"],
                answer: "Hyper Text Markup Language",
                explanation: "HTML structures web pages"
            },
            {
                question: "Which is a relational database?",
                options: ["MySQL", "MongoDB", "Redis", "Cassandra"],
                answer: "MySQL",
                explanation: "MySQL is a relational database management system"
            },
            {
                question: "What does VPN stand for?",
                options: ["Virtual Private Network", "Very Private Network", "Virtual Public Network", "Verified Private Network"],
                answer: "Virtual Private Network",
                explanation: "VPN creates secure connections"
            },
            {
                question: "Which is an example of an input device?",
                options: ["Monitor", "Printer", "Keyboard", "Speaker"],
                answer: "Keyboard",
                explanation: "Keyboard inputs data into computer"
            },
            {
                question: "What is the main function of an operating system?",
                options: ["Run programs", "Manage hardware", "Both", "Neither"],
                answer: "Both",
                explanation: "OS manages both hardware and software"
            },
            {
                question: "Which is a high-level programming language?",
                options: ["Assembly", "Machine code", "Python", "Binary"],
                answer: "Python",
                explanation: "Python is a high-level language"
            },
            {
                question: "What does SQL stand for?",
                options: ["Structured Query Language", "Simple Query Language", "Structured Question Language", "Simple Question Language"],
                answer: "Structured Query Language",
                explanation: "SQL manages databases"
            },
            {
                question: "Which protocol is used for websites?",
                options: ["FTP", "HTTP", "SMTP", "POP3"],
                answer: "HTTP",
                explanation: "HTTP (HyperText Transfer Protocol) for web"
            },
            {
                question: "What is the brain of a computer?",
                options: ["RAM", "CPU", "Hard disk", "Motherboard"],
                answer: "CPU",
                explanation: "CPU processes all instructions"
            },
            {
                question: "Which is NOT an operating system?",
                options: ["Linux", "Android", "Photoshop", "macOS"],
                answer: "Photoshop",
                explanation: "Photoshop is application software"
            },
            {
                question: "What does GUI stand for?",
                options: ["Graphical User Interface", "General User Interface", "Graphical Utility Interface", "General Utility Interface"],
                answer: "Graphical User Interface",
                explanation: "GUI uses visual elements"
            },
            {
                question: "Which is an example of cloud storage?",
                options: ["Google Drive", "USB drive", "CD-ROM", "Hard disk"],
                answer: "Google Drive",
                explanation: "Google Drive stores files in cloud"
            },
            {
                question: "What is the purpose of a firewall?",
                options: ["Speed up computer", "Block viruses", "Increase storage", "Backup data"],
                answer: "Block viruses",
                explanation: "Firewall blocks unauthorized access"
            },
            {
                question: "Which is a markup language?",
                options: ["JavaScript", "Python", "HTML", "C++"],
                answer: "HTML",
                explanation: "HTML is a markup language"
            },
            {
                question: "What does LAN stand for?",
                options: ["Local Area Network", "Large Area Network", "Local Access Network", "Large Access Network"],
                answer: "Local Area Network",
                explanation: "LAN connects devices in small area"
            }
        ],
        chemistry: [
            {
                question: "What is the chemical symbol for gold?",
                options: ["Go", "Gd", "Au", "Ag"],
                answer: "Au",
                explanation: "Au comes from Latin 'aurum'"
            },
            {
                question: "What is H₂O?",
                options: ["Hydrogen", "Oxygen", "Water", "Carbon dioxide"],
                answer: "Water",
                explanation: "H₂O is water molecule"
            },
            {
                question: "What is the pH of pure water?",
                options: ["0", "7", "14", "1"],
                answer: "7",
                explanation: "Pure water is neutral: pH 7"
            },
            {
                question: "Which gas do plants absorb?",
                options: ["Oxygen", "Carbon dioxide", "Nitrogen", "Hydrogen"],
                answer: "Carbon dioxide",
                explanation: "Plants use CO₂ for photosynthesis"
            },
            {
                question: "What is the atomic number of carbon?",
                options: ["6", "12", "14", "16"],
                answer: "6",
                explanation: "Carbon has 6 protons"
            },
            {
                question: "Which is the lightest element?",
                options: ["Helium", "Hydrogen", "Oxygen", "Lithium"],
                answer: "Hydrogen",
                explanation: "Hydrogen has atomic mass ~1"
            },
            {
                question: "What does CO₂ represent?",
                options: ["Carbon monoxide", "Carbon dioxide", "Calcium oxide", "Copper oxide"],
                answer: "Carbon dioxide",
                explanation: "CO₂ = one carbon, two oxygen atoms"
            },
            {
                question: "Which is NOT a state of matter?",
                options: ["Solid", "Liquid", "Gas", "Energy"],
                answer: "Energy",
                explanation: "Solid, liquid, gas, plasma are states"
            },
            {
                question: "What is the chemical formula for table salt?",
                options: ["NaCl", "KCl", "CaCO₃", "H₂SO₄"],
                answer: "NaCl",
                explanation: "Sodium chloride = table salt"
            },
            {
                question: "Which metal is liquid at room temperature?",
                options: ["Iron", "Mercury", "Gold", "Aluminum"],
                answer: "Mercury",
                explanation: "Mercury (Hg) is liquid metal"
            },
            {
                question: "What is the main gas in air?",
                options: ["Oxygen", "Carbon dioxide", "Nitrogen", "Argon"],
                answer: "Nitrogen",
                explanation: "Air is ~78% nitrogen"
            },
            {
                question: "Which element has the symbol 'Fe'?",
                options: ["Fluorine", "Iron", "Lead", "Silver"],
                answer: "Iron",
                explanation: "Fe comes from Latin 'ferrum'"
            },
            {
                question: "What is the chemical symbol for silver?",
                options: ["Si", "Ag", "Au", "Sr"],
                answer: "Ag",
                explanation: "Ag from Latin 'argentum'"
            },
            {
                question: "Which is an acid?",
                options: ["NaOH", "HCl", "NaCl", "KOH"],
                answer: "HCl",
                explanation: "Hydrochloric acid"
            },
            {
                question: "What is the formula for sulfuric acid?",
                options: ["H₂SO₄", "HCl", "HNO₃", "H₃PO₄"],
                answer: "H₂SO₄",
                explanation: "Sulfuric acid = H₂SO₄"
            },
            {
                question: "Which is a noble gas?",
                options: ["Oxygen", "Nitrogen", "Helium", "Chlorine"],
                answer: "Helium",
                explanation: "Helium is inert noble gas"
            },
            {
                question: "What is rust chemically?",
                options: ["Iron oxide", "Copper oxide", "Aluminum oxide", "Zinc oxide"],
                answer: "Iron oxide",
                explanation: "Rust = Iron + Oxygen + Water"
            },
            {
                question: "Which is the most abundant element in universe?",
                options: ["Oxygen", "Carbon", "Hydrogen", "Helium"],
                answer: "Hydrogen",
                explanation: "Hydrogen makes up ~75% of universe"
            },
            {
                question: "What is the chemical symbol for potassium?",
                options: ["P", "Po", "K", "Pt"],
                answer: "K",
                explanation: "K from Latin 'kalium'"
            },
            {
                question: "Which process converts sugar to alcohol?",
                options: ["Photosynthesis", "Fermentation", "Distillation", "Evaporation"],
                answer: "Fermentation",
                explanation: "Yeast fermentation produces alcohol"
            },
            {
                question: "What is the atomic number of oxygen?",
                options: ["6", "8", "10", "16"],
                answer: "8",
                explanation: "Oxygen has 8 protons"
            },
            {
                question: "Which is a greenhouse gas?",
                options: ["Oxygen", "Nitrogen", "Carbon dioxide", "Hydrogen"],
                answer: "Carbon dioxide",
                explanation: "CO₂ traps heat in atmosphere"
            },
            {
                question: "What is the formula for ammonia?",
                options: ["NH₃", "NO₂", "N₂O", "HNO₃"],
                answer: "NH₃",
                explanation: "Ammonia = NH₃"
            },
            {
                question: "Which element is in all organic compounds?",
                options: ["Oxygen", "Hydrogen", "Carbon", "Nitrogen"],
                answer: "Carbon",
                explanation: "Organic chemistry = carbon compounds"
            },
            {
                question: "What is dry ice?",
                options: ["Frozen water", "Solid oxygen", "Solid carbon dioxide", "Frozen nitrogen"],
                answer: "Solid carbon dioxide",
                explanation: "Dry ice = solid CO₂"
            }
        ]
    };

    // Score Storage System (LocalStorage)
    class ScoreManager {
        static STORAGE_KEY = 'tech_masters_quiz_scores';
        static USERNAME = '<?= addslashes($username) ?>';
        
        static getToday() {
            return new Date().toISOString().split('T')[0];
        }
        
        static getAllScores() {
            const scores = localStorage.getItem(this.STORAGE_KEY);
            return scores ? JSON.parse(scores) : {};
        }
        
        static saveScore(subject, score, total, timeTaken) {
            const scores = this.getAllScores();
            const today = this.getToday();
            const percentage = Math.round((score / total) * 100);
            
            if (!scores[this.USERNAME]) {
                scores[this.USERNAME] = {};
            }
            
            if (!scores[this.USERNAME][subject]) {
                scores[this.USERNAME][subject] = [];
            }
            
            const newScore = {
                date: today,
                score: score,
                total: total,
                percentage: percentage,
                timeTaken: timeTaken,
                timestamp: new Date().toISOString()
            };
            
            scores[this.USERNAME][subject].push(newScore);
            localStorage.setItem(this.STORAGE_KEY, JSON.stringify(scores));
            
            return newScore;
        }
        
        static getDailyHighScore(subject) {
            const scores = this.getAllScores();
            const today = this.getToday();
            let highest = null;
            
            for (const user in scores) {
                if (scores[user][subject]) {
                    const todayScores = scores[user][subject].filter(s => s.date === today);
                    if (todayScores.length > 0) {
                        const userBest = todayScores.reduce((best, current) => 
                            current.score > best.score ? current : best
                        );
                        if (!highest || userBest.score > highest.score) {
                            highest = { username: user, ...userBest };
                        }
                    }
                }
            }
            
            return highest;
        }
        
        static getUserStats(subject) {
            const scores = this.getAllScores();
            const userScores = scores[this.USERNAME]?.[subject] || [];
            const today = this.getToday();
            
            const todayScores = userScores.filter(s => s.date === today);
            const bestToday = todayScores.length > 0 ? 
                Math.max(...todayScores.map(s => s.percentage)) : 0;
            
            const bestAllTime = userScores.length > 0 ? 
                Math.max(...userScores.map(s => s.percentage)) : 0;
            
            return {
                todayQuizCount: todayScores.length,
                totalQuizCount: userScores.length,
                bestToday: bestToday,
                bestAllTime: bestAllTime
            };
        }
        
        static getUserTopScores(subject, limit = 5) {
            const scores = this.getAllScores();
            const userScores = scores[this.USERNAME]?.[subject] || [];
            
            return userScores
                .sort((a, b) => b.percentage - a.percentage)
                .slice(0, limit);
        }
    }

    // Quiz Variables
    let currentQuestion = 0;
    let score = 0;
    let selectedSubject = "<?= $subject ?>";
    let userAnswers = [];
    let timeLeft = 900; // 15 minutes in seconds
    let timerInterval;
    let quizStarted = false;
    let currentQuizQuestions = []; // Store selected 20 random questions

    // Initialize quiz
    function initQuiz() {
        if (!quizStarted) {
            // Select 20 random questions from the question bank
            const allQuestions = questionBanks[selectedSubject] || questionBanks.physics;
            currentQuizQuestions = getRandomQuestions(allQuestions, 20);
            
            startTimer();
            quizStarted = true;
        }
        loadQuestion();
        updateProgress();
        updateQuestionCounter();
        updatePoints();
        loadHighScores();
        loadUserStats();
        
        // Update buttons
        document.getElementById('prevBtn').style.display = currentQuestion > 0 ? 'block' : 'none';
        document.getElementById('nextBtn').style.display = currentQuestion < currentQuizQuestions.length - 1 ? 'block' : 'none';
        document.getElementById('submitBtn').style.display = currentQuestion === currentQuizQuestions.length - 1 ? 'block' : 'none';
    }

    // Get random questions from array
    function getRandomQuestions(allQuestions, count) {
        // Shuffle array using Fisher-Yates algorithm
        const shuffled = [...allQuestions].sort(() => Math.random() - 0.5);
        return shuffled.slice(0, count);
    }

    function loadQuestion() {
        const question = currentQuizQuestions[currentQuestion];
        
        let optionsHTML = '';
        question.options.forEach((option, index) => {
            const isSelected = userAnswers[currentQuestion] === option;
            const isCorrect = userAnswers[currentQuestion] && option === question.answer;
            const isWrong = userAnswers[currentQuestion] && 
                           userAnswers[currentQuestion] === option && 
                           option !== question.answer;
            
            let optionClass = 'option-item';
            if (isSelected && isCorrect) optionClass += ' selected-correct';
            if (isSelected && isWrong) optionClass += ' selected-wrong';
            if (userAnswers[currentQuestion] && isCorrect) optionClass += ' correct-highlight';
            
            // Disable options if already answered
            const isDisabled = userAnswers[currentQuestion] ? 'disabled style="cursor: not-allowed; opacity: 0.7;"' : '';
            
            optionsHTML += `
                <div class="${optionClass}" onclick="selectOption(this, '${option.replace(/'/g, "\\'")}')" ${isDisabled}>
                    <div class="option-letter">${String.fromCharCode(65 + index)}</div>
                    <div class="option-text">${option}</div>
                </div>
            `;
        });
        
        // Add warning message if no answer selected
        const warningHTML = !userAnswers[currentQuestion] ? `
            <div class="answer-warning" id="answerWarning" style="display: none;">
                <i class="fas fa-exclamation-circle"></i>
                Please select an answer before continuing
            </div>
        ` : '';
        
        document.getElementById('quizContent').innerHTML = `
            <div class="question-card">
                <div class="question-number">Question ${currentQuestion + 1}</div>
                <div class="question-text">${question.question}</div>
                <div class="options-grid">
                    ${optionsHTML}
                </div>
                ${warningHTML}
                ${userAnswers[currentQuestion] ? 
                    `<div class="explanation">
                        <strong>Your Answer:</strong> ${userAnswers[currentQuestion]}<br>
                        ${userAnswers[currentQuestion] === question.answer ? 
                            '<span class="correct-answer"><i class="fas fa-check"></i> Correct!</span>' : 
                            `<span class="wrong-answer"><i class="fas fa-times"></i> Correct answer: ${question.answer}</span>`
                        }<br>
                        <em>${question.explanation}</em>
                    </div>` : ''
                }
            </div>
        `;
    }

    function selectOption(element, option) {
        if (userAnswers[currentQuestion]) return; // Prevent changing answer
        
        const question = currentQuizQuestions[currentQuestion];
        const correctAnswer = question.answer;
        const isCorrect = option === correctAnswer;
        
        userAnswers[currentQuestion] = option;
        
        // Disable all options after selection
        const options = document.querySelectorAll('.option-item');
        options.forEach(opt => {
            opt.style.cursor = 'not-allowed';
            opt.style.opacity = '0.7';
            opt.onclick = null; // Remove click handler
        });
        
        if (isCorrect) {
            score++;
            updatePoints();
        }
        
        // Highlight the correct/wrong answers
        setTimeout(() => {
            loadQuestion();
        }, 1000);
    }

    function updateProgress() {
        const progress = ((currentQuestion + 1) / currentQuizQuestions.length) * 100;
        document.getElementById('progressBar').style.width = `${progress}%`;
    }

    function updateQuestionCounter() {
        document.getElementById('questionCounter').textContent = 
            `${currentQuestion + 1}/${currentQuizQuestions.length}`;
    }

    function updatePoints() {
        document.getElementById('points').textContent = score;
    }

    function startTimer() {
        timerInterval = setInterval(() => {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('timer').textContent = 
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                submitQuiz();
            }
        }, 1000);
    }

    function nextQuestion() {
        // Check if answer is selected
        if (!userAnswers[currentQuestion]) {
            // Show warning message
            const warning = document.getElementById('answerWarning');
            if (warning) {
                warning.style.display = 'block';
                // Hide warning after 3 seconds
                setTimeout(() => {
                    warning.style.display = 'none';
                }, 3000);
            }
            return; // Don't proceed
        }
        
        if (currentQuestion < currentQuizQuestions.length - 1) {
            currentQuestion++;
            initQuiz();
        }
    }

    function prevQuestion() {
        if (currentQuestion > 0) {
            currentQuestion--;
            initQuiz();
        }
    }

    function submitQuiz() {
        // Check if all questions are answered
        const unansweredQuestions = userAnswers.filter(answer => !answer).length;
        if (unansweredQuestions > 0) {
            if (confirm(`You have ${unansweredQuestions} unanswered questions. Submit anyway?`)) {
                // User chose to submit with unanswered questions
                finishQuiz();
            }
        } else {
            finishQuiz();
        }
    }

    function finishQuiz() {
        clearInterval(timerInterval);
        
        const totalQuestions = currentQuizQuestions.length;
        const percentage = Math.round((score / totalQuestions) * 100);
        const timeTaken = 900 - timeLeft;
        const minutesTaken = Math.floor(timeTaken / 60);
        const secondsTaken = timeTaken % 60;
        
        // Save score to localStorage
        const savedScore = ScoreManager.saveScore(selectedSubject, score, totalQuestions, timeTaken);
        
        // Calculate unanswered questions
        const answeredQuestions = userAnswers.filter(answer => answer !== undefined && answer !== null).length;
        const unansweredCount = totalQuestions - answeredQuestions;
        
        // Display results
        document.getElementById('quizContent').innerHTML = `
            <div class="results-card">
                <div class="results-header">
                    <i class="fas fa-medal"></i>
                    <h2>Quiz Completed!</h2>
                    <i class="fas fa-medal"></i>
                </div>
                <div class="results-stats">
                    <div class="stat-result">
                        <div class="stat-icon" style="color: #10b981;"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">${score}/${totalQuestions}</div>
                            <div class="stat-label">Correct</div>
                        </div>
                    </div>
                    <div class="stat-result">
                        <div class="stat-icon" style="color: #0ea5e9;"><i class="fas fa-percentage"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">${percentage}%</div>
                            <div class="stat-label">Score</div>
                        </div>
                    </div>
                    <div class="stat-result">
                        <div class="stat-icon" style="color: #8b5cf6;"><i class="fas fa-clock"></i></div>
                        <div class="stat-info">
                            <div class="stat-value">${minutesTaken}:${secondsTaken.toString().padStart(2, '0')}</div>
                            <div class="stat-label">Time</div>
                        </div>
                    </div>
                </div>
                
                ${unansweredCount > 0 ? `
                    <div class="unanswered-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p>You left ${unansweredCount} question(s) unanswered</p>
                    </div>
                ` : ''}
                
                <div class="performance-meter">
                    <div class="performance-label">Performance Level</div>
                    <div class="performance-bar">
                        <div class="performance-fill" style="width: ${percentage}%"></div>
                    </div>
                    <div class="performance-text">
                        ${percentage >= 90 ? '🏆 Excellent!' : 
                          percentage >= 75 ? '👍 Very Good!' : 
                          percentage >= 60 ? '😊 Good!' : 
                          percentage >= 40 ? '📚 Keep Learning!' : '💪 Need Practice!'}
                    </div>
                </div>
                
                <div class="score-comparison">
                    <h4><i class="fas fa-trophy"></i> Score Comparison</h4>
                    <div class="comparison-stats">
                        <div class="comparison-item">
                            <div class="comparison-label">Your Score</div>
                            <div class="comparison-value">${percentage}%</div>
                        </div>
                        <div class="comparison-item">
                            <div class="comparison-label">Today's Best</div>
                            <div class="comparison-value" id="dailyBestPercent">0%</div>
                        </div>
                        <div class="comparison-item">
                            <div class="comparison-label">Your Best</div>
                            <div class="comparison-value" id="yourBestPercent">0%</div>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <button onclick="retryQuiz()" class="action-btn retry-btn">
                        <i class="fas fa-redo"></i> Try Again
                    </button>
                    <button onclick="changeSubject()" class="action-btn change-btn">
                        <i class="fas fa-exchange-alt"></i> Change Subject
                    </button>
                    <button onclick="reviewAnswers()" class="action-btn review-btn">
                        <i class="fas fa-list-check"></i> Review Answers
                    </button>
                </div>
            </div>
        `;
        
        document.getElementById('quizControls').style.display = 'none';
        
        // Update high scores display
        loadHighScores();
        loadUserStats();
        
        // Update comparison stats
        const dailyHigh = ScoreManager.getDailyHighScore(selectedSubject);
        const userStats = ScoreManager.getUserStats(selectedSubject);
        
        if (dailyHigh) {
            document.getElementById('dailyBestPercent').textContent = dailyHigh.percentage + '%';
        }
        document.getElementById('yourBestPercent').textContent = userStats.bestAllTime + '%';
    }

    function loadHighScores() {
        const dailyHigh = ScoreManager.getDailyHighScore(selectedSubject);
        const userTopScores = ScoreManager.getUserTopScores(selectedSubject, 5);
        
        // Update daily high score display
        if (dailyHigh) {
            document.getElementById('dailyHighScore').innerHTML = `
                <div class="high-score-details">
                    <div class="high-score-user">
                        <i class="fas fa-crown"></i>
                        ${dailyHigh.username === ScoreManager.USERNAME ? 'You' : dailyHigh.username}
                    </div>
                    <div class="high-score-value">
                        ${dailyHigh.score}/${dailyHigh.total}
                    </div>
                    <div class="high-score-percentage">
                        ${dailyHigh.percentage}%
                    </div>
                    <div class="high-score-label">Today's Best</div>
                </div>
            `;
        } else {
            document.getElementById('dailyHighScore').innerHTML = `
                <div class="no-high-score">
                    <i class="fas fa-trophy"></i>
                    <p>No scores yet today</p>
                    <small>Be the first to set a record!</small>
                </div>
            `;
        }
        
        // Update user best scores display
        if (userTopScores.length > 0) {
            let allTimeHTML = '<div class="all-time-list">';
            userTopScores.forEach((score, index) => {
                const medal = index === 0 ? '🥇' : index === 1 ? '🥈' : index === 2 ? '🥉' : `${index + 1}.`;
                const date = new Date(score.timestamp).toLocaleDateString('en-US', { 
                    month: 'short', 
                    day: 'numeric' 
                });
                allTimeHTML += `
                    <div class="all-time-item">
                        <div class="all-time-rank">${medal}</div>
                        <div class="all-time-score">${score.percentage}%</div>
                        <div class="all-time-date">${date}</div>
                    </div>
                `;
            });
            allTimeHTML += '</div>';
            document.getElementById('allTimeScoreList').innerHTML = allTimeHTML;
        } else {
            document.getElementById('allTimeScoreList').innerHTML = `
                <div class="no-all-time">
                    <i class="fas fa-trophy"></i>
                    <p>Take a quiz to see your scores!</p>
                </div>
            `;
        }
    }

    function loadUserStats() {
        const stats = ScoreManager.getUserStats(selectedSubject);
        
        // Update the stat values
        document.getElementById('currentStreak').textContent = stats.todayQuizCount || 0;
        document.getElementById('totalQuizzes').textContent = stats.totalQuizCount || 0;
        document.getElementById('bestScore').textContent = (stats.bestAllTime || 0) + '%';
    }

    function retryQuiz() {
        // Reset everything and start new random quiz
        currentQuestion = 0;
        score = 0;
        userAnswers = [];
        timeLeft = 900;
        quizStarted = false;
        currentQuizQuestions = []; // Clear current questions
        initQuiz();
        document.getElementById('quizControls').style.display = 'flex';
    }

    function changeSubject() {
        window.location.href = 'quiz.php?subject=' + selectedSubject;
    }

    function reviewAnswers() {
        currentQuestion = 0;
        loadQuestion();
        document.getElementById('quizControls').style.display = 'flex';
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initQuiz();
        loadHighScores();
        loadUserStats();
    });
</script>

</body>
</html>