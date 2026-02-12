<?php
require 'auth.php';
require_once __DIR__ . '/../config/huggingface.php';

$answer = "";
$question = "";
$model_loading = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $question = trim($_POST["question"]);
    $prompt = "<s>[INST] You are an AI study assistant for a study portal website.

Purpose:
- Help students with ANY study-related, academic, or educational question.
- This includes all school and college subjects, theory, definitions, explanations, problem solving, programming, science, humanities, and exam preparation.

Behavior rules:
- First, intelligently auto-correct spelling, grammar, and sentence structure of the user's question.
- Do NOT mention spelling mistakes.
- Treat the corrected version as the actual question.
- Answer based on the corrected question.

Allowed:
- Definitions, Explanations, Problem solving, Programming questions, Concept clarification, Academic writing help

Not allowed:
- Casual conversation, Personal questions, Jokes, fun, entertainment, Roleplay

If the question is NOT related to study or academics, reply exactly:
'I can only help with study-related or academic questions.'

Formatting rules:
- At the beginning of your response, show the corrected question exactly in this format:
CORRECTED_QUESTION: (corrected question here)

- Then provide a clear, student-friendly answer.

Programming rules:
- If the question involves programming, place all code strictly between:
CODE_START
(code here)
CODE_END

Output rules:
- Use plain text only.
- Do NOT use LaTeX or special math formatting.
- Write equations normally, like: 2 + 2 = 4.
- Explain clearly, like a teacher.

