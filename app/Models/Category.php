<?php
declare(strict_types=1);
namespace App\Models;
class Category extends BaseModel { public function all(): array { return $this->db->query("SELECT id,name FROM categories WHERE is_active=1 ORDER BY name")->fetchAll(); } }
