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

    public function add(): void
    {
        $this->loadModel("zone_stock");
        $zone_stocks = $this->zone_stock->findAll(["COLUMN" => ["id", "libelle"]]);

        if ($_POST) {
            $data = [
                "name" => $_POST["name"],
                "prix_ht" => $_POST["prix_ht"],
                "taux_tva" => $_POST["taux_tva"],
                "id_zone_stock" => $_POST["id_zone_stock"],
            ];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $random_name = uniqid() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $data['image'] = $random_name;
                move_uploaded_file($_FILES['image']['tmp_name'], PUBLIQUE . "/images/" . $random_name);
            }

            $id = $this->product->create($data);
            $this->redirect("/product/view/$id");
            return;
        }

        $this->set(compact("zone_stocks"));
        $this->render();
    }

    public function edit(int $id): void
    {
        $this->loadModel("zone_stock");
        $zone_stocks = $this->zone_stock->findAll(["COLUMN" => ["id", "libelle"]]);

        if ($_POST) {
            $data = [
                "name" => $_POST["name"],
                "prix_ht" => $_POST["prix_ht"],
                "taux_tva" => $_POST["taux_tva"],
                "id_zone_stock" => $_POST["id_zone_stock"],
            ];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $random_name = uniqid() . "." . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $data['image'] = $random_name;
                move_uploaded_file($_FILES['image']['tmp_name'], PUBLIQUE . "/images/" . $random_name);
            }

            $image = $this->product->find([
                "COLUMN" => ["image"],
                "WHERE" => [
                    "id" => $id
                ]
            ])["image"];
            // delete old image if image is changed
            if (isset($data['image']) && $data['image'] != $image) {
                if (file_exists(PUBLIQUE . "/images/" . $image)) {
                    unlink(PUBLIQUE . "/images/" . $image);
                }
            }



            $this->product->update($data, $id);
            $this->redirect("/product/view/$id");
            return;
        }

        $product = $this->product->find([
            "WHERE" => [
                "id" => $id
            ]
        ]);

        if (!$product) {
            throw new Exception("Produit introuvable");
        }

        $this->set(compact("product", "zone_stocks"));
        $this->render();
    }

    public function delete(int $id): void
    {
        $image = $this->product->find([
            "COLUMN" => ["image"],
            "WHERE" => [
                "id" => $id
            ]
        ])["image"];
        $this->product->delete($id);
        // delete image
        if (file_exists(PUBLIQUE . "/images/" . $image)) {
            unlink(PUBLIQUE . "/images/" . $image);
        }
        $this->redirect("/product/index");
    }

    public function view(int $id): void
    {
        $product = $this->product->find([
            "WHERE" => [
                "id" => $id
            ]
        ]);

        $this->loadModel("zone_stock");
        $zone_stocks = $this->zone_stock->findAll(["COLUMN" => ["id", "libelle"]]);

        foreach ($zone_stocks as $zs) {
            if ($product["id_zone_stock"] == $zs["id"]) {
                $product["id_zone_stock"] = $zs["libelle"];
            }
        }

        if (!$product) {
            throw new Exception("Produit introuvable");
        }

        $this->set(compact("product", "zone_stocks"));
        $this->render();
    }
}