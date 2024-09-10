<?php

namespace App\Enums;

enum TaskStatus: string
{
    case ToDo = 'todo';
    case Doing = 'doing';
    case Done = 'done';
    case Missed = 'missed';
}
