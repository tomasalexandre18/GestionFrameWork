<?php


class StudentController extends Controller {

    public function index(): void
    {
        $data = $this->student->findAll();
        $this->set(compact("data"));
        $this->render();
    }

    public function info(string $id): void
    {
        $this->loadModel("note");
        $data = $this->student->info($id);
        $notes = $this->note->getNoteByStudentId($id);
        $this->set(compact("data"));
        $this->set(compact("notes"));
        $this->render();
    }

    public function delete(string $id): void
    {
        $this->loadModel("note");
        $this->student->delete($id);
        $this->redirect("/student/index");
    }

    public function add(bool $successes = false): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $this->student->create($_POST);
            $this->redirect("/student/info/".$id);
            return;
        }
        $this->render();
    }

    public function edit(string $id, bool $successes = false): void
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->student->update($id, $_POST);
            $this->redirect("/student/edit/".$id."/true");
            return;
        }
        $data = $this->student->find(compact("id"));
        $this->set(compact("data"));
        $this->set(compact("successes"));
        $this->render();
    }
}