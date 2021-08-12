<?php

namespace App\Http\Resources;

use App\Models\Admin;
use App\Models\Agency;
use App\Models\RoleAdmin;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $admin  = Admin::where('jss_id', $this->id)->first();
        if($admin) {
            $role   = RoleAdmin::find($admin->role_admin_id);
        }
        
        if($admin) {
            return [
                'id'        => $this->id,
                'fullname'  => $this->fullname,
                'username'  => $this->username,
                'admin'     => $admin,
                'role'      => $role->name
            ];
        } else {
            return [
                'id'        => $this->id,
                'fullname'  => $this->fullname,
                'username'  => $this->username,
            ];
        }
    }
}
