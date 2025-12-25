<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "your_database"; // Change to your actual database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture counts from POST
    $living_room = intval($_POST['living_room_count'] ?? 0);
    $kitchen = intval($_POST['kitchen_count'] ?? 0);
    $bedroom = intval($_POST['bedroom_count'] ?? 0);
    $bathroom = intval($_POST['bathroom_count'] ?? 0);
    $dining = intval($_POST['dining_count'] ?? 0);

    // Insert room data into the database
    $sql = "INSERT INTO room_selections (living_room, kitchen, bedroom, bathroom, dining)
            VALUES ('$living_room', '$kitchen', '$bedroom', '$bathroom', '$dining')";

    if ($conn->query($sql) === TRUE) {
        $message = "Room selections saved successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Selection</title>
    <style>
        /* Styling as per previous design */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color:rgb(53, 54, 54);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 16px 32px;
            height:8vh;
        }

        header .header-container {
            display: flex
;
    justify-content: center;
    color: white;
    font-size: 19px;

        }

        header img.logo {
            height: 40px;
        }

        header span {
            font-size: 16px;
            font-weight: 500;
            color: #555;
        }

        main {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 24px 32px;
        }

        .message.success {
            padding: 12px 16px;
            background: #d4edda;
            color: #155724;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .progress-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .progress-bar {
            flex-grow: 1;
            background-color: #e5e7eb;
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar .progress {
            background-color: #9333EA;
            height: 100%;
            width: 50%;
            transition: width 0.3s ease-in-out;
        }

        .progress-container .progress-label {
            margin-left: 12px;
            font-size: 14px;
            font-weight: 500;
            color: #555;
        }

        .room-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .room-item span {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .counter {
            display: flex;
            align-items: center;
        }

        .counter .count {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            margin: 0 12px;
        }

        .counter button {
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            line-height: 36px;
            background-color: #f3f4f6;
            color: #333;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .counter button:hover {
            background-color: #e5e7eb;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 24px;
        }

        .actions button {
            background-color: #e63946;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background-color 0.3s ease;
        }

        .actions button a {
            color: #fff;
            text-decoration: none;
        }

        .actions button:hover {
            background-color: #d62839;
        }

        .actions .save-button {
            background-color: #28a745;
        }

        .actions .save-button:hover {
            background-color: #218838;
        }
        h2{
            align
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.room-item').forEach(room => {
                const minusButton = room.querySelector('.minus');
                const plusButton = room.querySelector('.plus');
                const countSpan = room.querySelector('.count');
                const hiddenInput = room.querySelector('input[type="hidden"]');

                minusButton.addEventListener('click', () => {
                    let count = parseInt(countSpan.textContent, 10);
                    if (count > 0) {
                        count--;
                        countSpan.textContent = count;
                        hiddenInput.value = count;
                    }
                });

                plusButton.addEventListener('click', () => {
                    let count = parseInt(countSpan.textContent, 10);
                    count++;
                    countSpan.textContent = count;
                    hiddenInput.value = count;
                });
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="header-container">
            <h2>Other Room</h2>
            <!-- <img src="ilogo.avif" alt="Logo" class="logo">
            <span>2/4</span> -->
        </div>
    </header>

    <main>
        <?php if (!empty($message)): ?>
            <div class="message success"><?= htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <!-- <div class="progress-container">
            <div class="progress-bar">
                <div class="progress" style="width: 50%;"></div>
            </div>
            <span class="progress-label">50%</span>
        </div> -->
        
        <form method="POST">
            <div class="room-item">
                <span>There Is Any Other Room</span>
                <div class="counter">
                    <button type="button" class="minus">−</button>
                    <span class="count">0</span>
                    <input type="hidden" name="dining_count" value="0">
                    <button type="button" class="plus">+</button>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="next"><a href="interdesign3.php">Next</a></button>
                <button type="submit" name="save" class="save-button">Save</button>
            </div>
        </form>
    </main>
</body>
</html>
