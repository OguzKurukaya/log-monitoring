<?php

namespace Oguzkurukaya\LogMonitoring\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Oguzkurukaya\LogMonitoring\Mail\LogMailler;
use Oguzkurukaya\LogMonitoring\Models\Log;

class LogManager
{

    private bool $shouldMail = false;

    public function log(
        array  $data,
        string $message,
        int $type = LOG_INFO,
        array  $tag = [],
        array  $class = [],
        array  $function = []
    ): void
    {
        /**
         * İf anything from that above's, set it to the info
         */
        $type = match ($type) {
            'warning' => LOG_WARNING,
            'error' => LOG_ERR,
            'critical' => LOG_CRIT,
            default => LOG_INFO,
        };
        /**
         * Let's check if the user is authenticated
         * if true We will bring the user's id to the log
         */

        $hasAuth = Auth::check();

        $log = Log::create([
            'stacktree' => json_encode($data),
            'type' => $type,
            'message' => $message,
            'user_id' => $hasAuth ? Auth::id() : null,
            'tag' => json_encode($tag),
            'class' => json_encode($class),
            'function' => json_encode($function),
        ]);

        /**
         * Let's check if we should mail
         */
        if ($this->shouldMail) {
            $this->sendMail(json_encode($log), $log->type);
        }


    }

    public function info(
        array  $data,
        string $message = null,
        array  $tag = [],
        array  $class = [],
        array  $function = []
    ): void
    {
        $this->log(
            data: $data,
            message: $message,
            type: LOG_INFO,
            tag: $tag,
            class: $class,
            function: $function
        );
    }

    public function warning(
        array  $data,
        string $message = null,
        array  $tag = [],
        array  $class = [],
        array  $function = []
    ): void
    {
        $this->log(
            data: $data,
            message: $message,
            type: LOG_WARNING,
            tag: $tag,
            class: $class,
            function: $function
        );
    }

    public function error(
        array  $data,
        string $message = null,
        array  $tag = [],
        array  $class = [],
        array  $function = []
    ): void
    {
        $this->log(
            data: $data,
            message: $message,
            type: LOG_ERR,
            tag: $tag,
            class: $class,
            function: $function
        );
    }

    public function critical(
        array  $data,
        string $message = null,
        array  $tag = [],
        array  $class = [],
        array  $function = []
    ): void
    {
        $this->log(
            data: $data,
            message: $message,
            type: LOG_CRIT,
            tag: $tag,
            class: $class,
            function: $function
        );
    }

    /**
     * Emergency functions is always try to send mail
     * Because it's emergency you need to see it as soon as possible now, not later noooow :)
     * @param array $data
     * @param string|null $message
     * @return void
     */
    public function emergency(
        array  $data,
        string $message = null,
        array  $tag = [],
        array  $class = [],
        array  $function = []
    ): void
    {
        $this->shouldMail = true;
        $this->log(
            data: $data,
            message: $message,
            type: LOG_EMERG,
            tag: $tag,
            class: $class,
            function: $function
        );
    }


    /**
     * You should be in a hurry :)
     * @param array $data
     * @param string|null $message
     * @param array $tag
     * @param array $class
     * @param array $function
     * @return void
     */
 public function alert(
        array  $data,
        string $message = null,
        array  $tag = [],
        array  $class = [],
        array  $function = []
    ): void
    {
        $this->shouldMail = true;
        $this->log(
            data: $data,
            message: $message,
            type: LOG_ALERT,
            tag: $tag,
            class: $class,
            function: $function
        );
    }

    /**
     * That is for debugging, You should see this in live
     * @param array $data
     * @param string|null $message
     * @param array $tag
     * @param array $class
     * @param array $function
     * @return void
     */
 public function debug(
        array  $data,
        string $message = null,
        array  $tag = [],
        array  $class = [],
        array  $function = []
    ): void
    {
        $this->shouldMail = true;
        $this->log(
            data: $data,
            message: $message,
            type: LOG_DEBUG,
            tag: $tag,
            class: $class,
            function: $function
        );
    }

    /**
     * Normal, but significant log For conditions
     * @param array $data
     * @param string|null $message
     * @param array $tag
     * @param array $class
     * @param array $function
     * @return void
     */
    public function notice(
        array  $data,
        string $message = null,
        array  $tag = [],
        array  $class = [],
        array  $function = []
    ): void
    {
        $this->shouldMail = true;
        $this->log(
            data: $data,
            message: $message,
            type: LOG_NOTICE,
            tag: $tag,
            class: $class,
            function: $function
        );
    }




    /**
     * Mail configs comes from config/mail.php file and checks log-monitoring array.
     * If it's not set, it will return false and mail will not send
     * @param string $data
     * @param string $type
     * @return void
     */
    private function sendMail(string $data, string $type): void
    {
        if (!config('mail.log-monitoring.target_emails')) return;

        $details = [
            'title' => 'You Have Log From ' . config('app.name'),
            'body' => $data,
            'type' => $type
        ];
        try {
            Mail::to(
                config('mail.log-monitoring.target_emails')
            )->send(
                new LogMailler($details)
            );
        } catch (\Exception $exception) {
            $this->shouldMail = false;
            $this->warning(
                data: [
                    'message' => 'Mail Settings Are Not Correct, Please Check Your Mail Settings',
                    'stackTree' => $exception->getTraceAsString(),
                ],
                message: 'Mail Settings Are Not Correct, Please Check Your Mail Settings',
            );
        }
    }

    #region Getters and Setters


    /**
     * @return bool
     */
    public function isShouldMail(): bool
    {
        return $this->shouldMail;
    }

    /**
     * @param bool $shouldMail
     * @return LogManager
     */
    public function setShouldMail(bool $shouldMail): self
    {
        $this->shouldMail = $shouldMail;
        return $this;
    }

    #endregion


}
