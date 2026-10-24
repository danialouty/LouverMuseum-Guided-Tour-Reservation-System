<?php

session_start();
require_once '../config.php';

if (!isset($_SESSION['email']) || ($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../BackEnd/pages/login.php');
    exit();
}

if (!$conn->query("CREATE TABLE IF NOT EXISTS time_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slot_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    capacity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)")) {
    die('Unable to prepare time slots: ' . htmlspecialchars($conn->error));
}

if (!$conn->query("CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    slot_id INT NOT NULL,
    status ENUM('pending','confirmed','rejected','cancelled') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (user_id),
    INDEX (slot_id)
)")) {
    die('Unable to prepare reservations: ' . htmlspecialchars($conn->error));
}

$hasActiveColumn = false;
$columns = $conn->query("SHOW COLUMNS FROM users LIKE 'is_active'");
if ($columns && $columns->num_rows > 0) {
    $hasActiveColumn = true;
} else {
    if (!$conn->query("ALTER TABLE users ADD COLUMN is_active TINYINT(1) NOT NULL DEFAULT 1")) {
        die('Unable to prepare user activation: ' . htmlspecialchars($conn->error));
    }
    $hasActiveColumn = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'reservation_status') {
        $status = $_POST['status'] ?? '';
        $reservationId = (int)($_POST['reservation_id'] ?? 0);
        $allowedStatuses = ['confirmed', 'rejected', 'cancelled'];
        if (in_array($status, $allowedStatuses, true) && $reservationId > 0) {
            $statement = $conn->prepare('UPDATE reservations SET status = ? WHERE id = ?');
            $statement->bind_param('si', $status, $reservationId);
            $statement->execute();
            $statement->close();
        }
    } elseif ($action === 'user_status') {
        $active = (int)($_POST['is_active'] ?? 0);
        $userId = (int)($_POST['user_id'] ?? 0);
        if ($userId > 0 && in_array($active, [0, 1], true)) {
            $statement = $conn->prepare('UPDATE users SET is_active = ? WHERE id = ? AND role <> "admin"');
            $statement->bind_param('ii', $active, $userId);
            $statement->execute();
            $statement->close();
        }
    } elseif ($action === 'add_slot') {
        $date = $_POST['slot_date'] ?? '';
        $start = $_POST['start_time'] ?? '';
        $end = $_POST['end_time'] ?? '';
        $capacity = (int)($_POST['capacity'] ?? 0);
        if ($date !== '' && $start !== '' && $end !== '' && $capacity > 0) {
            $statement = $conn->prepare('INSERT INTO time_slots (slot_date, start_time, end_time, capacity) VALUES (?, ?, ?, ?)');
            $statement->bind_param('sssi', $date, $start, $end, $capacity);
            $statement->execute();
            $statement->close();
        }
    } elseif ($action === 'delete_slot') {
        $slotId = (int)($_POST['slot_id'] ?? 0);
        if ($slotId > 0) {
            $statement = $conn->prepare("DELETE FROM time_slots WHERE id = ? AND NOT EXISTS (
                SELECT 1 FROM reservations WHERE reservations.slot_id = time_slots.id
                AND reservations.status IN ('pending', 'confirmed')
            )");
            $statement->bind_param('i', $slotId);
            $statement->execute();
            $statement->close();
        }
    }

    header('Location: admin_page.php');
    exit();
}

$adminName = $_SESSION['username'] ?? 'Administrator';
$search = trim($_GET['search'] ?? '');
$statusFilter = $_GET['status'] ?? '';

$reservationWhere = [];
$reservationParams = [];
$reservationTypes = '';
if ($search !== '') {
    $reservationWhere[] = '(u.username LIKE ? OR u.email LIKE ?)';
    $reservationParams[] = "%$search%";
    $reservationParams[] = "%$search%";
    $reservationTypes .= 'ss';
}
if (in_array($statusFilter, ['pending', 'confirmed', 'rejected', 'cancelled'], true)) {
    $reservationWhere[] = 'r.status = ?';
    $reservationParams[] = $statusFilter;
    $reservationTypes .= 's';
}
$whereSql = $reservationWhere ? 'WHERE ' . implode(' AND ', $reservationWhere) : '';
$reservationQuery = "SELECT r.id, r.status, r.created_at, u.username, u.email,
    ts.slot_date, ts.start_time, ts.end_time
    FROM reservations r
    JOIN users u ON u.id = r.user_id
    JOIN time_slots ts ON ts.id = r.slot_id
    $whereSql ORDER BY ts.slot_date DESC, ts.start_time DESC";
$reservationStatement = $conn->prepare($reservationQuery);
if ($reservationParams) {
    $reservationStatement->bind_param($reservationTypes, ...$reservationParams);
}
$reservationStatement->execute();
$reservations = $reservationStatement->get_result();

