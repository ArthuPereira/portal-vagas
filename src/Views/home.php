<h2>Bem-vindo à Home!</h2>
<p><?= $message; ?></p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Criado em</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($companies as $company): ?>
            <tr>
                <td><?= htmlspecialchars($company->name) ?></td>
                <td><?= htmlspecialchars($company->cnpj) ?></td>
                <td><?= htmlspecialchars($company->phone) ?></td>
                <td><?= htmlspecialchars($company->address) ?></td>
                <td><?= htmlspecialchars($company->created_at) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
