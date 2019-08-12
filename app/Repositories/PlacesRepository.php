<?php
namespace App\Repositories;

use App\Models\Place;

/**
 * Events Provider
 * @package App\Repositories
 */
class PlacesRepository implements RepositoryInterface
{
    /**
     * @inheritdoc
     * @return Place[]
     */
    public function getModels(): array
    {
        $rowCount = 10;
        $columnCount = 20;
        $margin = 10;
        $width = 20;
        $height = 20;

        $result = [];

        $counter = 0;
        for ($row = 0; $row < $rowCount; $row++) {
            for ($column = 0; $column < $columnCount; $column++) {
                $counter++;
                $currentLeftOffset = $row * ($margin + $width);
                $currentTopOffset = $column * ($margin + $height);
                $result[$counter] = new Place($counter, $currentLeftOffset, $currentTopOffset, $width, $height, ($counter % 5) != 0);
            }
        }

        return $result;
    }
}