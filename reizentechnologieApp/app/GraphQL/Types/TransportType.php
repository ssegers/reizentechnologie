<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Transport;

class TransportType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Transport',
        'description' => 'A type',
        'model' => Transport::class
    ];

    public function fields(): array
    {
        return [
            'trip_id' => [
                'type' => Type::integer(),
                'description' => 'trip id',
            ],
            'driver_id' => [
                'type' => Type::integer(),
                'description' => 'driver id',
            ],
            'size' => [
                'type' => Type::integer(),
                'description' => 'size of car/bus',
            ],
        ];
    }
}
