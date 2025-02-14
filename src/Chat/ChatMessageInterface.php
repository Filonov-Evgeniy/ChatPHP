<?php
namespace Chat\src\Chat;
interface ChatMessageInterface
{
    public function getList();

    public function create(bool $withSupplement);
}