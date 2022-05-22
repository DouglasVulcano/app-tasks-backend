<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Carbon\Exceptions\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\RegisterService;

class AuthController extends Controller
{

    /**
     * service attribute
     *
     * @var RegisterService
     */
    protected RegisterService $service;

    /**
     * construct method
     *
     * @param TasksService $service
     */
    public function __construct(RegisterService $service)
    {
        $this->service = $service;
    }

    /**
     * Auth function
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function auth(AuthRequest $request): JsonResponse
    {
        try {
            if (Auth::attempt([
                'email'     => $request->email,
                'password'  => $request->password
            ])) {
                $res = array(
                    'token' => Auth::user()->createToken('jwt')->plainTextToken,
                    'user' => Auth::user()
                );
                return response()->json($res, JsonResponse::HTTP_OK);
            } else {
                return response()->json(array('message' => 'usuário inválido'), JsonResponse::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'could_not_create_token'], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * me function
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        return response()->json(Auth::user(), JsonResponse::HTTP_OK);
    }

    /**
     * get users
     *
     * @return JsonResponse
     */
    public function users(): JsonResponse
    {
        $users = User::all();
        return response()->json(Auth::user(), JsonResponse::HTTP_OK);
    }




    /**
     * this method will validate request data and create a new user
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $response = $this->service->registerUser($request->all());
        return response()->json($response, JsonResponse::HTTP_OK);
    }
}
