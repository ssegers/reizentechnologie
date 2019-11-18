<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Room;

class RoomType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Room',
        'description' => 'A type',
        'model' => Room::class,
    ];

    public function fields(): array
    {
        return [
            'room_id' => [
                'type' => Type::string(),
                'description' => 'room id',
            ],
        ];
    }
}
