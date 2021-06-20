<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

//use App\Transformers\UserTransformer;

class AuthController extends Controller
{

    /**
     * Get a JWT token via given credentials.
     */
    //    public function login(Request $request)
    //    {
    //        //验证参数
    //        $validatedData = $request->validate([
    //            'title' => 'required|unique:posts|max:255',
    //            'body' => 'required',
    //        ]);
    //
    //        // 使用 Auth 登录用户，如果登录成功，则返回 201 的 code 和 token，如果登录失败则返回
    //        return ($token = Auth::guard('api')->attempt($validatedData))
    //            ? response(['token' => 'bearer ' . $token], 201)
    //            : response(['error' => '账号或密码错误'], 400);
    //    }

    public function login(Request $request)
    {
        // 验证规则，由于业务需求，这里我更改了一下登录的用户名，使用手机号码登录
        $rules = [
            'user_name'   => [
                'required',
                'exists:users,name',
            ],
            'password' => 'required|string|min:6|max:20',
        ];

        // 验证参数，如果验证失败，则会抛出 ValidationException 的异常
        $params = $this->validate($request, $rules);
        
        $params = [
            'name' => $params['user_name'],
            'password' => $params['password'],
        ];

        // 使用 Auth 登录用户，如果登录成功，则返回 201 的 code 和 token，如果登录失败则返回

        return ($token = Auth::guard('api')->attempt($params))
            ? response(['token' => 'bearer ' . $token], 201)
            : response(['error' => '账号或密码错误'], 400);
    }


    /**
     * 处理用户登出逻辑
     *
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return response(['message' => '退出成功']);
    }
}
