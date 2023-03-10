<h3 class="text-lg font-bold leading-6">Crypto Price List</h3>
<dl class="mt-5 grid grid-cols-1 gap-5 grid-col-2 sm:grid-cols-3 lg:grid-cols-5 xl:grid-cols-10">
    <?php foreach ($cryptos as $crypto): ?>
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500"><?= $crypto['symbol'] ?></dt>
            <dd class="mt-1 text-1xl font-semibold tracking-tight text-gray-900">$<?= number_format($crypto['quote']['USD']['price'], 2) ?></dd>
        </div>
    <?php endforeach; ?>
</dl>
