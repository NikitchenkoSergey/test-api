<?php
namespace App\Repositories;


interface RepositoryInterface
{
    /**
     * Get models list
     * @return array
     */
    public function getModels(): array;
}