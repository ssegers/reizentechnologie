<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Carbon\Carbon;

use App\Models\Trip;
use App\Models\Traveller;

class TripQuery extends Query
{
    protected $attributes = [
        'name' => 'trip',
        'description' => 'A query to retrieve all information about the trip, including hotels'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('trip'));
    }

    public function args(): array
    {
        return [
            'traveller_id' => ['name' => 'traveller_id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        //dd($args['traveller_id']);
        //$t = Traveller::where("traveller_id", $args['traveller_id'])->get();
        //dd($t->trips());
        return Trip::where('trip_id', 1)->get();
        //return Trip::all();
    }
}
