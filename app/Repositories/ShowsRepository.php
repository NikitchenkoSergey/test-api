<?php
namespace App\Repositories;

use App\Models\Show;

/**
 * Shows Provider
 * @package App\Repositories
 */
class ShowsRepository implements RepositoryInterface
{
    /**
     * @inheritdoc
     * @return Show[]
     */
    public function getModels(): array
    {
        $totalCount = 15;

        $result = [];

        for ($i = 1; $i <= $totalCount; $i++) {
            $result[$i] = new Show($i, "Show #{$i}");
        }

        return $result;
    }
}