#!/bin/bash

# Create the db.php file
cat > db.php <<EOL
<?php
// db.php
\$host = 'localhost';
\$dbname = 'your_database';
\$user = 'your_user';
\$pass = 'your_password';

try {
    \$conn = new PDO("mysql:host=\$host;dbname=\$dbname", \$user, \$pass);
    \$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException \$e) {
    echo 'ERROR: ' . \$e->getMessage();
}
?>
EOL

echo "db.php created."

# Create the index.php file
cat > index.php <<EOL
<?php
// index.php

include 'connection/db.php';

if (\$_SERVER['REQUEST_METHOD'] == 'POST') {
    \$chatId = \$_POST['chatId'];

    // Check if chatId already exists
    \$stmt = \$conn->prepare("SELECT * FROM conversation_flow WHERE chatId = ?");
    \$stmt->execute([\$chatId]);
    \$user = \$stmt->fetch();

    if (!\$user) {
        // Insert new chatId if not exists
        \$stmt = \$conn->prepare("INSERT INTO conversation_flow (chatId) VALUES (?)");
        \$stmt->execute([\$chatId]);
        echo json_encode(['status' => 'success', 'message' => 'User created']);
    } else {
        echo json_encode(['status' => 'exists', 'message' => 'User already exists']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
EOL

echo "index.php created."

# Create the update_name.php file
cat > update_name.php <<EOL
<?php
// update_name.php

include 'connection/db.php';

if (\$_SERVER['REQUEST_METHOD'] == 'POST') {
    \$chatId = \$_POST['chatId'];
    \$name = \$_POST['name'];

    // Update user name
    \$stmt = \$conn->prepare("UPDATE conversation_flow SET name = ? WHERE chatId = ?");
    \$stmt->execute([\$name, \$chatId]);

    echo json_encode(['status' => 'success', 'message' => 'Name updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
EOL

echo "update_name.php created."

# Create the update_country.php file
cat > update_country.php <<EOL
<?php
// update_country.php

include 'connection/db.php';

if (\$_SERVER['REQUEST_METHOD'] == 'POST') {
    \$chatId = \$_POST['chatId'];
    \$country = \$_POST['country'];

    // Update user country
    \$stmt = \$conn->prepare("UPDATE conversation_flow SET country = ? WHERE chatId = ?");
    \$stmt->execute([\$country, \$chatId]);

    echo json_encode(['status' => 'success', 'message' => 'Country updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
EOL

echo "update_country.php created."

# Create the update_amount.php file
cat > update_amount.php <<EOL
<?php
// update_amount.php

include 'connection/db.php';

if (\$_SERVER['REQUEST_METHOD'] == 'POST') {
    \$chatId = \$_POST['chatId'];
    \$amount = \$_POST['amount'];

    // Update payment amount
    \$stmt = \$conn->prepare("UPDATE conversation_flow SET amount = ? WHERE chatId = ?");
    \$stmt->execute([\$amount, \$chatId]);

    echo json_encode(['status' => 'success', 'message' => 'Amount updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
EOL

echo "update_amount.php created."

# Create the update_phone.php file
cat > update_phone.php <<EOL
<?php
// update_phone.php

include 'connection/db.php';

if (\$_SERVER['REQUEST_METHOD'] == 'POST') {
    \$chatId = \$_POST['chatId'];
    \$phoneNumber = \$_POST['phoneNumber'];

    // Update user phone number
    \$stmt = \$conn->prepare("UPDATE conversation_flow SET phoneNumber = ? WHERE chatId = ?");
    \$stmt->execute([\$phoneNumber, \$chatId]);

    echo json_encode(['status' => 'success', 'message' => 'Phone number updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
EOL

echo "update_phone.php created."

# Make files readable and executable
chmod 644 *.php

echo "All files have been created."
