<?php

class zone_stock extends Model
{
    protected function __init(): void
    {
        $this->table = "zone_stock";
        $this->fields = ["id", "libelle", "ville", "adresse", "code_postal"];
        $this->externalFields = [];
        $this->primaryKey = "id";
    }
}
