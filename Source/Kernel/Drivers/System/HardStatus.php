<?php

namespace PhpRepos\DailyRoutines\Kernel\Drivers\System\HardStatus;

function get(): array
{
    $format_bytes = function ($size): string {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }

        return round($size, 2) . ' ' . $units[$i];
    };

    $bytes_total = disk_total_space('/');
    $bytes_free = disk_free_space('/');
    $bytes_used = $bytes_total - $bytes_free;

    $percent_used = round($bytes_used / $bytes_total * 100, 2);

    return [
        'total' => $format_bytes($bytes_total),
        'used' => $format_bytes($bytes_used),
        'free' => $format_bytes($bytes_free),
        'percent_used' => $percent_used,
    ];
}
