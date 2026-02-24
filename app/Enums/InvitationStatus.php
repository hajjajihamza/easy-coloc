<?php

namespace App\Enums;

enum InvitationStatus: string
{
    case ACCEPTED = 'ACCEPTED';
    case REJECTED = 'REJECTED';
}