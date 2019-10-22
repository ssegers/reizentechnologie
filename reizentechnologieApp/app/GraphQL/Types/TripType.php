<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Trip;

class TripType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Trip',
        'description' => 'A type',
        'model' => Trip::class,
    ];

    public function fields(): array
    {
        return [
            'trip_name' => [
                'type' => Type::string(),
                'description' => 'trip name',
            ],
        ];
    }
}
