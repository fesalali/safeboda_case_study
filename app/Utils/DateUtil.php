<?php


namespace App\Utils;


class DateUtil
{
    const DATE_FORMAT_SLASHED = 'Y/m/d';
    const DATE_TIME_FORMAT_SLASHED = 'Y/m/d H:i:s';

    const DATE_FORMAT_DASHED = 'Y-m-d';
    const DATE_TIME_FORMAT_DASHED = 'Y-m-d H:i:s';

    const DATE_FORMAT_IN = self::DATE_FORMAT_SLASHED;
    const DATE_TIME_FORMAT_IN = self::DATE_TIME_FORMAT_SLASHED;
    const DATE_FORMAT_OUT = self::DATE_FORMAT_SLASHED;
    const DATE_TIME_FORMAT_OUT = self::DATE_TIME_FORMAT_SLASHED;

    const TIME_FORMAT = 'H:i';

    const ISO8601 = 'Y-m-d\TH:i:s.u';
}