$stats = ['total' => 0, 'pending' => 0, 'confirmed' => 0, 'users' => 0];
$statsResult = $conn->query("SELECT
    COUNT(*) AS total,
    SUM(status = 'pending') AS pending,
    SUM(status = 'confirmed') AS confirmed
    FROM reservations");
if ($statsResult) {
    $stats = array_merge($stats, $statsResult->fetch_assoc());
}
$userCount = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role <> 'admin'");
if ($userCount) {
    $stats['users'] = $userCount->fetch_assoc()['total'];
}

$chartResult = $conn->query("SELECT status, COUNT(*) AS total FROM reservations GROUP BY status");
$chartData = ['pending' => 0, 'confirmed' => 0, 'rejected' => 0, 'cancelled' => 0];
if ($chartResult) {
    while ($row = $chartResult->fetch_assoc()) {
        $chartData[$row['status']] = (int)$row['total'];
    }
}

$users = $conn->query("SELECT id, username, email, is_active FROM users WHERE role <> 'admin' ORDER BY username");
$slots = $conn->query("SELECT ts.id, ts.slot_date, ts.start_time, ts.end_time, ts.capacity,
    SUM(r.status IN ('pending', 'confirmed')) AS reserved
    FROM time_slots ts LEFT JOIN reservations r ON r.slot_id = ts.id
    GROUP BY ts.id ORDER BY ts.slot_date, ts.start_time");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Louvre Museum</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="dashboard">
    <aside class="sidebar">
        <a class="brand" href="admin_page.php"><span class="brand-mark">M</span><span>LOUVRE PARIS</span></a>
        <nav class="sidebar-nav" aria-label="Admin navigation">
            <a class="nav-link active" href="#overview"><span class="nav-icon">⌂</span>Overview</a>
            <a class="nav-link" href="#reservations"><span class="nav-icon">▤</span>Reservations</a>
            <a class="nav-link" href="#users"><span class="nav-icon">♙</span>Users</a>
            <a class="nav-link" href="#slots"><span class="nav-icon">◷</span>Time slots</a>
        </nav>
        <a class="logout-link" href="../BackEnd/pages/login.php"><span class="nav-icon">↪</span>Log out</a>
    </aside>

    <main class="main-content">
        <header class="topbar">
            <div><p class="eyebrow">Museum administration</p><h1>Good morning, <?= htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8') ?></h1></div>
            <div class="profile-badge"><span class="avatar"><?= strtoupper(substr($adminName, 0, 1)) ?></span><span><strong><?= htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8') ?></strong><small>Administrator</small></span></div>
        </header>

        <section id="overview" class="welcome-banner">
            <div><p class="eyebrow">Dashboard overview</p><h2>Keep the museum experience exceptional.</h2><p>Monitor reservations, visitors, and available time slots.</p></div>
            <span class="banner-symbol">✦</span>
        </section>

        <section class="stats-grid" aria-label="Dashboard statistics">
            <article class="stat-card"><span class="stat-label">Total reservations</span><strong><?= (int)$stats['total'] ?></strong><span class="stat-change">All reservations</span></article>
            <article class="stat-card"><span class="stat-label">Pending reservations</span><strong><?= (int)$stats['pending'] ?></strong><span class="stat-change warning">Needs attention</span></article>
            <article class="stat-card"><span class="stat-label">Confirmed reservations</span><strong><?= (int)$stats['confirmed'] ?></strong><span class="stat-change positive">Ready for tours</span></article>
            <article class="stat-card"><span class="stat-label">Registered users</span><strong><?= (int)$stats['users'] ?></strong><span class="stat-change">Visitor accounts</span></article>
        </section>

        <section class="content-grid">
            <article class="panel chart-panel">
                <div class="panel-heading"><div><p class="eyebrow">Reservation status</p><h2>Reservations overview</h2></div></div>
                <div class="chart-container"><canvas id="reservationChart"></canvas></div>
            </article>
            <article id="slots" class="panel">
                <div class="panel-heading"><div><p class="eyebrow">Availability</p><h2>Add time slot</h2></div></div>
                <form class="slot-form" method="POST">
                    <input type="hidden" name="action" value="add_slot">
                    <label>Date<input type="date" name="slot_date" required></label>
                    <div class="form-row"><label>Start time<input type="time" name="start_time" required></label><label>End time<input type="time" name="end_time" required></label></div>
                    <label>Capacity<input type="number" name="capacity" min="1" required placeholder="Maximum visitors"></label>
                    <button type="submit">Add time slot</button>
                </form>
            </article>
        </section>

        <section id="reservations" class="panel full-panel">
            <div class="panel-heading"><div><p class="eyebrow">Management</p><h2>All reservations</h2></div></div>
            <form class="filters" method="GET">
                <input type="search" name="search" value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>" placeholder="Search by name or email">
                <select name="status"><option value="">All statuses</option><?php foreach (['pending', 'confirmed', 'rejected', 'cancelled'] as $status): ?><option value="<?= $status ?>" <?= $statusFilter === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option><?php endforeach; ?></select>
                <button type="submit">Filter</button><a class="clear-filter" href="admin_page.php">Clear</a>
            </form>
            <div class="table-wrapper"><table><thead><tr><th>Visitor</th><th>Time slot</th><th>Status</th><th>Actions</th></tr></thead><tbody>
            <?php if ($reservations->num_rows === 0): ?><tr><td colspan="4" class="empty-state">No reservations found.</td></tr><?php endif; ?>
            <?php while ($reservation = $reservations->fetch_assoc()): ?>
                <tr><td><strong><?= htmlspecialchars($reservation['username'], ENT_QUOTES, 'UTF-8') ?></strong><small><?= htmlspecialchars($reservation['email'], ENT_QUOTES, 'UTF-8') ?></small></td><td><?= htmlspecialchars($reservation['slot_date']) ?><small><?= substr($reservation['start_time'], 0, 5) ?> - <?= substr($reservation['end_time'], 0, 5) ?></small></td><td><span class="status <?= htmlspecialchars($reservation['status']) ?>"><?= ucfirst($reservation['status']) ?></span></td><td class="action-buttons"><?php foreach (['confirmed' => 'Confirm', 'rejected' => 'Reject', 'cancelled' => 'Cancel'] as $value => $label): ?><form method="POST"><input type="hidden" name="action" value="reservation_status"><input type="hidden" name="reservation_id" value="<?= (int)$reservation['id'] ?>"><input type="hidden" name="status" value="<?= $value ?>"><button class="small-button <?= $value ?>" type="submit"><?= $label ?></button></form><?php endforeach; ?></td></tr>
            <?php endwhile; ?>
            </tbody></table></div>
        </section>

        <section id="users" class="panel full-panel">
            <div class="panel-heading"><div><p class="eyebrow">Access control</p><h2>Manage users</h2></div></div>
            <div class="table-wrapper"><table><thead><tr><th>User</th><th>Status</th><th>Action</th></tr></thead><tbody>
            <?php while ($user = $users->fetch_assoc()): ?><tr><td><strong><?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') ?></strong><small><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></small></td><td><span class="status <?= $user['is_active'] ? 'confirmed' : 'cancelled' ?>"><?= $user['is_active'] ? 'Active' : 'Deactivated' ?></span></td><td><form method="POST"><input type="hidden" name="action" value="user_status"><input type="hidden" name="user_id" value="<?= (int)$user['id'] ?>"><input type="hidden" name="is_active" value="<?= $user['is_active'] ? 0 : 1 ?>"><button class="small-button <?= $user['is_active'] ? 'cancelled' : 'confirmed' ?>" type="submit"><?= $user['is_active'] ? 'Deactivate' : 'Activate' ?></button></form></td></tr><?php endwhile; ?>
            </tbody></table></div>
        </section>

        <section class="panel full-panel">
            <div class="panel-heading"><div><p class="eyebrow">Schedule</p><h2>Time slots</h2></div></div>
            <div class="table-wrapper"><table><thead><tr><th>Date</th><th>Time</th><th>Capacity</th><th>Action</th></tr></thead><tbody>
            <?php while ($slot = $slots->fetch_assoc()): ?><tr><td><?= htmlspecialchars($slot['slot_date']) ?></td><td><?= substr($slot['start_time'], 0, 5) ?> - <?= substr($slot['end_time'], 0, 5) ?></td><td><?= (int)$slot['reserved'] ?> / <?= (int)$slot['capacity'] ?></td><td><form method="POST"><input type="hidden" name="action" value="delete_slot"><input type="hidden" name="slot_id" value="<?= (int)$slot['id'] ?>"><button class="small-button cancelled" type="submit" <?= $slot['reserved'] > 0 ? 'disabled title="Slots with pending or confirmed reservations cannot be deleted"' : '' ?>>Delete</button></form></td></tr><?php endwhile; ?>
            </tbody></table></div>
        </section>
    </main>
</div>
<script>
new Chart(document.getElementById('reservationChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Confirmed', 'Rejected', 'Cancelled'],
        datasets: [{ data: [<?= $chartData['pending'] ?>, <?= $chartData['confirmed'] ?>, <?= $chartData['rejected'] ?>, <?= $chartData['cancelled'] ?>], backgroundColor: ['#d9a65f', '#789b78', '#b47770', '#b9aa9a'], borderWidth: 0 }]
    },
    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { padding: 18, usePointStyle: true } } } }
});
</script>
</body>
</html>
