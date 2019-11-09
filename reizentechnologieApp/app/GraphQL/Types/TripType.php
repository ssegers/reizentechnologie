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
            ]
        ];
    }
}
