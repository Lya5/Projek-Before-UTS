<?php

class Notification {
    private int $id;
    private int $userId;
    private string $title;
    private string $body;
    private bool $isRead;
    private string $createdAt;

    public function __construct(int $id, int $userId, string $title, string $body, bool $isRead, string $createdAt) {
        $this->id = $id;
        $this->userId = $userId;
        $this->title = $title;
        $this->body = $body;
        $this->isRead = $isRead;
        $this->createdAt = $createdAt;
    }

    public function getId(): int { return $this->id; }
    public function getUserId(): int { return $this->userId; }
    public function getTitle(): string { return $this->title; }
    public function getBody(): string { return $this->body; }
    public function isRead(): bool { return $this->isRead; }
    public function getCreatedAt(): string { return $this->createdAt; }

    // CREATE
    public static function create(int $userId, string $title, string $body): self {
        $db = new DBconnection();
        $sql = "INSERT INTO notifications (user_id, title, body) VALUES ($1, $2, $3) RETURNING *";
        $respon = $db->send_query($sql, [$userId, $title, $body]);

        if (!$respon->status || empty($respon->data)) {
            throw new Exception($respon->message);
        }

        $row = $respon->data[0];
        $isRead = ($row['is_read'] === 't' || $row['is_read'] === true || $row['is_read'] == 1);
        return new self((int)$row['id'], (int)$row['user_id'], $row['title'], $row['body'], $isRead, $row['created_at']);
    }

    public static function find(int $id): ?self {
        $db = new DBconnection();
        $sql = "SELECT * FROM notifications WHERE id = $1";
        $respon = $db->send_query($sql, [$id]);

        if (!$respon->status) {
            throw new Exception($respon->message);
        }

        if (empty($respon->data)) return null;

        $row = $respon->data[0];
        $isRead = ($row['is_read'] === 't' || $row['is_read'] === true || $row['is_read'] == 1);
        return new self((int)$row['id'], (int)$row['user_id'], $row['title'], $row['body'], $isRead, $row['created_at']);
    }

    public static function findByUser(int $userId): array {
        $db = new DBconnection();
        $sql = "SELECT * FROM notifications WHERE user_id = $1 ORDER BY id DESC";
        $respon = $db->send_query($sql, [$userId]);

        if (!$respon->status) {
            throw new Exception($respon->message);
        }

        $result = [];
        
        $rows = is_array($respon->data) ? $respon->data : [];
        foreach ($rows as $row) {
            $isRead = ($row['is_read'] === 't' || $row['is_read'] === true || $row['is_read'] == 1);
            $result[] = new self((int)$row['id'], (int)$row['user_id'], $row['title'], $row['body'], $isRead, $row['created_at']);
        }
        return $result;
    }

    public function update(string $title, string $body): void {
        $db = new DBconnection();
        $sql = "UPDATE notifications SET title = $1, body = $2 WHERE id = $3";
        $respon = $db->send_query($sql, [$title, $body, $this->id]);

        if (!$respon->status) {
            throw new Exception($respon->message);
        }

        $this->title = $title;
        $this->body = $body;
    }

    public function markAsRead(): void {
        $db = new DBconnection();
        $sql = "UPDATE notifications SET is_read = TRUE WHERE id = $1";
        $respon = $db->send_query($sql, [$this->id]);

        if (!$respon->status) {
            throw new Exception($respon->message);
        }

        $this->isRead = true;
    }

    public function delete(): void {
        $db = new DBconnection();
        $sql = "DELETE FROM notifications WHERE id = $1";
        $respon = $db->send_query($sql, [$this->id]);

        if (!$respon->status) {
            throw new Exception($respon->message);
        }
    }

    // METHOD TANTANGAN
    public static function unread(array $list): array {
        return array_values(array_filter($list, function(Notification $n) {
            return !$n->isRead();
        }));
    }

    public static function countUnread(array $list): int {
        return count(self::unread($list));
    }

    public function toString(): string {
        $status = $this->isRead ? "READ" : "UNREAD";
        return "[{$this->title}] - {$status}";
    }
}