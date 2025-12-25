<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Dimensions</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color:rgb(53, 54, 54);
            color: white;
            padding: 5px 32px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        main {
            max-width: 800px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 24px 32px;
        }
        #room-container{
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }
        .room-section {
            margin-bottom: 20px;
            padding: 16px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        /* Room Colors */
        .bedroom-section {
            background-color: #e3f2fd; /* Light Blue */
        }

        .kitchen-section {
            background-color: #fff3e0; /* Light Orange */
        }

        .hall-section {
            background-color: #e8f5e9; /* Light Green */
        }

        .other-room-section {
            background-color: #f3e5f5; /* Light Purple */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="file"] {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 16px;
            width: 92%;
        }

        button {
            display: block;
            width: 28%;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .add-room-button {
            background-color: #28a745;
        }

        .add-other-room-button {
            background-color: #17a2b8;
        }

        button[type="submit"] {
            background-color: #007bff;
        }
        button a{
            text-decoration:none;
            color:white;
            font-size:20px;
        }
        #div{
            display: flex;
            gap: 10px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let bedroomCount = 1;
            let otherRoomCount = 0;

            function addBedroom() {
                bedroomCount++;
                const container = document.querySelector('#room-container');
                const newBedroom = `
                    <div class="room-section bedroom-section">
                        <h3>Bedroom ${bedroomCount}</h3>
                        <label>Wide (Square Feet)</label>
                        <input type="text" name="bedroom_width[]" required>
                        <label>Long (Square Feet)</label>
                        <input type="text" name="bedroom_height[]" required>
                        <label>Upload Your Room Image</label>
                        <input type="file" name="bedroom_file[]">
                    </div>`;
                container.insertAdjacentHTML('beforeend', newBedroom);
            }

            function addOtherRoom() {
                otherRoomCount++;
                const container = document.querySelector('#room-container');
                const newRoom = `
                    <div class="room-section other-room-section">
                        <h3>Other Room ${otherRoomCount}</h3>
                        <label>Room Name</label>
                        <input type="text" name="room_name[]" required>
                        <label>Wide (Square Feet)</label>
                        <input type="text" name="room_width[]" required>
                        <label>Long (Square Feet)</label>
                        <input type="text" name="room_height[]" required>
                        <label>Upload Your Room Image </label>
                        <input type="file" name="room_file[]">
                    </div>`;
                container.insertAdjacentHTML('beforeend', newRoom);
            }

            document.querySelector('.add-room-button').addEventListener('click', addBedroom);
            document.querySelector('.add-other-room-button').addEventListener('click', addOtherRoom);
        });
    </script>
</head>
<body>
    <header>
        <h1>Room Dimensions</h1>
    </header>
    <main>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "interiordata";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO rooms (room_name, width, height, file_path) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sdds", $roomName, $width, $height, $filePath);

            // Process Bedrooms
            if (!empty($_POST['bedroom_width']) && !empty($_POST['bedroom_height'])) {
                foreach ($_POST['bedroom_width'] as $index => $width) {
                    $height = $_POST['bedroom_height'][$index];
                    $roomName = "Bedroom " . ($index + 1);
                    $filePath = isset($_FILES['bedroom_file']['name'][$index]) ? $_FILES['bedroom_file']['name'][$index] : '';
                    $stmt->execute();
                }
            }

            // Process Kitchen
            if (!empty($_POST['kitchen_width']) && !empty($_POST['kitchen_height'])) {
                $width = $_POST['kitchen_width'];
                $height = $_POST['kitchen_height'];
                $roomName = "Kitchen";
                $filePath = isset($_FILES['kitchen_file']['name']) ? $_FILES['kitchen_file']['name'] : '';
                $stmt->execute();
            }

            // Process Hall
            if (!empty($_POST['hall_width']) && !empty($_POST['hall_height'])) {
                $width = $_POST['hall_width'];
                $height = $_POST['hall_height'];
                $roomName = "Hall";
                $filePath = isset($_FILES['hall_file']['name']) ? $_FILES['hall_file']['name'] : '';
                $stmt->execute();
            }

            // Process Other Rooms
            if (!empty($_POST['room_name']) && !empty($_POST['room_width']) && !empty($_POST['room_height'])) {
                foreach ($_POST['room_name'] as $index => $roomName) {
                    $width = $_POST['room_width'][$index];
                    $height = $_POST['room_height'][$index];
                    $filePath = isset($_FILES['room_file']['name'][$index]) ? $_FILES['room_file']['name'][$index] : '';
                    $stmt->execute();
                }
            }

            $stmt->close();
            $conn->close();

            echo "<p>Data saved successfully!</p>";
        }
        ?>
        <form method="POST" enctype="multipart/form-data">
            <div id="room-container">
                <div class="room-section bedroom-section">
                    <h3>Bedroom 1</h3>
                    <label>Wide (Square Feet)</label>
                    <input type="text" name="bedroom_width[]" required>
                    <label>Long (Square Feet)</label>
                    <input type="text" name="bedroom_height[]" required>
                    <label>Upload Your Room Image</label>
                    <input type="file" name="bedroom_file[]">
                </div>
                <div class="room-section hall-section">
                    <h3>Hall</h3>
                    <label>Wide (Square Feet)</label>
                    <input type="text" name="hall_width" required>
                    <label>Long (Square Feet)</label>
                    <input type="text" name="hall_height" required>
                    <label>Upload Your Room Image</label>
                    <input type="file" name="hall_file">
                </div>
                <div class="room-section kitchen-section">
                    <h3>Kitchen</h3>
                    <label>Wide (Square Feet)</label>
                    <input type="text" name="kitchen_width" required>
                    <label>Long (Square Feet)</label>
                    <input type="text" name="kitchen_height" required>
                    <label>Upload Your Room Image</label>
                    <input type="file" name="kitchen_file">
                </div>
            </div>
            <div id="div">
            <button type="button" class="add-room-button">Add Another Bedroom</button>
            <button type="button" class="add-other-room-button">Add Other Room</button>
            <button type="submit">Save Room Dimensions</button>
            <button type="submit"><a href="interdesign4.php">Next</a></button>
            </div>
        </form>
    </main>
</body>
