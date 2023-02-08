<?php

namespace App\Jobs;

use App\Models\Fruit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FruitImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //would probably be in .env in production
    private string $fruitApiUrl = 'https://dev.shepherds-mountain.appoly.io/fruit.json';

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get($this->fruitApiUrl);

        $fruits = json_decode($response->body());

        $this->saveFruit(get_object_vars($fruits)['menu_items']);
    }


    protected function saveFruit($fruits, $parentId = null)
    {
        foreach ($fruits as $fruit) {
            $newFruit = Fruit::where('original_name', $fruit->label)->first();

            if (!$newFruit) {
                $newFruit = Fruit::create([
                    'name' => $fruit->label,
                    'original_name' => $fruit->label,
                    'parent_id' => $parentId,
                ]);
            }

            if (!empty($fruit->children)) {
                $this->saveFruit($fruit->children, $newFruit->id);
            }
        }
    }
}
