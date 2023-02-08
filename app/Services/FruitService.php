<?php

namespace App\Services;

use App\Models\Fruit;

final class FruitService
{
    public function updateNesting($fruits, $parent_id = null)
    {
        foreach ($fruits as $fruit) {
            Fruit::where('id', $fruit['id'])->update([
                'parent_id' => $parent_id
            ]);

            $this->updateNesting($fruit['children'], $fruit['id']);
        }
    }
}
