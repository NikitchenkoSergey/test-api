<?php
namespace App\Repositories;

use App\Models\Event;

/**
 * Shows Provider
 * @package App\Repositories
 */
class EventsRepository implements RepositoryInterface
{
    /**
     * @inheritdoc
     * @return Event[]
     */
    public function getModels(): array
    {
        $totalShowsCount = 15;

        $result = [];

        $counter = 0;
        for ($i = 1; $i <= $totalShowsCount; $i++) {
            for ($j = 1; $j <= 5; $j++) {
                $counter++;
                $result[$counter] = new Event($counter, $i, date('Y-m-d H:i:s', time() + 60 * (60 * $j) * (24 * $i)));
            }
        }

        return $result;
    }
}