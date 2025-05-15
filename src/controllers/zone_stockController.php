<?php

class zone_stockController extends Controller
{
    public function getall(): void
    {
        $zone_stocks = $this->zone_stock->findAll();
        $this->json($zone_stocks);
    }
}