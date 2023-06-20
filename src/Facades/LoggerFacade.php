<?php

namespace Oguzkurukaya\LogMonitoring\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * @method static log( array  $data,string $type = self::LOG_INFO, string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static info( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static warning( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static error( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static critical( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 * @method static emergency( array  $data,string $message = null,array  $tag = [],array  $class = [],array  $function = [])
 *
 */
class LoggerFacade extends Facade
{
    public const LOG_INFO = 'info';
    public const LOG_WARNING = 'warning';
    public const LOG_ERROR = 'error';
    public const LOG_CRITICAL = 'critical';
    public const LOG_EMERGENCY = 'emergency';

    protected static function getFacadeAccessor()
    {
        return 'LogManager';
    }

}
