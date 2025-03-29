<?php
// Установка заголовка для кодировки UTF-8
header('Content-Type: text/html; charset=utf-8');

// Подключение к базе данных
$servername = "localhost"; // или ваш сервер
$username = "arinamao_bebra"; // ваше имя пользователя
$password = "228_bebra"; // ваш пароль
$dbname = "arinamao_bebra"; // имя вашей базы данных

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение последних 4 новостей
$sql = "SELECT * FROM igronovosti ORDER BY id DESC LIMIT 4"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
         <link rel="stylesheet" href="styles.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.jpg" alt="Игро-новости" style="width: 50px; height: auto;">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="newss.php">Новости</a></li>
                <li><a href="contacts.php">Контакты</a></li>
                <li><a href="admin_login.php">Вход администратора</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Главные новости</h1>
        <div class="news-container">
            <?php
            if ($result->num_rows > 0) {
                // Вывод данных каждой новости
                while($row = $result->fetch_assoc()) {
                    echo "<div class='news-item'>";
                    echo "<a href='news.php?id=" . $row["id"] . "'>";
                    echo "<img src='" . htmlspecialchars($row["img"]) . "' alt='" . htmlspecialchars($row["nazva"]) . "'>";
                    echo "<h2>" . htmlspecialchars($row["nazva"]) . "</h2>";
                    echo "</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>Нет новостей.</p>";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Арина Малашевская</p>
    </footer>

</body>
</html>

<?php
// Закрытие подключения
$conn->close();
?>
