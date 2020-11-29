<?php

use Carbon\Carbon;

function nice_date(Carbon $date)
{
    return $date->diffForHumans() . ', ' . $date->format('d.m.Y');
}
