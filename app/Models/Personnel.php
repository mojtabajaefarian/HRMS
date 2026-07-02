<?php
declare(strict_types=1);
namespace App\Models;

class Personnel extends BaseModel {
    public function all(): array {
        return $this->db->query("
            SELECT p.*,
                   COALESCE(c.name,'') category_name,
                   COALESCE(t.name,'') team_name
            FROM personnel p
            LEFT JOIN categories c ON c.id = p.category_id
            LEFT JOIN teams t ON t.id = p.team_id
            ORDER BY p.id DESC
        ")->fetchAll();
    }

    public function find(int $id): ?array {
        $s = $this->db->prepare("
            SELECT p.*,
                   COALESCE(c.name,'') category_name,
                   COALESCE(t.name,'') team_name
            FROM personnel p
            LEFT JOIN categories c ON c.id = p.category_id
            LEFT JOIN teams t ON t.id = p.team_id
            WHERE p.id=:id LIMIT 1
        ");
        $s->execute(['id' => $id]);
        $r = $s->fetch();
        return $r ?: null;
    }

    public function create(array $d): int {
        $stmt = $this->db->prepare("
            INSERT INTO personnel
            (personnel_code,row_no,full_name,national_code,mobile,category_id,team_id,file_status,completion_percent,last_updated_at,notes)
            VALUES
            (:personnel_code,:row_no,:full_name,:national_code,:mobile,:category_id,:team_id,:file_status,:completion_percent,NOW(),:notes)
        ");
        $stmt->execute([
            'personnel_code' => $d['personnel_code'],
            'row_no' => ($d['row_no'] === '' ? null : $d['row_no']),
            'full_name' => $d['full_name'],
            'national_code' => $d['national_code'],
            'mobile' => $d['mobile'],
            'category_id' => ($d['category_id'] === '' ? null : $d['category_id']),
            'team_id' => ($d['team_id'] === '' ? null : $d['team_id']),
            'file_status' => $d['file_status'],
            'completion_percent' => (int)$d['completion_percent'],
            'notes' => $d['notes'],
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function deficiencies(int $id): array {
        $s = $this->db->prepare("SELECT * FROM personnel_deficiencies WHERE personnel_id=:id ORDER BY id DESC");
        $s->execute(['id' => $id]);
        return $s->fetchAll();
    }
    public function followups(int $id): array {
        $s = $this->db->prepare("SELECT * FROM personnel_followups WHERE personnel_id=:id ORDER BY followup_at DESC, id DESC");
        $s->execute(['id' => $id]);
        return $s->fetchAll();
    }
    public function actions(int $id): array {
        $s = $this->db->prepare("SELECT * FROM personnel_actions WHERE personnel_id=:id ORDER BY action_at DESC, id DESC");
        $s->execute(['id' => $id]);
        return $s->fetchAll();
    }
    public function positions(int $id): array {
        $s = $this->db->prepare("
            SELECT pp.*, pos.name AS position_name
            FROM personnel_positions pp
            LEFT JOIN positions pos ON pos.id=pp.position_id
            WHERE pp.personnel_id=:id
            ORDER BY pp.id ASC
        ");
        $s->execute(['id' => $id]);
        return $s->fetchAll();
    }

    public function addDeficiency(int $id, array $d): void {
        $s = $this->db->prepare("
            INSERT INTO personnel_deficiencies
            (personnel_id,deficiency_title,deficiency_description,deficiency_status,due_at,created_at)
            VALUES (:id,:t,:d,:s,:due,NOW())
        ");
        $s->execute([
            'id' => $id, 't' => $d['deficiency_title'], 'd' => $d['deficiency_description'],
            's' => $d['deficiency_status'], 'due' => ($d['due_at'] === '' ? null : $d['due_at'])
        ]);
    }
    public function addFollowup(int $id, array $d): void {
        $s = $this->db->prepare("
            INSERT INTO personnel_followups
            (personnel_id,followup_text,followup_status,followup_at,result_text,created_at)
            VALUES (:id,:t,:s,:at,:r,NOW())
        ");
        $s->execute(['id'=>$id,'t'=>$d['followup_text'],'s'=>$d['followup_status'],'at'=>$d['followup_at'],'r'=>$d['result_text']]);
    }
    public function addAction(int $id, array $d): void {
        $s = $this->db->prepare("
            INSERT INTO personnel_actions
            (personnel_id,action_title,action_description,action_status,action_at,result_text,created_at)
            VALUES (:id,:t,:d,:s,:at,:r,NOW())
        ");
        $s->execute(['id'=>$id,'t'=>$d['action_title'],'d'=>$d['action_description'],'s'=>$d['action_status'],'at'=>$d['action_at'],'r'=>$d['result_text']]);
    }
    public function syncPositions(int $id, array $positionIds): void {
        $this->db->prepare("DELETE FROM personnel_positions WHERE personnel_id=:id")->execute(['id'=>$id]);
        $positionIds = array_slice(array_values(array_unique(array_filter(array_map('intval', $positionIds)))), 0, 5);
        $s = $this->db->prepare("INSERT INTO personnel_positions (personnel_id,position_id) VALUES (:pid,:pos)");
        foreach ($positionIds as $p) $s->execute(['pid'=>$id,'pos'=>$p]);
    }
}
