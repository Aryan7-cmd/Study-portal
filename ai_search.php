<?php

require 'auth.php';

require_once __DIR__ . '/../config/openai.php';

$answer = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $question = trim($_POST["question"]);

 $system_prompt = "
You are an AI study assistant for a study portal website.

Purpose:
- Help students with ANY study-related, academic, or educational question.
- This includes all school and college subjects, theory, definitions, explanations,
  problem solving, programming, science, humanities, and exam preparation.

Behavior rules:
- First, intelligently auto-correct spelling, grammar, and sentence structure of the user's question.
- Do NOT mention spelling mistakes.
- Treat the corrected version as the actual question.
- Answer based on the corrected question.

Allowed:
- Definitions (e.g., What is science?)
- Explanations (e.g., Explain photosynthesis)
- Problem solving
- Programming questions
- Concept clarification
- Academic writing help

Not allowed:
- Casual conversation
- Personal questions
- Jokes, fun, or entertainment
- Roleplay or chatting

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
";


    $data = [
        "model" => "gpt-4o-mini",
        "messages" => [
            ["role" => "system", "content" => $system_prompt],
            ["role" => "user", "content" => $question]
        ],
        "temperature" => 0.3
    ];

    $ch = curl_init("https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
   "Authorization: Bearer " . OPENAI_API_KEY
]);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    $answer = $result["choices"][0]["message"]["content"] ?? "AI could not generate an answer.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>AI Study Assistant</title>
    <link rel="stylesheet" href="ai.css">
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
<div class="ai-container">
    <h2 style="margin-bottom: 10px;">AI Study Assistant</h2>

    <form method="POST">
        <input type="text" name="question" placeholder="Ask a study related question..." required>
        <button type="submit">Ask AI</button>
    </form>

   <div class="chat-area">

    <?php if (!empty($question)) : ?>
        <div class="user-msg">
            <p>You:</p>
            <p><?= htmlspecialchars($question) ?></p>
        </div>
    <?php endif; ?>

    <?php if (!empty($answer)) : ?>
</div>
        <div class="ai-msg">
            <div class="ai-header">
                <span>AI Study Assistant</span>
                <button onclick="copyAnswer()">Copy</button>
            </div>
            
         <div id="aiAnswer" class="ai-answer">
    <?= nl2br(htmlspecialchars($answer)) ?>
</div>

        </div>
    <?php endif; ?>

</div>

        <a href="https://www.youtube.com/results?search_query=<?= urlencode($question) ?>" target="_blank" style="text-decoration:none; color: gray; font-weight:bolder;">
            📺 Watch related videos
        </a>

</div>
<script>
function copyAnswer() {
    const text = document.getElementById("aiAnswer").innerText;
    navigator.clipboard.writeText(text).then(() => {
        alert("Answer copied!");
    });
}
document.addEventListener("DOMContentLoaded", () => {
    const answerBox = document.getElementById("aiAnswer");
    if (!answerBox) return;

    let html = answerBox.innerHTML;

    const codeRegex = /CODE_START([\s\S]*?)CODE_END/g;

    html = html.replace(codeRegex, (match, code) => {
        return `
        <pre class="code-block"><code>${code.trim()}</code></pre>
        `;
    });

    answerBox.innerHTML = html;
});
document.addEventListener("DOMContentLoaded", () => {
    const rawText = `<?= addslashes($answer) ?>`;
    const container = document.getElementById("aiAnswer");
    if (!container) return;

    let corrected = "";
    let content = rawText;

    if (rawText.includes("CORRECTED_QUESTION:")) {
        const parts = rawText.split("CORRECTED_QUESTION:");
        const lines = parts[1].trim().split("\n");
        corrected = lines.shift().trim();
        content = lines.join("\n").trim();
    }

    let html = "";

    if (corrected) {
        html += `
            <div class="corrected-question">
                <p>You mean:</p>
                <p>${corrected}</p>
            </div>
        `;
    }

    html += `<div class="final-answer">${content}</div>`;

    container.innerHTML = html;
});
</script>
</body>
</html>
