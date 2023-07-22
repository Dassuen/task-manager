
</div>
    <!-- Inclua o jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclua o jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <!-- Inclua os arquivos JavaScript do Bootstrap 5 (opcional, se necessário) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <script>
        
        // Função para habilitar a ordenação por drag and drop
        function enableTaskSorting() {
            $("#sortable-tasks").sortable({
                axis: "y", // Permitir a ordenação somente verticalmente
                update: function(event, ui) {
                    // Obter a ordem atual das tarefas
                    var taskOrder = $(this).sortable("toArray", {attribute: 'data-id'});
                    console.log(taskOrder);
                    // Enviar os dados da nova ordem para o servidor
                    //$.post("<?php //echo site_url('tasks/sort'); ?>", taskOrder);
                    // Enviar os dados da nova ordem para o servidor
                    $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('tasks/sort'); ?>",
                    data: { order: taskOrder },
                    success: function(response) {
                        // Aqui você pode tratar a resposta do servidor, se necessário
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Tratar erros, se ocorrerem
                        console.error(error);
                    }
                });
                }
            });
        }
        // Chamar a função para habilitar a ordenação ao carregar a página
        $(document).ready(function() {
            enableTaskSorting();
        });
    </script>
    
</body>
</html>