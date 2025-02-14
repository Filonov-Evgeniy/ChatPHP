<?php
namespace Chat\src\Chat;
interface ChatUserInterface
{
    public function getList($filter, $separator);

    public function create();
}