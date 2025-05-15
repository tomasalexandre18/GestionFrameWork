<?php

class product extends Model
{
    protected function __init(): void
    {
        $this->table = "product";
        $this->fields = ["id", "name", "prix_ht", "prix_ttc", "taux_tva", "id_zone_stock", "image"];
        $this->externalFields = ["id_zone_stock" => "zone_stock.id"];
        $this->primaryKey = "id";
    }
}
