<div class="bg-gray-300 h-4 rounded-full overflow-hidden">
    <div class="bg-gradient-to-r from-green-400 <?php
    if ($hard_status['percent_used'] < 35) {
        echo 'to-green-600';
    } elseif ($hard_status['percent_used'] < 70) {
        echo 'to-blue-600';
    } else {
        echo 'to-red-600';
    }
    ?> h-full" style="width:<?= $hard_status['percent_used'] ?>%"></div>
</div>
<p>Used disk space: <?= $hard_status['percent_used'] ?>%</p>
<p>Amount of space used: <?= $hard_status['used'] ?></p>
<p>Amount of space free: <?= $hard_status['free'] ?></p>
