<!DOCTYPE html>
<html>
<head>
    <title>Detalhes da Tarefa</title>
    <!-- Inclua os arquivos CSS do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .task-details-card {
            margin: 20px auto;
            max-width: 500px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .task-details-card .task-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .task-details-card .task-description {
            margin-bottom: 20px;
        }

        .task-details-card .task-date {
            font-size: 14px;
            color: #777;
        }

        .task-details-card .task-actions {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Detalhes da Tarefa</h1>
        <div class="task-details-card">
            <h2 class="task-title"><?php echo $task['title']; ?></h2>
            <p class="task-description"><?php echo $task['description']; ?></p>
            <p class="task-date"><strong>Vencimento da Tarefa:</strong> <?php echo $task['due_date']; ?></p>
            <!-- Adicione aqui quaisquer outros campos adicionais que você tenha criado -->

            <div class="task-actions">
                <a href="<?php echo site_url('tasks/edit/'.$task['id']); ?>" class="btn btn-primary btn-sm me-2">Editar</a>
                <a href="<?php echo site_url('tasks/delete/'.$task['id']); ?>" class="btn btn-danger btn-sm me-2" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">Excluir</a>
                <a href="<?php echo site_url('tasks'); ?>" class="btn btn-secondary btn-sm">Voltar para a lista</a>
            </div>
        </div>
    </div>

    <!-- Inclua os arquivos JavaScript do Bootstrap 5 (opcional, se necessário) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>