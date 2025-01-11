<?= $this->extend("components/layout/app.php"); ?>

<?= $this->section('content') ?>
    <header>
        <div class="search_bar">
            <label for="search_bar" class="icon material-symbols-rounded">search</label>
            <input type="text" id="search_bar">
        </div>
        <div class="notification_settings">
            <span class="icon material-symbols-rounded">notifications_active</span>
            <span class="icon material-symbols-rounded">settings</span>
            <span class="icon material-symbols-rounded">mark_chat_unread</span>
        </div>
    </header>
    <div class="main_content y-thin-scroll-bar">
        <header>
            <span class="task_mark icon material-symbols-rounded">task_alt</span>
            <h2>My Tasks</h2>
        </header>
        

        <?php if(session()->has("message")) : ?>
            <div class="error_container">
                <ul class="error_message">
                    <?php $e=0; foreach(session()->get("message") as $key => $error): ?>
                        <li><?= ++$e ." ". $error?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif ?>
        <div class="task_control_bar">
            <div class="task_view">
                <label for="grid">
                    <input type="radio" name="view" hidden checked id="grid">
                    <div><span class="icon material-symbols-outlined">widget_medium</span><span class="text">Grid View</span> </div>
                </label>
                <label for="list">
                    <input type="radio" name="view" hidden id="list">
                    <div><span class="icon material-symbols-outlined">list</span><span class="text">List</span> </div>
                </label>
            </div>
            <div class="task_control">
                <div class="search_task">
                    <label for="search_task" class="icon material-symbols-outlined">search</label>
                    <input type="text" id="search_task" placeholder="Search Task">
                </div>
                <span class="separator"></span>
                <button class="task_filter"><span class="icon material-symbols-outlined">filter_alt</span><span class="text">Filter</span> </button>
                <button onclick="openAddTask()" class="add_task_btn"><span class="icon material-symbols-outlined">add</span> <span class="text">Add Task</span> </button>
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
                            $tasks = $alltask;?>

                            <li>
                                <header>
                                    <span class="icon material-symbols-rounded">keyboard_arrow_down</span>
                                    <div class="task_label">
                                        <span class="task_label_indicator <?= $indicator[$key]; ?>"></span>
                                        <h4 class="task_status"><?= $key ?></h4>
                                        <span class="task_count"><?= count($tasks) ?></span>
                                    </div>
                                </header>
                                <div class="table_wrapper x-scroll-bar">
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
                                                                <span class="icon material-symbols-outlined">team_dashboard</span>
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
                                                            <span class="icon material-symbols-outlined" onclick="deleteTask('<?= $task['id'] ?>')">delete</span>
                                                        </div></td>
                                                </tr>
                                            <?php endforeach; endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </li>

                    <?php endforeach; else: ?>
                        <li class="no_task">
                            <h1><span class="icon material-symbols-rounded">cloud_off</span>No Task Yet</h1>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
