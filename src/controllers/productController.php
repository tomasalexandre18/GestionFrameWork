<?php

class productController extends Controller
{
    public function index(int $page = 1, int $limit = 10, int|string $zone_stock = "null", string $search = "null"): void
    {
        $WHERE = [];
        if ($zone_stock !== "null" && $search == "null") {
            $WHERE = [
                "id_zone_stock" => $zone_stock
            ];
        } elseif ($search !== "null" && $zone_stock == "null") {
            $WHERE['LIKE'] = [
                "name", "%$search%"
            ];
        } elseif ($search !== "null" && $zone_stock !== "null") {
            $WHERE = [
                "AND" => [[
                    "id_zone_stock" => $zone_stock
                ], [
                    "LIKE" => ["name", "%$search%"]
                ]]
            ];
        }

        $products = $this->product->findAll([
            "LIMIT" => $limit,
            "OFFSET" => ($page - 1) * $limit,
            "WHERE" => $WHERE,
        ]);

        $this->loadModel("zone_stock");
        $zone_stocks = $this->zone_stock->findAll(["COLUMN" => ["id", "libelle"]]);

        foreach ($products as &$product) {
            foreach ($zone_stocks as $zs) {
                if ($product["id_zone_stock"] == $zs["id"]) {
                    $product["id_zone_stock"] = $zs["libelle"];
                }
            }
        }

        if ($search == "null")
            $search = "";

        $nb_products = $this->product->count($WHERE);
        if ($nb_products != 0 && count($products) == 0) {
            $this->redirect("/product/index/1/$limit/$zone_stock/$search");
        }

        $this->set(compact("products", "zone_stocks", "page", "limit", "zone_stock", "search", "nb_products"));
        $this->render();
    }
}