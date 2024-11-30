<?php
// Đặt session_start() ngay đầu file
session_start();

// Kiểm tra nếu form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Đọc file câu hỏi
    $filename = "questions.txt";
    $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Xử lý câu hỏi và đáp án
    $quiz = [];
    $current_question = [];
    foreach ($questions as $line) {
        if (strpos($line, "Câu") === 0) {
            if (!empty($current_question)) {
                $quiz[] = $current_question;
            }
            $current_question = [];
        }
        $current_question[] = $line;
    }
    if (!empty($current_question)) {
        $quiz[] = $current_question;
    }

    // Trích xuất đáp án
    $answers = [];
    foreach ($quiz as $question) {
        foreach ($question as $line) {
            if (strpos($line, "Đáp án:") !== false) {
                $answers[] = trim(substr($line, strpos($line, ":") + 1));
            }
        }
    }

    // Tính điểm
    $score = 0;
    foreach ($_POST as $key => $userAnswer) {
        $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
        if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
            $score++;
        }
    }

    // Lưu kết quả vào session
    $_SESSION['score'] = $score;
    $_SESSION['total'] = count($answers);

    // Chuyển hướng sang trang kết quả
    header("Location: result.php");
    exit(); // Thoát sau khi chuyển hướng
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài thi trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Bài thi trắc nghiệm</h1>
    <form method="post" action="index.php">
        <?php
        // Hiển thị câu hỏi
        $filename = "questions.txt";
        $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $quiz = [];
        $current_question = [];
        foreach ($questions as $line) {
            if (strpos($line, "Câu") === 0) {
                if (!empty($current_question)) {
                    $quiz[] = $current_question;
                }
                $current_question = [];
            }
            $current_question[] = $line;
        }
        if (!empty($current_question)) {
            $quiz[] = $current_question;
        }

        foreach ($quiz as $index => $question) {
            $question_text = $question[0];
            $answers = array_slice($question, 1, 4); // Lấy các đáp án
            echo "<div class='card mb-4'>";
            echo "<div class='card-header'><strong>$question_text</strong></div>";
            echo "<div class='card-body'>";
            foreach ($answers as $answer) {
                $answer_value = substr($answer, 0, 1); // Lấy ký tự đầu (A, B, C, D)
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='question" . ($index + 1) . "' value='$answer_value' id='q" . ($index + 1) . $answer_value . "'>";
                echo "<label class='form-check-label' for='q" . ($index + 1) . $answer_value . "'>$answer</label>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
        <button type="submit" class="btn btn-primary">Nộp bài</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
