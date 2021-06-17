<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;
class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
           'identifier'=>(int)$user->id,
           'name'=>(string)$user->name,
           'email'=>(string)$user->email,
           'isVerified'=>(int)$user->verified,
           'isAdmin'=>($user->admin==='true'),
           'creationDate'=>$user->created_at,
           'lastUpdated'=>$user->updated_at,
           'deleteDate'=>isset($user->deleted_at)?(string)$user->deleted_at:null,

        ];
    }

    public static function originalAttribute($index)
    {
        $attributes=[
           'identifier'=>'id',
           'name'=>'name',
           'email'=>'email',
           'isVerified'=>'verified',
           'isAdmin'=>'admin',
           'creationDate'=>'created_at',
           'lastUpdated'=>'updated_at',
           'deleteDate'=>'deleted_at',

        ];
        return isset($attributes[$index])?$attributes[$index]:null;
    }
}
