<?php

namespace App\Services;

use App\Models\User;
use App\Models\TextMessage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class TextMessageService
{
    public static function sendMessage(array $data, Collection $records)
    {
        $textMessages = collect([]);

        $records->map(function ($record) use ($data, $textMessages) {
            $textMessage = self::sendTextMessage($record, $data);

            $textMessages->push($textMessage);
        });

        TextMessage::insert($textMessages->toArray());
    }

    public static function sendTextMessage(User $record, array $data): array
    {
        $message = Str::replace('{name}', $record->name, $data['message']);

        // send the actual message here

        return [
            'message' => $message,
            'sent_by' => auth()?->id() ?? null,
            'status' => TextMessage::STATUS['PENDING'],
            'response' => '',
            'sent_to' => $record->id,
            'remarks' => $data['remarks'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
