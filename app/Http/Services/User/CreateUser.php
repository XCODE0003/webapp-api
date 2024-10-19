<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Str;

class CreateUser
{
    public function index($request): \Illuminate\Http\JsonResponse
    {
        $file_url = $request->avatar;
        $file = file_get_contents($file_url);
        $file_name = pathinfo($file_url, PATHINFO_FILENAME);
        $extension = pathinfo($file_url, PATHINFO_EXTENSION);

        // Добавляем уникальный идентификатор к имени файла
        $unique_file_name = $file_name . '_' . Str::random(10) . '.' . $extension;
        $path = public_path('images/' . $unique_file_name);

        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $file);

        $request->avatar = url('images/' . $unique_file_name);
        $data = [
            'firstName' => $request->firstName,
            'avatar' => $request->avatar,
            'id' => $request->id,
        ];

        User::query()->create($data);
        $user = User::query()->where('id', $request->id)->first();
        $user->token = $user->createToken('token')->plainTextToken;
        return response()->json(['success', true, 'user' => $user]);
    }
}
