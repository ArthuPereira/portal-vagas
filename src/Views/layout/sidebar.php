<aside>
    <h3>Menu Lateral</h3>
    <ul>
        <?php foreach ($itens as $item): ?>
            <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
    </ul>
</aside>
