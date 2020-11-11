<?php

namespace App\Enum;

class ChatChannels
{
    const CHAT_CHANNEL_CHURCH_SURVICE = 'church_service';
    const CHAT_CHANNEL_AFTER_CHURCH_SERVICE_DIALOG = 'after_church_service_dialog';
    const CHAT_CHANNEL_CONVENTION = 'convention';


    public static function getChatChannels() {
        return [
          self::CHAT_CHANNEL_CHURCH_SURVICE => "Church Service",
          self::CHAT_CHANNEL_AFTER_CHURCH_SERVICE_DIALOG => "After Message Talk",
          self::CHAT_CHANNEL_CONVENTION => "Convention",
        ];
    }
}
