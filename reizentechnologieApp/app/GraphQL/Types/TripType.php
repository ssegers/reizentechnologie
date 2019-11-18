<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Facades\GraphQL;
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
            'name' => [
                'type' => Type::string(),
                'description' => 'trip name',
            ],
            'hotels' => [
                'type' => Type::listOf(GraphQL::type('hotel')),
                'description' => 'a list of all hotels on this trip',
            ],
            'travellers' => [
                'type' => Type::listOf(GraphQL::type('traveller')),
                'description' => 'a list of all travellers on this trip',
            ],
            'day_plannings' =>[
                'type' => Type::listof(GraphQl::type('day_planning')),
                'description' => 'a list of all the days on this trip',
            ],
            'activities' =>[
                'type' => Type::listof(GraphQl::type('activities')),
                'description' => 'an object of an activity',
            ],
            'transport' => [
                'type' => Type::listOf(GraphQL::type('transport')),
                'description' => 'a list of all cars/busses on this trip',
            ],
            'emergency_numbers' =>[
                'type' => Type::listOf(GraphQL::type('emergency_number')),
                'description' => 'a list of all the emergency numbers on this trip',
            ],
        ];
    }
}
