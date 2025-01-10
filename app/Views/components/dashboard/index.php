<?= $this->extend("components/layout/app.php"); ?>

<?= $this->section('content') ?>
<!-- BODY -->
    <section id="main">
        <header>
            <div class="search_bar">
                <label for="search_bar" class="material-symbols-rounded">search</label>
                <input type="text" id="search_bar">
            </div>
            <div class="notification_settings">
                <span class="material-symbols-rounded">notifications_active</span>
                <span class="material-symbols-rounded">settings</span>
                <span class="material-symbols-rounded">mark_chat_unread</span>
            </div>
        </header>
        <div class="main_content y-thin-scroll-bar">
            <header>
                <span class="task_mark material-symbols-rounded">task_alt</span>
                <h2>My Tasks</h2>
            </header>

            <div class="task_control_bar">
                <div class="task_view">
                    <label for="grid">
                        <input type="radio" name="view" hidden checked id="grid">
                        <div><span class="material-symbols-outlined">widget_medium</span>Grid View</div>
                    </label>
                    <label for="list">
                        <input type="radio" name="view" hidden id="list">
                        <div><span class="material-symbols-outlined">list</span>List</div>
                    </label>
                </div>
                <div class="task_control">
                    <div class="search_task">
                        <label for="search_task" class="material-symbols-outlined">search</label>
                        <input type="text" id="search_task" placeholder="Search Task">
                    </div>
                    <span class="separator"></span>
                    <button class="task_filter"><span class="material-symbols-outlined">filter_alt</span>Filter</button>
                    <button onclick="openAddTask()" class="add_task_btn"><span class="material-symbols-outlined">add</span> Add Task</button>
                </div>
            </div>
            <div class="tasks_content">
                <div class="panel_grid_view">

                </div>
                <div class="panel_list_view">
                    <ul>
                        <?php if(!empty($alltasks)): 
                            foreach($alltasks as $key => $alltask):
                                $indicator = [
                                    'To-do' => "", 
                                    'In Progress' => "progress", 
                                    'On Pending' => "pending",
                                    'Completed' => "completed"
                                ];
                                $prior = [
                                    'Low' => "low", 
                                    'High' => "high", 
                                    'Medium' => "md",
                                ];
                                $type = [
                                    'Bug' => "error", 
                                    'Feature' => "info", 
                                    'Improvement' => "success",
                                ];
                                $tasks = json_decode($alltask->tasks,true);
                            ?>

                            <li>
                                <header>
                                    <span class="material-symbols-rounded">keyboard_arrow_down</span>
                                    <div class="task_label">
                                        <span class="task_label_indicator <?= $indicator[$alltask->task_status]; ?>"></span>
                                        <h4 class="task_status"><?= $alltask->task_status ?></h4>
                                        <span class="task_count"><?= count($tasks) ?></span>
                                    </div>
                                </header>
                                <table>
                                    <?= $task_table_header ?>
                                    <tbody>
                                        <?php if(!empty($tasks)): 
                                            foreach($tasks as $tk_key => $task ): ?>
                                            <tr ondblclick="openDetails(<?= $task['id'] ?>)">
                                                <td>
                                                    <div><?= $task['task_name'] ?></div></td>
                                                <td>
                                                    <div><?= $task['description'] ?></div></td>
                                                <td>
                                                    <div><?= date('M d, Y', strtotime($task['estimation_to'])) ?></div></td>
                                                <td>
                                                    <div>
                                                        <div class="type <?= $type[$task['task_type']] ?>">
                                                            <span class="material-symbols-outlined">team_dashboard</span>
                                                            <?= $task['task_type'] ?>
                                                        </div>
                                                    </div></td>
                                                <td>
                                                    <div>
                                                        <ol class="invites">
                                                            <li><img src="<?= base_url('images/logo.png') ?>" alt=""></li>
                                                            <li><span>TG</span></li>
                                                            <li><span>OP</span></li>
                                                        </ol>
                                                    </div></td>
                                                <td>
                                                    <div>
                                                        <div class="priority <?= $prior[$task['priority']] ?>"><span><?= $task['priority'] ?></span></div>
                                                    </div></td>
                                                <td>
                                                    <div>
                                                        <span class="material-symbols-outlined" onclick="deleteTask('<?= $task['id'] ?>')">delete</span>
                                                    </div></td>
                                            </tr>
                                        <?php endforeach; endif ?>
                                    </tbody>
                                </table>
                            </li>

                        <?php endforeach; endif ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>
