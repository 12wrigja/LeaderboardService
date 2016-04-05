<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\User;

class LeaderboardTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var  array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var  array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var  object
     */
    public function transform($resource)
    {
        if($resource->user_id != null){
            $username = User::find($resource->user_id)->username;
        } else {
            $username = 'ANONYMOUS';
        }
        return [
            'score'=>$resource->score,
            'username'=>$username,
            'uploaded_at'=>$resource->created_at->toDateTimeString(),
            'match_type'=>$resource->match_type
        ];
    }

}
