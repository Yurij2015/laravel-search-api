<?php

namespace App\Services;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Collection;

class HotelsService
{
    public function hotelsSearch(): Collection
    {
        $result = Hotel::query();
        $price_to = request('price_to');
        $price_from = request('price_from');
        foreach (request()->all() as $key => $value) {
            if ($key === 'name') {
                $result->where($key, 'like', '%' . $value . '%');
            }
            if (!in_array($key, ['price_from', 'price_to', 'name'], true)) {
                $result->where($key, '=', $value);
            }
            if ($key === 'price_from' && !$price_to) {
                $result->where('price', '>', $value);
            }
            if ($key === 'price_from' && $price_to) {
                $result->whereBetween('price', [$value, request('price_to')]);
            }
            if ($key === 'price_to' && !$price_from) {
                $result->whereBetween('price', [0, $value]);
            }
        }
        return $result->get();
    }
}
