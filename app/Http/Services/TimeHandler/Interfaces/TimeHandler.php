<?php

namespace App\Http\Services\TimeHandler\Interfaces;

interface TimeHandler {
    public function setNext(TimeHandler $handler): TimeHandler;

    public function handle(string $timestamp,array $expressions): ?array;
}
