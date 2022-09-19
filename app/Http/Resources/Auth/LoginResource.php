<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Staff\StaffResource;
use App\Http\Resources\User\UserResource;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $key = config("jwt.key");

        if ($user = User::where(["uuid" => $this->uuid])->first()) {
            $user_resource = new UserResource($this);
        } else if ($user = Admin::where(["uuid" => $this->uuid])->first()) {
            $user_resource = new AdminResource($this);
        } else if ($user = Staff::where(["uuid" => $this->uuid])->first()) {
            $user_resource = new StaffResource($this);
        }

        $payload = [
            'iss' => config("jwt.iss"),
            'aud' => config("jwt.aud"),
            'iat' => time(),
            'nbf' => time(),
            "exp" => time() + 60 * 60 * 6,
            'user' => $user
        ];

        $jwt = JWT::encode($payload, $key, 'HS256');

        return [
            "token" => $jwt,
            "user" => $user_resource
        ];
    }
}
