<?php

class note extends Model
{
    protected function __init(): void
    {
        $this->table = "note";
        $this->fields = ["id", "student_id", "note"];
        $this->externalFields = [];
        $this->primaryKey = "id";
    }

    public function deleteStudentId(int $id) {
        $stmt = $this->requester->delete([
            "WHERE" => [
                "student_id" => $id
            ]
        ]);
        $stmt->execute();
    }

    public function getNoteByStudentId(int $id) {
        $stmt = $this->requester->select([
            "WHERE"=>[
                "student_id"=>$id
            ]
        ]);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add(int $id, array $data) {
        $stmt = $this->requester->insert([
            "student_id" => $id,
            "mat" => $data["mat"],
            "note" => $data["note"]
        ]);
        $stmt->execute();
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->requester->update([
            "DATA" => [
                "mat" => $data["mat"],
                "note" => $data["note"]
            ],
            "WHERE" => [
                "id" => $id
            ]
        ]);
        $stmt->execute();
    }
}