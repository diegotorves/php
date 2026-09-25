<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller { public function login(Request $request, JwtService $jwt) { $data=$request->validate(['email'=>'required|email','password'=>'required|string']); $user=User::with('roles')->where('email',$data['email'])->first(); if (!$user || !$user->active || !Hash::check($data['password'],$user->password)) return response()->json(['message'=>'Credenciais inválidas.'],401); $user->update(['last_login_at'=>now()]); return response()->json(['token'=>$jwt->issue($user),'token_type'=>'Bearer','user'=>$user]); } public function me(Request $request) { return response()->json($request->user()); } public function refresh(Request $request, JwtService $jwt) { return response()->json(['token'=>$jwt->issue($request->user()),'token_type'=>'Bearer']); } public function logout() { return response()->json(['message'=>'Logout realizado.']); } }
