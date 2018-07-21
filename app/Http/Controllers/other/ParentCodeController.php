<?php

namespace App\Http\Controllers\other;

use Illuminate\Http\Request;
use App\models\FriendList;
use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Support\Facades\DB;

class ParentCodeController extends ApiController
{
    public function add(Request $request)
    {
        $this->validate($request, ['uid' => 'required', 'token' => 'required', 'parent_code' => 'required']);

        $user = User::select('id')->where('uniq_id', $request->parent_code)->first();

        if (isset($user->id)) {

            if ($request->uid == $user->id) {
                return $this->errorResponse('Not allowed to add own parent code, please try with another.');
            }

            if (FriendList::where('user_id', $request->uid)->exists()) {
                return $this->errorResponse('Parent code already exists.');
            }

            $data = $request->all();
            $data['user_id'] = $request->uid;
            $data['friend_id'] = $user->id;
            $res = FriendList::create($data);
            return $this->successResponse($res);
        } else {
            return $this->errorResponse('Invalid parnt code : ' . $request->parent_code);
        }
    }

    public function list(Request $request)
    {
        $this->validate($request, ['uid' => 'required', 'token' => 'required']);

        $res = DB::table('users')
            ->join('friend_lists', 'users.id', '=', 'friend_lists.user_id')
            ->where('friend_lists.friend_id', $request->uid)
            ->select('users.name', 'users.email', 'users.phone')
            ->get();

        if (isset($res) && count($res) > 0) {
            return $this->successResponse($res);
        }

        return $this->errorResponse('U don\'t have any friends.');
    }
}
