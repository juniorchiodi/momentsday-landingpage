<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Visitantes Registrados - Moments Day</title>
    <link rel="icon" href="/View/assets/icons/favicon.png">
    <?php include './View/css/cssconfig.php' ?>
    <style>
        .visitors-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        .visitors-title {
            text-align: center;
            color: #333;
            font-size: 43px;
            margin: 25px 0;
        }

        .visitors-title span {
            color: red;
        }

        .total-visitors {
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #333;
        }

        .visitors-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-radius: 10px;
            overflow: hidden;
        }

        .visitors-table th {
            background-color: red;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .visitors-table th:first-child {
            border-top-left-radius: 10px;
        }

        .visitors-table th:last-child {
            border-top-right-radius: 10px;
        }

        .visitors-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .visitors-table tr:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        .visitors-table tr:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }

        .visitors-table tr:hover {
            background-color: #f8f8f8;
        }

        /* Estilos responsivos */
        @media screen and (max-width: 768px) {
            .visitors-title {
                font-size: 32px;
            }

            .visitors-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .visitors-table th,
            .visitors-table td {
                padding: 10px;
                font-size: 14px;
            }
        }

        @media screen and (max-width: 480px) {
            .visitors-container {
                padding: 10px;
            }

            .visitors-title {
                font-size: 24px;
            }

            .total-visitors {
                font-size: 1em;
            }

            .visitors-table {
                display: none;
            }

            .mobile-cards {
                display: block;
            }

            .visitor-card {
                background: white;
                border-radius: 10px;
                padding: 15px;
                margin-bottom: 15px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }

            .visitor-card-header {
                background: red;
                color: white;
                padding: 10px;
                border-radius: 8px 8px 0 0;
                margin: -15px -15px 10px -15px;
                text-align: center;
            }

            .visitor-card-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 10px;
                font-size: 14px;
            }

            .visitor-card-item {
                padding: 5px;
            }

            .visitor-card-label {
                font-weight: bold;
                color: #666;
            }
        }
    </style>
</head>

<body>
    <div class="visitors-container">
        <h1 class="visitors-title">Visitantes <span>Registrados</span></h1>

        <p class="total-visitors">
            Total de visitantes únicos: <span id="totalVisitantes">Carregando...</span>
        </p>

        <table class="visitors-table">
            <thead>
                <tr>
                    <th>n</th>
                    <th>IP</th>
                    <th>Qnt Visitas</th>
                    <th>Primeira Visita</th>
                </tr>
            </thead>
            <tbody id="tabela-corpo">
                <tr>
                    <td colspan="4">Carregando...</td>
                </tr>
            </tbody>
        </table>

        <div id="mobile-cards" class="mobile-cards" style="display: none;"></div>
    </div>

    <script>
        function carregarTabela() {
            fetch('contador.php')
                .then(res => res.json())
                .then(dados => {
                    const corpo = document.getElementById('tabela-corpo');
                    const mobileCards = document.getElementById('mobile-cards');
                    const totalVisitantes = document.getElementById('totalVisitantes');

                    corpo.innerHTML = '';
                    mobileCards.innerHTML = '';
                    let i = 1;

                    for (const ip in dados) {
                        // Adiciona à tabela
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td>${i}</td>
                            <td>${ip}</td>
                            <td>${dados[ip].visitas}</td>
                            <td>${dados[ip].primeira_visita}</td>
                        `;
                        corpo.appendChild(tr);

                        // Adiciona ao card mobile
                        const card = document.createElement('div');
                        card.className = 'visitor-card';
                        card.innerHTML = `
                            <div class="visitor-card-header">Visitante ${i}</div>
                            <div class="visitor-card-content">
                                <div class="visitor-card-item">
                                    <div class="visitor-card-label">IP:</div>
                                    <div>${ip}</div>
                                </div>
                                <div class="visitor-card-item">
                                    <div class="visitor-card-label">Visitas:</div>
                                    <div>${dados[ip].visitas}</div>
                                </div>
                                <div class="visitor-card-item">
                                    <div class="visitor-card-label">Primeira Visita:</div>
                                    <div>${dados[ip].primeira_visita}</div>
                                </div>
                            </div>
                        `;
                        mobileCards.appendChild(card);

                        i++;
                    }

                    totalVisitantes.textContent = i - 1;
                })
                .catch(erro => {
                    document.getElementById('tabela-corpo').innerHTML =
                        `<tr><td colspan="4">Erro ao carregar dados.</td></tr>`;
                    document.getElementById('mobile-cards').innerHTML =
                        `<div class="visitor-card">Erro ao carregar dados.</div>`;
                    console.error('Erro ao carregar tabela:', erro);
                });
        }

        // Função para verificar o tamanho da tela e mostrar o layout apropriado
        function atualizarLayout() {
            const tabela = document.querySelector('.visitors-table');
            const cards = document.getElementById('mobile-cards');
            
            if (window.innerWidth <= 480) {
                tabela.style.display = 'none';
                cards.style.display = 'block';
            } else {
                tabela.style.display = 'table';
                cards.style.display = 'none';
            }
        }

        // Carrega os dados e atualiza o layout
        carregarTabela();
        atualizarLayout();

        // Atualiza a cada 5 segundos
        setInterval(carregarTabela, 5000);

        // Atualiza o layout quando a janela é redimensionada
        window.addEventListener('resize', atualizarLayout);
    </script>

    <?php include './View/scripts.php'; ?>
</body>

</html>