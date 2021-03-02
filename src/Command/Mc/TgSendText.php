<?php

namespace Mocean\Command\Mc;

class TgSendText extends AbstractMc
{
    public function setTo($id, $type = "chat_id")
    {
        $this->requestData['to'] = array(
            "id" => $id,
            "type" => $type
        );

        return $this;
    }

    public function setFrom($id, $type = "bot_username")
    {
        $this->requestData['from'] = array(
            "id" => $id,
            "type" => $type,
        );

        return $this;
    }

    public function setContent($text) {
        $this->requestData["content"] = array(
            "type" => "text",
            "text" => $text,
        );
        return $this;
    }

    protected function requiredKey()
    {
        return ['to','from','content'];
    }

    public function action()
    {
        return 'send-telegram';
    }
}
