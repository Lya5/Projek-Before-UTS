<?php 
include_once("bootstrap.php"); 
require_once("Model/notification.php"); 

if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit; 
}

$user = $_SESSION['user']; 

$userId = $_SESSION['user']['iduser'] 
       ?? $_SESSION['user']['id'] 
       ?? $_SESSION['user']['user_id'] 
       ?? $_SESSION['user']['id_user'] 
       ?? 1; 

if (class_exists('Log')) {
    Log::catat("AKSES", [ 
        "email"  => $user['email'] ?? '', 
        "method" => $_SERVER['REQUEST_METHOD'], 
        "url"    => $_SERVER['REQUEST_URI'] 
    ]); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $act = $_POST['act'] ?? '';
    
    if ($act === 'create') {
        $title = trim($_POST['title'] ?? '');
        $body  = trim($_POST['body'] ?? '');
        if ($title !== '' && $body !== '' && $userId > 0) {
            Notification::create((int)$userId, $title, $body);
        }
    } 
    else {
        $notifId = (int)($_POST['notif_id'] ?? 0);
        $notif   = Notification::find($notifId);
        if ($notif && $notif->getUserId() == $userId) {
            if ($act === 'read') {
                $notif->markAsRead();
            }
            if ($act === 'del') {
                $notif->delete();
            }
        }
    }
    
    header("Location: dashboard.php"); 
    exit;
}

$notifications = Notification::findByUser((int)$userId);
$unreadCount   = Notification::countUnread($notifications);
?> 

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>

    <h1>Selamat datang, <?= htmlspecialchars($user['nama'] ?? 'User') ?></h1> 
    <p>Email: <?= htmlspecialchars($user['email'] ?? '-') ?></p>
    <p>Jenis akun: <strong><?= htmlspecialchars($_SESSION['jenis_user'] ?? 'User') ?></strong></p> 

    <?php if (isset($user['no_wa'])) { ?>
        <p>No. WhatsApp: <?= htmlspecialchars($user['no_wa']) ?></p>
        <p>Alamat: <?= htmlspecialchars($user['alamat']) ?></p>
    <?php } ?>

    <?php if (isset($user['no_izin'])) { ?>
        <p>No. Izin Praktik: <?= htmlspecialchars($user['no_izin']) ?></p>
        <p>Spesialisasi: <?= htmlspecialchars($user['spesialisasi']) ?></p>
    <?php } ?>

    <p><?= Konfigurasi::APP_NAME ?> versi <?= Konfigurasi::VERSI ?></p> 

    <p><a href="daftar_user.php" style="font-weight: bold;">Lihat Daftar Seluruh Pengguna</a></p>

    <hr>

    <h3>+ Tambah Notifikasi Baru (Uji Create)</h3>
    <form method="POST" style="margin-bottom: 20px;">
        <input type="hidden" name="act" value="create">
        <input type="text" name="title" placeholder="Judul Notif" required>
        <input type="text" name="body" placeholder="Isi Notif" required>
        <button type="submit">Kirim Notifikasi</button>
    </form>

    <hr>

    <h3>Daftar Notifikasi (Belum Dibaca: <?= $unreadCount ?>)</h3>

    <?php if (empty($notifications)): ?>
        <p>Belum ada notifikasi.</p>
    <?php endif; ?>

    <?php foreach ($notifications as $n): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 8px; border-radius: 4px;">
            <b><?= $n->toString() ?></b><br>
            <p style="margin: 5px 0;"><?= htmlspecialchars($n->getBody()) ?></p>
            <small>Dibuat: <?= $n->getCreatedAt() ?></small><br><br>
            
            <?php if (!$n->isRead()): ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="notif_id" value="<?= $n->getId() ?>">
                    <input type="hidden" name="act" value="read">
                    <button type="submit">Tandai Dibaca</button>
                </form>
            <?php endif; ?>

            <form method="POST" style="display:inline;">
                <input type="hidden" name="notif_id" value="<?= $n->getId() ?>">
                <input type="hidden" name="act" value="del">
                <button type="submit">Hapus</button>
            </form>
        </div>
    <?php endforeach; ?>

    <hr>
    <a href="logout.php">Logout</a>

</body>
</html>