User question: " . $question . " [/INST]";

    $data = [
        "inputs" => $prompt,
        "parameters" => [
            "max_new_tokens" => 500,
            "temperature" => 0.3,
            "top_p" => 0.95,
            "do_sample" => true,
            "return_full_text" => false
        ]
    ];

    $ch = curl_init("https://api-inference.huggingface.co/models/" . HUGGINGFACE_MODEL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . HUGGINGFACE_API_KEY
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_error($ch)) {
        $answer = "Connection error: " . curl_error($ch);
    } else if ($http_code === 200) {
        $result = json_decode($response, true);
        if (isset($result[0]['generated_text'])) {
            $answer = trim($result[0]['generated_text']);
        } else if (isset($result['error'])) {
            if (strpos($result['error'], 'loading') !== false) {
                $model_loading = true;
                $answer = "The AI model is loading. Please wait a few seconds and try again. (First request may take 20-30 seconds)";
            } else {
                $answer = "API Error: " . $result['error'];
            }
        } else {
            $answer = "Sorry, I couldn't process your request. Please try again.";
        }
    } else if ($http_code === 503) {
        $model_loading = true;
        $answer = "The AI model is loading. Please wait a few seconds and try again. (First request may take 20-30 seconds)";
    } else {
        $answer = "Error: API returned HTTP code " . $http_code;
    }
    
    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Study Assistant - Tech Masters</title>
    <link rel="stylesheet" href="ai.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <summary>
                        <?= htmlspecialchars($username) ?>
                    </summary>
                    <div>
                        <a href="profile.php">Profile</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </details>
            </li>
        </ul>
    </nav>

    <div class="ai-wrapper">
        <div class="ai-header">
            <h1><i class="fas fa-robot"></i> AI Study Assistant</h1>
        </div>

        <div class="ai-search-container">
            <form method="POST" class="ai-form" id="aiForm">
                <div class="ai-input-wrapper">
                    <i class="fas fa-magic ai-input-icon"></i>
                    <input type="text" 
                           name="question" 
                           class="ai-input" 
                           placeholder="Ask any study question..." 
                           value="<?= htmlspecialchars($question) ?>"
                           autocomplete="off"
                           id="questionInput"
                           required>
                </div>
                <button type="submit" class="ai-submit-btn" id="submitBtn">
                    <i class="fas fa-paper-plane"></i>
                    <span>Ask AI</span>
                </button>
            </form>
            
            <?php if ($model_loading): ?>
            <div class="loading-indicator">
                <div class="loading-spinner"></div>
                <span>Loading AI model... Please wait (first request may take 30 seconds)</span>
            </div>
            <?php endif; ?>
    
        </div>

        <?php if (!empty($question) && !empty($answer)): ?>
            <div class="chat-area">
                <div class="user-msg">
                    <p><i class="fas fa-user-circle"></i> You</p>
                    <p><?= htmlspecialchars($question) ?></p>
                </div>

                <div class="ai-msg">
                    <div class="ai-header">
                        <span>
                            <i class="fas fa-robot"></i>
                            AI Study Assistant
                        </span>
                        <button onclick="copyAnswer()" class="copy-btn">
                            <i class="fas fa-copy"></i> Copy
                        </button>
                    </div>
                    
                    <div id="aiAnswer" class="ai-answer">
                        <?= nl2br(htmlspecialchars($answer)) ?>
                    </div>
                </div>

                <a href="https://www.youtube.com/results?search_query=<?= urlencode($question) ?>" 
                   target="_blank" 
                   class="video-link">
                    <i class="fab fa-youtube"></i>
                    Watch related videos
                    <i class="fas fa-external-link-alt" style="font-size: 0.7rem;"></i>
                </a>
            </div>
        <?php elseif ($_SERVER["REQUEST_METHOD"] === "POST" && empty($answer)): ?>
            <div class="no-answer">
                <i class="fas fa-robot" style="font-size: 2.5rem; color: #94a3b8;"></i>
                <p style="margin-top: 1rem;">Sorry, I can only help with study-related questions.</p>
            </div>
        <?php else: ?>
            <div class="chat-area welcome-state">
                <i class="fas fa-robot"></i>
                <h2>Ready to help you learn!</h2>
                <p>Ask me anything about your studies - from mathematics and science to programming and literature.</p>
                <div class="features-list">
                    <span><i class="fas fa-check-circle" style="color: #10b981;"></i> Auto-correction</span>
                    <span><i class="fas fa-code" style="color: #8b5cf6;"></i> Code formatting</span>
                    <span><i class="fas fa-bolt" style="color: #f97316;"></i> Instant answers</span>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Set question and submit form
        function setQuestion(question) {
            document.getElementById('questionInput').value = question;
            document.getElementById('aiForm').submit();
        }

        // Copy answer to clipboard
        function copyAnswer() {
            const answerDiv = document.getElementById("aiAnswer");
            if (answerDiv) {
                const tempDiv = document.createElement("div");
                tempDiv.innerHTML = answerDiv.innerHTML;
                const text = tempDiv.textContent || tempDiv.innerText || "";
                
                navigator.clipboard.writeText(text).then(() => {
                    const btn = document.querySelector(".copy-btn");
                    const originalHTML = btn.innerHTML;
                    btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
                    btn.style.background = '#10b981';
                    btn.style.color = 'white';
                    btn.style.borderColor = '#10b981';
                    
                    setTimeout(() => {
                        btn.innerHTML = originalHTML;
                        btn.style.background = 'white';
                        btn.style.color = '#f97316';
                        btn.style.borderColor = '#f97316';
                    }, 2000);
                }).catch(() => {
                    alert('Failed to copy text');
                });
            }
        }

        // Format code blocks and corrected question
        document.addEventListener("DOMContentLoaded", () => {
            const answerBox = document.getElementById("aiAnswer");
            if (!answerBox) return;

            let html = answerBox.innerHTML;

            // Format code blocks
            const codeRegex = /CODE_START([\s\S]*?)CODE_END/g;
            html = html.replace(codeRegex, (match, code) => {
                return `<div class="code-block"><code>${code.trim()}</code></div>`;
            });

            // Extract corrected question
            if (html.includes("CORRECTED_QUESTION:")) {
                const parts = html.split("CORRECTED_QUESTION:");
                const afterSplit = parts[1].trim();
                const lines = afterSplit.split("\n");
                const corrected = lines.shift().trim();
                const content = lines.join("\n").trim();
                
                const correctedHTML = `
                    <div class="corrected-question">
                        <p><i class="fas fa-magic"></i> You mean:</p>
                        <p>${corrected}</p>
                    </div>
                    <div class="final-answer">${content}</div>
                `;
                
                answerBox.innerHTML = correctedHTML;
            } else {
                answerBox.innerHTML = `<div class="final-answer">${html}</div>`;
            }
        });

        // Disable submit button on form submit
        document.getElementById('aiForm')?.addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        });
    </script>
</body>
</html>