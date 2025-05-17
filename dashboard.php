<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "u1fkgwiwpmjub", "mp8cjl5322br", "dbp2nzbg1mejnq");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = $_SESSION['user_id'];

if (isset($_GET['cancel'])) {
    $bid = $_GET['cancel'];
    $stmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $bid, $user_id);
    $stmt->execute();
    $cancelMessage = "Meeting cancelled.";
}

$stmt = $conn->prepare("SELECT * FROM bookings WHERE user_id = ? ORDER BY date DESC, time DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 950px;
            margin: 30px auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 12px;
        }

        h2 {
            color: #2c3e50;
        }

        a.logout-btn {
            float: right;
            background-color: #e74c3c;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 6px;
        }

        a.logout-btn:hover {
            background-color: #c0392b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th {
            background-color: #3498db;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        .cancel-btn {
            background-color: #f39c12;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .cancel-btn:hover {
            background-color: #d68910;
        }

        .message {
            padding: 10px;
            background-color: #ffdddd;
            color: #a94442;
            margin-bottom: 20px;
            border-left: 5px solid #f44336;
            border-radius: 5px;
        }

        @media screen and (max-width: 768px) {
            table {
                font-size: 14px;
            }

            .logout-btn {
                float: none;
                display: block;
                margin-bottom: 10px;
                width: fit-content;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" class="logout-btn">Logout</a>
        <h2>Your Dashboard</h2>

        <?php if (isset($cancelMessage)) { echo "<div class='message'>$cancelMessage</div>"; } ?>

        <table>
            <tr>
                <th>Visitor</th>
                <th>Email</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['visitor_name']) ?></td>
                    <td><?= htmlspecialchars($row['visitor_email']) ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= date("g:i A", strtotime($row['time'])) ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <?php if ($row['status'] === 'Scheduled') { ?>
                            <a class="cancel-btn" href="?cancel=<?= $row['id'] ?>" onclick="return confirm('Cancel this meeting?')">Cancel</a>
                        <?php } else { echo "-"; } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
