<?php
declare(strict_types=1);
namespace App\Models;

class SimpleList extends BaseModel {
    public function all(string $table): array {
        $allowed = ['teams', 'categories', 'positions'];
        if (!in_array($table, $allowed, true)) return [];
        return $this->db->query("SELECT id, name FROM {$table} ORDER BY name")->fetchAll();
    }
}
