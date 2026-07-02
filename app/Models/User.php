<?php
declare(strict_types=1);
namespace App\Models;

class User extends BaseModel {
    public function findByUsername(string $u): ?array {
        $s = $this->db->prepare('SELECT * FROM users WHERE username=:u LIMIT 1');
        $s->execute(['u' => $u]);
        $r = $s->fetch();
        return $r ?: null;
    }
}
