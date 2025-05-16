<?php

class zone_stockController extends Controller
{
    public function index(): void
    {
        $zone_stocks = $this->zone_stock->findAll();
        $this->set(compact("zone_stocks"));
        $this->render();
    }

    public function add(): void
    {
        if ($_POST) {
            $this->zone_stock->create($_POST);
            $this->redirect("/zone_stock/index");
            return;
        }
        $this->render();
    }

    public function delete($id): void
    {
        try {
            $this->zone_stock->delete($id);
        } catch (PDOException $e) {
            $this->render("error");
            return;
        }
        $this->redirect("/zone_stock/index");
    }

    public function edit($id): void
    {
        $zone_stock = $this->zone_stock->find(["WHERE" => ["id" => $id]]);
        if ($_POST) {
            $this->zone_stock->update($_POST, $id);
            $this->redirect("/zone_stock/index");
            return;
        }
        $this->set(compact("zone_stock"));
        $this->render();
    }
}