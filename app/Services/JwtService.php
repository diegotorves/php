<?php
namespace App\Services;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Str;
class JwtService { public function issue(User $user, ?int $ttl=null): string { $now=time(); $ttl ??= (int) config('jwt.access_ttl',15); return JWT::encode(['iss'=>config('jwt.issuer'),'sub'=>$user->id,'iat'=>$now,'exp'=>$now+$ttl*60,'jti'=>(string) Str::uuid()], config('jwt.secret'), config('jwt.algorithm','HS256')); } public function decode(string $token): object { return JWT::decode($token,new Key(config('jwt.secret'),config('jwt.algorithm','HS256'))); } }
