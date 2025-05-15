<?php

class noteController extends Controller {

    function add($id) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->note->add($id, $_POST);
            $this->redirect("/student/info/".$id);
            return;
        }
        // $id is the student id

        $this->set(compact("id"));
        $this->render();
    }

    function delete($id_student, $id_note) {
        $this->note->delete($id_note);
        $this->redirect("/student/info/".$id_student);
    }

    function edit($id_student, $id_note) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->note->update($id_note, $_POST);
            $this->redirect("/student/info/".$id_student);
            return;
        }
        $data = $this->note->find(["id"=>$id_note]);
        $this->set(compact("data"));
        $this->set(compact("id_student"));
        $this->set(compact("id_note"));
        $this->render();
    }

}
