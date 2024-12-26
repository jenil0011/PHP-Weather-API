<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .weather-info {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <h1>Weather App</h1>
    <form method="GET" action="">
        <label for="city">Enter City:</label>
        <input type="text" id="city" name="city" required>
        <button type="submit">Get Weather</button>
    </form>

    <?php
    if (isset($_GET['city'])) {
        // Get user input
        $city = htmlspecialchars($_GET['city']);
        // Your API key from OpenWeatherMap
        $apiKey = "63116dd157f94047d2e30a70f1a9e554";
        // API URL
        $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        // Fetch data from API
        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);

        // Display weather information
        if (isset($data['main'])) {
            echo "<div class='weather-info'>";
            echo "<h2>Weather in " . $data['name'] . "</h2>";
            echo "<p><strong>Temperature:</strong> " . $data['main']['temp'] . "°C</p>";
            echo "<p><strong>Weather:</strong> " . $data['weather'][0]['description'] . "</p>";
            echo "<p><strong>Humidity:</strong> " . $data['main']['humidity'] . "%</p>";
            echo "<p><strong>Wind Speed:</strong> " . $data['wind']['speed'] . " m/s</p>";
            echo "</div>";
        } else {
            // Display error message if city is invalid
            echo "<p style='color: red;'>Error: " . $data['message'] . "</p>";
        }
    }
    ?>
</body>
</html>
