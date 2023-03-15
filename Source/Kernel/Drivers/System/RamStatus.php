<?php

namespace PhpRepos\DailyRoutines\Kernel\Drivers\System\RamStatus;

use function PhpRepos\DailyRoutines\Kernel\Drivers\System\OS\is_linux;
use function PhpRepos\DailyRoutines\Kernel\Drivers\System\OS\is_mac;

function get(): array
{
    $MB_to_GB = function ($mb) {
        return round($mb / 1024, 2) . ' GB';
    };

    if (is_linux()) {
        // Linux
        exec('free -m', $output);
        $memory = explode("\n", $output[1]);
        $memory = preg_split('/\s+/', $memory[0]);
        $total_memory = $memory[1];
        $used_memory = $memory[2];
    } elseif (is_mac()) {
        // macOS
        exec('vm_stat | grep "Pages free:"', $free_output);
        $free_pages = (int) str_replace('.', '', explode(' ', trim($free_output[0]))[2]) * 4096;
        exec('sysctl hw.memsize', $total_output);
        $total_memory = round(trim(explode(' ', $total_output[0])[1]) / 1024 / 1024);
        $used_memory = round(($total_memory - ($free_pages / 1024 / 1024)) / 1024);
    } else {
        return [
            'total' => 'Not Supported OS',
            'free' => '-',
            'used' => '-',
            'percent_used' => 0,
        ];
    }

    $percent_used = round($used_memory / $total_memory * 100, 2);
    $free_memory = $total_memory - $used_memory;

    return [
        'total' => $MB_to_GB($total_memory),
        'used' => $MB_to_GB($used_memory),
        'free' => $MB_to_GB($free_memory),
        'percent_used' => $percent_used,
    ];
}
