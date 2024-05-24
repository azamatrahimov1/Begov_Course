<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authorization = $request->header('Authorization');
        if (!$authorization || !preg_match('/^\s*Basic\s*(\S+)\s*$/i', $authorization, $matches)) {
            return response()->json([
                'jsonrpc' => '2.0',
                'error' => [
                    'code' => -32504,
                    'message' => [
                        'uz' => 'Avtorizatsiyadan o\'tishda xatolik',
                        'ru' => 'Ошибка в аутентификации',
                        'en' => 'Auth error',
                    ]
                ]
            ]);
        }

        $decodedCredentials = base64_decode($matches[1]);
        list($username, $password) = explode(':', $decodedCredentials);

        $expectedUsername = 'Paycom';
        $expectedPassword = '';

        if ($username !== $expectedUsername || $password !== $expectedPassword) {
            return response()->json([
                'jsonrpc' => '2.0',
                'error' => [
                    'code' => -32504,
                    'message' => [
                        'uz' => 'Avtorizatsiyadan o\'tishda xatolik',
                        'ru' => 'Ошибка в аутентификации',
                        'en' => 'Auth error',
                    ]
                ]
            ]);
        }

        return $next($request);
    }
}
