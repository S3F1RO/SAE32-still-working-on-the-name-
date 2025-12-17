<?php

class Order implements JsonSerializable {
    private array $items = [];
    
    public function addItem(string $name, float $price): void {
        $this->items[] = ['name' => $name, 'price' => $price];
    }
    
    public function jsonSerialize(): mixed {
        return [
            'items' => $this->items,
            'total' => $this->getTotal(),
            'count' => count($this->items)
        ];
    }
    
    private function getTotal(): float {
        return array_sum(array_column($this->items, 'price'));
    }
}

$order = new Order();
$order->addItem("Book", 19.99);
$order->addItem("Pen", 1.99);

// $json = json_encode($order);
$json = json_encode($order, JSON_PRETTY_PRINT);
echo $json;

?>