
<!-- Cabeçalho -->
<?php $this->load->view('templates/header'); ?>

<div class="content-wrapper">
    <!-- Conteúdo da página -->
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista de Tarefas</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Botão para adicionar tarefa -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
                            Adicionar Tarefa
                        </button>
                    </div>
                </div>
            </div>

            <!-- Lista de tarefas -->
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
                                                <th>Prazo</th>
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
                                                <td><?php echo $task['due_date']; ?></td>
                                                <td>
                                                    <!-- Botão Editar -->
                                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTaskModal" data-taskid="<?php echo $task['id']; ?>" data-tasktitle="<?php echo $task['title']; ?>" data-taskstatus="<?php echo $task['status']; ?>" data-taskdate="<?php echo $task['due_date']; ?>">
                                                        Editar
                                                    </button>

                                                    <!-- Botão Excluir -->
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-taskid="<?php echo $task['id']; ?>">
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
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
    <!-- Modal para adicionar tarefa -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Adicionar Tarefa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form id="addTaskForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Status da Tarefa</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1">Concluída</option>
                                <option value="0">Pendente</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data de Vencimento:</label>
                            <input type="date" name="due_date" id="due_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
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
                                <option value="0">Pendente</option>    
                                <option value="1">Concluída</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Data de Vencimento:</label>
                            <input type="date" name="due_date" id="editTaskDate" class="form-control" required>
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
        $('#addTaskForm').submit(function(e) {
            e.preventDefault();

            // Obter os dados do formulário
            var formData = $(this).serialize();

            // Enviar o formulário via AJAX
            $.ajax({
                url: '<?php echo base_url("tasks/add_task"); ?>',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Fechar a modal após adicionar a tarefa
                        $('#addTaskModal').modal('hide');

                        // Limpar o formulário
                        $('#addTaskForm')[0].reset();

                        // Atualizar a lista de tarefas
                        updateTaskList();
                    } else {
                        // Exibir mensagem de erro
                        alert('Erro ao adicionar a tarefa. Por favor, tente novamente.');
                    }
                },
                error: function() {
                    alert('Erro ao adicionar a tarefa. Por favor, tente novamente.');
                }
            });
        });
        // Função para atualizar a lista de tarefas via AJAX
        function updateTaskList() {
            $.ajax({
                url: '<?php echo base_url("tasks/get_tasks"); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Limpar a lista atual de tarefas
                        $('#sortable-tasks').empty();

                        // Adicionar as novas tarefas à lista
                        $.each(response.data, function(index, task) {
                            var taskElement = `
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between">
                                        <span class="task-title">${task.title}</span>
                                        <div class="task-actions">
                                            <a href="#" class="edit-task-btn" data-taskid="${task.id}" data-bs-toggle="modal" data-bs-target="#editTaskModal">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" class="delete-task-btn" data-taskid="${task.id}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>`;
                            $('#sortable-tasks').append(taskElement);
                        });
                    } else {
                        alert('Erro ao obter a lista de tarefas. Por favor, tente novamente.');
                    }
                },
                error: function() {
                    alert('Erro ao obter a lista de tarefas. Por favor, tente novamente.');
                }
            });
        }
        // Script para preencher a modal com os dados da tarefa ao abrir
        $('#editTaskModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Botão que disparou o evento
            console.log(button.data('tasktitle'));
            var taskId = button.data('taskid'); // Extração do atributo data-taskid
            var taskTitle = button.data('tasktitle'); // Extração do atributo data-tasktitle
            var taskStatus = button.data('taskstatus'); // Extração do atributo data-taskstatus
            var taskDate = button.data('taskdate'); // Extração do atributo data-taskstatus
            // Preenchimento dos campos da modal com os dados da tarefa
            var modal = $(this);
            modal.find('#editTaskTitle').val(taskTitle);
            modal.find('#editTaskStatus').val(taskStatus);
            modal.find('#editTaskId').val(taskId);
            modal.find('#editTaskDate').val(taskDate);
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
    