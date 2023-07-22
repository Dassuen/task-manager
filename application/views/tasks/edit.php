<!DOCTYPE html>
<html>
<head>
    <title>Editar Tarefa</title>
    <!-- Inclua os arquivos CSS do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Editar Tarefa</h1>
        <?php echo form_open('tasks/update/'.$task['id']); ?>
            <div class="form-group">
                <label>Título:</label>
                <input type="text" name="title" class="form-control" value="<?php echo $task['title']; ?>" required>
            </div>

            <div class="form-group">
                <label>Descrição:</label>
                <textarea name="description" class="form-control" required><?php echo $task['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label>Data de Vencimento:</label>
                <input type="date" name="due_date" class="form-control" value="<?php echo $task['due_date']; ?>" required>
            </div>

            <input type="submit" class="btn btn-primary" value="Salvar">
        <?php echo form_close(); ?>
        <a href="<?php echo site_url('tasks'); ?>" class="btn btn-secondary mt-3">Voltar para a Lista</a>
    </div>

    <!-- Inclua os arquivos JavaScript do Bootstrap 5 (opcional, se necessário) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>