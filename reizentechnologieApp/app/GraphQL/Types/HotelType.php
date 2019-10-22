<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

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
            'hotel_address' => [
                'type' => Type::string(),
                'description' => 'hotel address',
            ],
            'hotel_phone' => [
                'type' => Type::string(),
                'description' => 'hotel phone',
            ],
        ];
    }
}
