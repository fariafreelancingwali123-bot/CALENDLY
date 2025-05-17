<?php
$conn = new mysqli("localhost", "u1fkgwiwpmjub", "mp8cjl5322br", "dbp2nzbg1mejnq");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visitor_name = $_POST['visitor_name'];
    $visitor_email = $_POST['visitor_email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $user_id = 1; // static host user for now; change if dynamic

    // Check if slot is already booked
    $check = $conn->prepare("SELECT * FROM bookings WHERE date = ? AND time = ? AND status = 'Scheduled'");
    $check->bind_param("ss", $date, $time);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $msg = "❌ This slot is already booked!";
    } else {
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, visitor_name, visitor_email, date, time) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $visitor_name, $visitor_email, $date, $time);
        $stmt->execute();
        $msg = "✅ Booking confirmed!";
    }
}
?>

<h2>Book an Appointment</h2>
<form method="POST">
  <input type="text" name="visitor_name" placeholder="Your Name" required><br>
  <input type="email" name="visitor_email" placeholder="Your Email" required><br>
  <input type="date" name="date" required><br>
  <select name="time" required>
    <option value="">-- Select Time --</option>
    <option value="10:00:00">10:00 AM</option>
    <option value="11:00:00">11:00 AM</option>
    <option value="14:00:00">2:00 PM</option>
    <option value="15:00:00">3:00 PM</option>
  </select><br>
  <button type="submit">Book Now</button>
</form>

<p><?php echo $msg; ?></p>
