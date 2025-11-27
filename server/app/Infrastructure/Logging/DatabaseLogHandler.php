<?php

namespace App\Infrastructure\Logging;

use App\Infrastructure\Persistence\Eloquent\Models\ErrorLogModel;
use Monolog\Handler\AbstractProcessingHandler;

class DatabaseLogHandler
{
    public function __invoke(array $config)
    {
        $monolog = new \Monolog\Logger('database');
        $monolog->pushHandler(new class extends AbstractProcessingHandler {
            protected function write(\Monolog\LogRecord $record): void
            {
                $context = $this->serializeContext($record->context);
                $file = $context['exception']['file'] ?? $record->context['file'] ?? null;
                $line = $context['exception']['line'] ?? $record->context['line'] ?? null;
                $this->createLog($record, $context, $file, $line);
            }

            private function serializeContext(array $context): array
            {
                array_walk_recursive($context, function (&$value) {
                    if ($value instanceof \Throwable) {
                        $value = [
                            'class' => get_class($value),
                            'message' => $value->getMessage(),
                            'file' => $value->getFile(),
                            'line' => $value->getLine(),
                            'trace' => $value->getTraceAsString(),
                        ];
                    } elseif (is_object($value)) {
                        $value = method_exists($value, '__toString') ? (string)$value : get_class($value);
                    }
                });
                return $context;
            }

            private function createLog($record, $context, $file, $line): void
            {
                ErrorLogModel::create([
                    'level' => $record->level->getName(),
                    'message' => $record->message,
                    'context' => json_encode($context),
                    'file' => $file,
                    'line' => $line,
                    'created_at' => now(),
                ]);
            }
        });
        return $monolog;
    }
}
