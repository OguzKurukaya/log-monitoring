<?php

namespace Oguzkurukaya\LogMonitoring\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * @method static log( array  $data,string $type = LOG_INFO, string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static info( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static warning( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static error( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static critical( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static emergency( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 *
 */
class LoggerFacade extends Facade
{
    public const LOG_EMERGENCY = 0;
    public const LOG_ALERT = 1;

    public const LOG_CRITICAL = 2;

    public const LOG_ERROR = 3;
    public const LOG_WARNING = 4;

    public const LOG_NOTICE = 5;

    public const LOG_INFO = 6;

    public const LOG_DEBUG = 7;

    public const LOG_DEFAULT = 8;




    protected static function getFacadeAccessor()
    {
        return 'LogManager';
    }

}
