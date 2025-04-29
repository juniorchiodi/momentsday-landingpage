<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Visitantes Registrados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px #ccc;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: red;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        caption {
            caption-side: bottom;
            font-size: 1.2em;
            padding: 8px;
            color: #666;
        }
    </style>
</head>

<body>

    <h1>Visitantes Registrados</h1>

    <p style="text-align: center; font-size: 1.2em; margin-bottom: 20px;">
        Total de visitantes únicos: <span id="totalVisitantes">Carregando...</span>
    </p>

    <table>
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

    <script>
        function carregarTabela() {
            fetch('contador.php')
                .then(res => res.json())
                .then(dados => {
                    const corpo = document.getElementById('tabela-corpo');
                    const totalVisitantes = document.getElementById('totalVisitantes');

                    corpo.innerHTML = '';
                    let i = 1;

                    for (const ip in dados) {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                    <td>${i++}</td>
                    <td>${ip}</td>
                    <td>${dados[ip].visitas}</td>
                    <td>${dados[ip].primeira_visita}</td>
                `;
                        corpo.appendChild(tr);
                    }

                    totalVisitantes.textContent = i - 1; // Atualiza o total de visitantes únicos
                })
                .catch(erro => {
                    document.getElementById('tabela-corpo').innerHTML =
                        `<tr><td colspan="4">Erro ao carregar dados.</td></tr>`;
                    console.error('Erro ao carregar tabela:', erro);
                });
        }

        // Carrega ao abrir a página
        carregarTabela();

        // Atualiza a cada 5 segundos (5000 ms)
        setInterval(carregarTabela, 5000);
    </script>

</body>

</html>