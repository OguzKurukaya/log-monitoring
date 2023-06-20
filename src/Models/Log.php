<?php

namespace Oguzkurukaya\LogMonitoring\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property false|mixed|string $stacktree
 * @property mixed|string $type
 * @property mixed|string $message
 * @property int|mixed|string|null $user_id
 * @property false|mixed|string $tag
 * @property false|mixed|string $class
 * @property false|mixed|string $function
 */
class Log extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'stacktree',
        'type',
        'failed_at',
        'message',
        'user_id',
        'tag',
        'class',
        'function'
    ];
}
