<?php
// DB 연결
$conn = new mysqli("localhost", "root", "", "mini_home");
if ($conn->connect_error) {
    die("DB 연결 실패: " . $conn->connect_error);
}

// 글 작성 처리
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $message = $conn->real_escape_string($_POST['message']);
    $conn->query("INSERT INTO guestbook (name, message) VALUES ('$name', '$message')");
    header("Location: visitor.php"); // 새로고침 시 중복 방지
    exit;
}

// 글 목록 불러오기
$result = $conn->query("SELECT * FROM guestbook ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>Visitor - Secret Cyworld</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="frame">
  <div class="left">
    <div class="section">
      <h3>방명록</h3>
      <form method="POST" action="">
        <input type="text" name="name" placeholder="이름" required><br><br>
        <textarea name="message" placeholder="메시지를 입력하세요" rows="4" required></textarea><br><br>
        <button type="submit">작성</button>
      </form>
    </div>
    <div class="section">
      <?php while($row = $result->fetch_assoc()): ?>
        <p><strong><?php echo htmlspecialchars($row['name']); ?></strong> (<?php echo $row['created_at']; ?>)</p>
        <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
        <hr>
      <?php endwhile; ?>
    </div>
  </div>

  <div class="right">
    <div class="menu">
      <a href="home.html">Home</a>
      <a href="profile.html">Profile</a>
      <a href="diary.html">Diary</a>
      <a href="photo.html">Photo</a>
      <a href="visitor.php">Visitor</a>
      <a href="setting.html">Setting</a>
    </div>
  </div>
</div>

</body>
</html>

