<div id="ram-status">
    <div class="bg-gray-300 h-4 rounded-full overflow-hidden">
        <div class="bg-gradient-to-r from-green-400 <?php
        if ($ram_status['percent_used'] < 35) {
            echo 'to-green-600';
        } elseif ($ram_status['percent_used'] < 70) {
            echo 'to-blue-600';
        } else {
            echo 'to-red-600';
        }
        ?> h-full" style="width:<?= $ram_status['percent_used'] ?>%"></div>
    </div>
    <p>Used RAM: <?= $ram_status['percent_used'] ?>%</p>
    <p>Amount of RAM used: <?= $ram_status['used'] ?></p>
    <p>Amount of RAM free: <?= $ram_status['free'] ?></p>
</div>
