<?php

namespace Chat\src\Message\Builder;
interface MessageBuilder
{
    public function build();

    public function setUsername($username);

    public function setEmail($email);

    public function setMessageText($messageText);

    public function setDate($date);

    public function setChatBrowser($chatBrowser);

    public function setUserIp($userIp);
}