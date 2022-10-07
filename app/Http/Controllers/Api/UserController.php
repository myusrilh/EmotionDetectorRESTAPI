<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends ApiController
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $validator = Validator::make(
            $credentials,
            [
                'email' => 'required|email',
                'password' => 'required|min:5'
            ],
            [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Data yang dimasukkan bukan email',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 5 karakter'
            ]
        );

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), Response::HTTP_UNAUTHORIZED);
            // return response()->json(['error' => $validator->messages()], Response::HTTP_OK);
        }



        try {

            // $auth = Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);
            $user = User::where('email', '=', $request->input('email'))->first();

            $passcheck = false;
            if ($user != null) {
                $passcheck = Hash::check($request->input('password'), $user->password);
            }

            if (!$passcheck) {
                return $this->errorResponse('Inputan login tidak valid', Response::HTTP_UNAUTHORIZED);
                // return response()->json([
                //     'success' => false,
                //     'message' => 'Login credentials are invalid.',
                // ], Response::HTTP_UNAUTHORIZED);
            } else {
                return $this->successResponse($user, 'Login sukses!');
                // return response()->json([
                //     'success' => true,
                //     'message' => 'Log in succeed',
                //     'data' => $user
                // ], Response::HTTP_OK);
            }
        } catch (QueryException $ex) {
            return $this->errorResponse($ex->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fullname' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:5',
                'level' => 'required'
            ],
            [
                'fullname.required' => 'Nama lengkap harus diisi',
                'level.required' => 'Level harus diisi',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Data yang dimasukkan bukan email',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 5 karakter'
            ]
        );

        if ($validator->fails()) {
            return $this->errorResponse('Inputan register tidak valid', Response::HTTP_UNAUTHORIZED);
        }

        $data = [
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'level' => $request->input('level'),
            'email_verified_at' => NULL,
            'profile_picture' => NULL,
        ];


        try {
            $data = User::create($data)->where('email', '=', $request->input('email'))->first();
            // if ($insert) {
            // $data = User::where('email', '=', $request->input('email'))->get();

            return $this->successResponse($data, 'Register berhasil');
            // } else {
            // return $this->errorResponse('Gagal menyimpan data', Response::HTTP_BAD_REQUEST);
            // }
        } catch (QueryException $ex) {
            return $this->errorResponse($ex->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (Throwable $th) {
            return $this->errorResponse($th->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
