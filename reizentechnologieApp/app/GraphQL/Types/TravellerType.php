<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Traveller;

class TravellerType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Traveller',
        'description' => 'A type',
        'model' => Traveller::class,
    ];

    public function fields(): array
    {
        return [
            'first_name' => [
                'type' => Type::string(),
                'description' => 'traveller firstname',
            ],
            'last_name' => [
                'type' => Type::string(),
                'description' => 'traveller lastname',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'traveller email',
            ],
            'country' => [
                'type' => Type::string(),
                'description' => 'traveller country',
            ],
            'address' => [
                'type' => Type::string(),
                'description' => 'traveller address',
            ],
            'gender' => [
                'type' => Type::string(),
                'description' => 'traveller gender',
            ],
            'phone' => [
                'type' => Type::string(),
                'description' => 'traveller phone',
            ],
            'emergency_phone_1' => [
                'type' => Type::string(),
                'description' => 'traveller emergency phone 1',
            ],
            'emergency_phone_2' => [
                'type' => Type::string(),
                'description' => 'traveller emergency phone 2',
            ],
            'nationality' => [
                'type' => Type::string(),
                'description' => 'traveller nationality',
            ],
            'birthdate' => [
                'type' => Type::string(),
                'description' => 'traveller birthdate',
            ],
            'birthplace' => [
                'type' => Type::string(),
                'description' => 'traveller birthplace',
            ],
            'medical_issue' => [
                'type' => Type::string(),
                'description' => 'traveller medical issue',
            ],
            'medical_info' => [
                'type' => Type::string(),
                'description' => 'traveller medical info',
            ],
            'major' => [
                'type' => GraphQL::type('major'),
                'description' => 'traveller major',
            ],
        ];
    }
}
