<?php
include 'conexao.php';

// 1. Média dos precos de todos os produtos
$sql = $pdo->query("SELECT TRUNCATE(AVG(preco), 2) as media FROM Produto");
$mediaPrecoProdutos = $sql->fetch(PDO::FETCH_ASSOC)['media'];

// 2. Média dos precos de todos os produtos com desconto
$sql = $pdo->query("SELECT TRUNCATE(AVG(preco), 2) as media FROM Produto WHERE desconto_usados > 0");
$mediaPrecoProdutosDesconto = $sql->fetch(PDO::FETCH_ASSOC)['media'];

// 3. Preço máximo categoria eletronico
$sql = $pdo->query("SELECT TRUNCATE(MAX(preco), 2) as maximo FROM Produto WHERE categoria LIKE 'Eletrônico'");
$precoMaxEletronico = $sql->fetch(PDO::FETCH_ASSOC)['maximo'];

// 4. Produtos lançados há mais de 6 meses
$sql = $pdo->query("SELECT * FROM Produto WHERE data_lancamento < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
$produtos6mais = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Produtos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .dashboard-card {
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .icon-placeholder {
            font-size: 2.5rem;
            color: #0d6efd;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <h1 class="text-center mb-5">Relatório Analítico</h1>

        <div class="row g-4 mb-5">

            <div class="card">
                <div class="card-header">
                    Média dos preços de todos os produtos
                </div>
                <div class="card-body">
                    <h5 class="card-title">R$ <?= $mediaPrecoProdutos ?></h5>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Média dos preços de todos os produtos com desconto
                </div>
                <div class="card-body">
                    <h5 class="card-title">R$ <?= $mediaPrecoProdutosDesconto ?></h5>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Preço máximo da categoria Eletrônico
                </div>
                <div class="card-body">
                    <h5 class="card-title">R$ <?= $precoMaxEletronico ?></h5>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Lista dos produtos lançados há mais de 6 meses
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Preço</th>
                                        <th>Data de Lançamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($produtos6mais as $prod): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($prod['nome']) ?></td>
                                            <td>R$<?= htmlspecialchars($prod['preco']) ?></td>
                                            <td><?= htmlspecialchars($prod['data_lancamento']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                    </h5>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>