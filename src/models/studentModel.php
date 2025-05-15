<?php

class student extends Model {

    protected function __init(): void
    {
        $this->table = "students";
        $this->fields = ["id", "age", "lastname", "firstname", "email"];
        $this->externalFields = ["id"=>"note.student_id"];
        $this->primaryKey = "id";
    }

    public function info($id): array|false
    {
        $stmt = $this->requester->select([
                "WHERE" => [
                    "students.id" => $id
                ],
            ]);


        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->requester->update([
            "DATA" => [
                "age" => $data["age"],
                "lastname" => $data["lastname"],
                "surname" => $data["surname"],
                "email" => $data["email"]
            ],
            "WHERE" => [
                "id" => $id
            ]
        ]);
        $stmt->execute();
    }
}