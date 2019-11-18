<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Hotel;

class HotelType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Hotel',
        'description' => 'A type',
        'model' => Hotel::class,
    ];

    public function fields(): array
    {
        return [
            'hotel_name' => [
                'type' => Type::string(),
                'description' => 'hotel name',
            ],
            'address' => [
                'type' => Type::string(),
                'description' => 'hotel address',
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'hotel phone',
            ],
            'type_of_accomodation' => [
                'type' => Type::string(),
                'description' => 'hotel phone',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'hotel phone',
            ],
            'website_link' => [
                'type' => Type::string(),
                'description' => 'hotel phone',
            ],
            'picture1_link' => [
                'type' => Type::string(),
                'description' => 'hotel phone',
            ],
            'picture2_link' => [
                'type' => Type::string(),
                'description' => 'hotel phone',
            ],
            'rooms' => [
                'type' => Type::listOf(GraphQL::type('room')),
                'description' => 'a list of all rooms in this hotel',
            ]
        ];
    }
}
