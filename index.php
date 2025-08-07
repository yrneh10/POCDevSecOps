<?php
// Database configuration
$host = 'localhost';
$db   = 'your_database';
$user = 'your_username';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enables exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Sets default fetch mode
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Use real prepared statements
];

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}

// Example input (normally comes from POST data)
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';

// Input validation (basic)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}
if (empty($name)) {
    die("Name is required.");
}

// Prepare and execute SQL safely
$sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
$stmt = $pdo->prepare($sql);

// Bind values safely
$stmt->execute([
    ':name'  => $name,
    ':email' => $email,
]);

echo "User added successfully!";
?>
