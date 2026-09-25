<?php
namespace App\Http\Middleware;
use App\Models\User;
use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
class JwtAuthenticate { public function handle(Request $request, Closure $next) { try { $token=$request->bearerToken(); if (!$token) throw new \RuntimeException(); $claims=app(JwtService::class)->decode($token); $user=User::with('roles')->find($claims->sub); if (!$user || !$user->active) throw new \RuntimeException(); $request->setUserResolver(fn()=>$user); return $next($request); } catch (\Throwable) { return response()->json(['message'=>'Não autenticado.'],401); } } }
