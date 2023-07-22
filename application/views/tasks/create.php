<!DOCTYPE html>
<html>
<head>
    <title>Criar Tarefa</title>
    <!-- Inclua os arquivos CSS do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Criar Tarefa</h1>
        <?php echo form_open('tasks/store'); ?>
            <div class="form-group">
                <label>Título:</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Descrição:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label>Data de Vencimento:</label>
                <input type="date" name="due_date" class="form-control" required>
            </div>

            <input type="submit" class="btn btn-primary" value="Criar">
        <?php echo form_close(); ?>
    </div>

    <!-- Inclua os arquivos JavaScript do Bootstrap 5 (opcional, se necessário) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>