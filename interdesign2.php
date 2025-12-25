<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "interiordata"; // Change to your actual database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture counts from POST
    $dining = intval($_POST['dining_count'] ?? 0);

    // Insert room data into the database
    $sql = "INSERT INTO room_selections (dining) VALUES ('$dining')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the next page after saving
        header("Location: interdesign3.php");
        exit;
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
            background-color: rgb(53, 54, 54);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 16px 32px;
            height: 8vh;
        }

        header .header-container {
            display: flex;
            justify-content: center;
            color: white;
            font-size: 19px;
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
            justify-content: center;
            margin-top: 24px;
        }

        .actions button {
            background-color: #28a745;
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

        .actions button:hover {
            background-color: #218838;
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
        </div>
    </header>

    <main>
        <?php if (!empty($message)): ?>
            <div class="message success"><?= htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="room-item">
                <span>Is there any other room?</span>
                <div class="counter">
                    <button type="button" class="minus">−</button>
                    <span class="count">0</span>
                    <input type="hidden" name="dining_count" value="0">
                    <button type="button" class="plus">+</button>
                </div>
            </div>

            <div class="actions">
                <button type="submit">Save and Next</button>
            </div>
        </form>
    </main>
</body>
</html>
