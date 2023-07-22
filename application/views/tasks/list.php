
    <!-- Cabeçalho -->
    <?php $this->load->view('templates/header'); ?>

    <!-- Conteúdo da página -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tarefas</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="task-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Tarefa</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($tasks as $task) : ?>
                                        <tr>
                                            <td><?php echo $task['id']; ?></td>
                                            <td><?php echo $task['title']; ?></td>
                                            <td>
                                                <?php if ($task['status'] == 1) : ?>
                                                    <span class="badge bg-success">Concluída</span>
                                                <?php else : ?>
                                                    <span class="badge bg-warning">Pendente</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <!-- Botão Editar -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal" data-taskid="<?php echo $task['id']; ?>" data-tasktitle="<?php echo $task['title']; ?>" data-taskstatus="<?php echo $task['status']; ?>">
                                                    Editar
                                                </button>

                                                <!-- Botão Excluir -->
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-taskid="<?php echo $task['id']; ?>" data-tasktitle="<?php echo $task['title']; ?>">
                                                    Excluir
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal de Edição da Tarefa -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="taskModalLabel">Editar Tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form id="editTaskForm">
                    <input type="hidden" class="form-control" id="editTaskId" name="editTaskId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editTaskTitle" class="form-label">Título da Tarefa</label>
                            <input type="text" class="form-control" id="editTaskTitle" name="editTaskTitle">
                        </div>
                        <div class="mb-3">
                            <label for="editTaskStatus" class="form-label">Status da Tarefa</label>
                            <select class="form-control" id="editTaskStatus" name="editTaskStatus">
                                <option value="1">Concluída</option>
                                <option value="0">Pendente</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Fim do Modal de Edição -->

    <!-- Modal de Confirmação para Excluir Tarefa -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="deleteTaskId" name="deleteTaskId">
                    Tem certeza de que deseja excluir a tarefa: <span id="deleteTaskTitle"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Excluir</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim do Modal de Confirmação -->
    <!-- Toast de Edição Concluída -->
    <div class="toast align-items-center text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="2000" style="position: absolute; top: 0; right: 0; margin: 15px;">
        <div class="d-flex">
            <div class="toast-body">
                <!-- Aqui exibiremos a mensagem dinâmica -->
            </div>
            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Fechar"></button>
        </div>
    </div>
    <!-- Fim do Toast de Edição Concluída -->


    <!-- Rodapé -->

    
    <?php $this->load->view('templates/footer'); ?>
    <script>
        // Script para preencher a modal com os dados da tarefa ao abrir
        $('#editTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botão que disparou o evento
            console.log(button.data('tasktitle'));
            var taskId = button.data('taskid'); // Extração do atributo data-taskid
            var taskTitle = button.data('tasktitle'); // Extração do atributo data-tasktitle
            var taskStatus = button.data('taskstatus'); // Extração do atributo data-taskstatus

            // Preenchimento dos campos da modal com os dados da tarefa
            var modal = $(this);
            modal.find('#editTaskTitle').val(taskTitle);
            modal.find('#editTaskStatus').val(taskStatus);
            modal.find('#editTaskId').val(taskId);
        });
        $('#confirmDeleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botão que disparou o evento
            
            var taskId = button.data('taskid'); // Extração do atributo data-taskid
            var taskTitle = button.data('tasktitle'); // Extração do atributo data-tasktitle

            // Preenchimento dos campos da modal com os dados da tarefa
            var modal = $(this);
            modal.find('#deleteTaskTitle').html(taskTitle);
            modal.find('#deleteTaskId').val(taskId);
        });
        // Script para mostrar o toast de edição concluída
        function showToast(message) {
            var toast = new bootstrap.Toast(document.querySelector('.toast'));
            var toastBody = document.querySelector('.toast-body');
            toastBody.innerHTML = message; // Definimos a mensagem no corpo do toast
            toast.show();
        }
        // Script para enviar os dados do formulário via AJAX para a edição da tarefa
        $(document).on('submit', '#editTaskForm', function (event) {
            event.preventDefault();

            var formData = $(this).serialize(); // Obter dados do formulário
            $.ajax({
                url: '<?php echo base_url('tasks/edit_task'); ?>',
                type: 'POST',
                data: formData,
                success: function (response) {
                    // Lidar com a resposta da edição da tarefa aqui, se necessário
                    console.log(response);
                    // Fechar a modal após a edição
                    $('#editTaskModal').modal('hide');
                    showToast(response.message)
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    
                },
                error: function (error) {
                    // Lidar com o erro, se necessário
                    console.log(error);
                }
            });
        });
        // Script para confirmar a exclusão da tarefa
        $(document).on('click', '#confirmDeleteBtn', function () {
            var taskId = $('#deleteTaskId').val();
            $.ajax({
                url: '<?php echo base_url('tasks/delete'); ?>/'+taskId ,
                type: 'POST',
                success: function (response) {
                    // Lidar com a resposta da edição da tarefa aqui, se necessário
                    console.log(response);
                    // Fechar a modal após a edição
                    $('#editTaskModal').modal('hide');
                    showToast(response.message)
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    
                },
                error: function (error) {
                    // Lidar com o erro, se necessário
                    console.log(error);
                }
            });
        });
    </script>
    