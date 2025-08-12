<h1><?= htmlspecialchars($title) ?></h1>
<p><?= htmlspecialchars($message) ?></p>
<?php App\Core\RenderView::partial('layout/sidebar', ['itens' => ['Item 1', 'Item 2']]); ?>