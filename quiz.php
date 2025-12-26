<?php
require 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>

 <nav class="navbar">
        <div class="logo">Tech Masters</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="subjects.php">Subjects</a></li>
            <li><a href="notes.php">Notes</a></li>
            <li><a href="quiz.php">Quiz</a></li>
             <li><a href="ai_search.php" style="color: orange;">AI Help</a></li>
            <li><a href="contact.php">Contact</a></li>
           <li style="position: relative;">
    <details>
       <summary style="
    cursor: pointer;
    color: #a2e3ffff;
    font-weight: 600;
    padding: 2px 10px;
    border-radius: 20px;
    background: rgba(56, 189, 248, 0.12);
   
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
<section class="quiz-section">
    <h1>Take a Quiz</h1>
    <div id="quizContainer">
        <!-- Quiz question-->
    </div>
    <button class="next-btn" id="nextBtn" onclick="nextQuestion()">Next</button>
    <div class="score" id="scoreContainer"></div>
</section>

<script>
    const quizData = [
        {
            question: "The acceleration due to gravity on the surface of Earth is 9.8 m/s<sup>2</sup>. What will be the weight of 5kg object?",
            options: ["50", "40", "49", "45"],
            answer: "49"
        },
        {
            question: "Which SQL command is used to remove all records from a table but keep the table structure intact?",
            options: ["DELETE", "DROP", "TRUNCATE", "REMOVE"],
            answer: "TRUNCATE"
        },
        {
            question: "If 𝑓(𝑥)=𝑥3−3𝑥+2f(x)=x3−3x+2, then the sum of the roots of 𝑓(𝑥)=0f(x)=0 is:",
            options: ["0", "1", "-1", "3"],
            answer: "0"
        },
        {
            question: "The phenomenon of dispersion of light is due to:",
            options: ["Reflection", "Refraction", "Diffraction", "Interference"],
            answer: "Refraction"
        },
        {
            question: "Which of the following is NOT an operating system?",
            options: ["Windows", "Linux", "Oracle", "macOS"],
            answer: "Oracle"
        },
        {
            question: "The first law of thermodynamics is a statement of:",
            options: ["Conservation of momentum", "Conservation of energy", "Conservation of mass", "Conservation of charge"],
            answer: "Conservation of energy"
        },
        {
            question: "Which memory is volatile?",
            options: ["ROM", "Hard Disk", "SSD", "RAM"],
            answer: "RAM"
        },
        {
            question: "Which language is closest to machine language?",
            options: ["High-level language", "Assembly language", "Java", "Python"],
            answer: "Assembly language"
        },
        {
            question: "The unit of magnetic flux is:",
            options: ["Tesla", "Weber", "Henry", "Farad"],
            answer: "Weber"
        },
        {
            question: "The phenomenon of splitting of white light into its constituent colors is called:",
            options: ["Diffraction", "Interference", "Polarization", "Dispersion"],
            answer: "Dispersion"
        },
        {
            question: "Which particle has no electric charge?",
            options: ["Proton ", "Electron", "Neutron", "Positron"],
            answer: "Neutron"
        },
        {
            question: "Which law states that induced emf is proportional to rate of change of magnetic flux?",
            options: ["Ohm’s Law", "Coulomb’s Law", "Faraday’s Law", "Kirchhoff’s Law"],
            answer: "Faraday’s Law"
        },
        {
            question: "Which electromagnetic wave has the highest frequency?",
            options: ["Radio waves", "Microwaves", "X-rays", "Infrared"],
            answer: "X-rays"
        },
        {
            question: "In binary number system, the decimal equivalent of (1011)₂ is:",
            options: ["9", "10", "11", "13"],
            answer: "11"
        }
    ];

    let currentQuestion = 0;
    let score = 0;

    const quizContainer = document.getElementById('quizContainer');
    const scoreContainer = document.getElementById('scoreContainer');
    const nextBtn = document.getElementById('nextBtn');

    function loadQuestion() {
        const currentQuiz = quizData[currentQuestion];
        quizContainer.innerHTML = `
            <div class="question">${currentQuiz.question}</div>
            <div class="options">
                ${currentQuiz.options.map(option => `<button onclick="checkAnswer(this)">${option}</button>`).join('')}
            </div>
        `;
        scoreContainer.innerHTML = `Score: ${score}`;
        nextBtn.style.display = "none"; 
    }

    function checkAnswer(btn) {
        const selected = btn.innerText;
        const correct = quizData[currentQuestion].answer;

        if(selected === correct) {
            score++;
            btn.style.backgroundColor = "#27ae60"; 
        } else {
            btn.style.backgroundColor = "#e74c3c"; 
        }

        
        const buttons = document.querySelectorAll('.options button');
        buttons.forEach(button => button.disabled = true);

        nextBtn.style.display = "inline-block"; 
        scoreContainer.innerHTML = `Score: ${score}`;
    }

    function nextQuestion() {
        currentQuestion++;
        if(currentQuestion < quizData.length) {
            loadQuestion();
        } else {
            quizContainer.innerHTML = `<h2>Quiz Completed!</h2><p>Your final score is ${score} / ${quizData.length}</p>`;
            nextBtn.style.display = "none";
        }
    }

    loadQuestion();
</script>

</body>
</html>
