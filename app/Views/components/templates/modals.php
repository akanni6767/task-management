<!-- Modal -->

<dialog class="modal openTask" aria-hidden="true"> 
    <form class="create_task" method="post" action="<?= base_url("add_task") ?>">
        <header>
        <h3>Add Task</h3>
        </header>
        <article>
        <section id="campaign_wrapper" class="y-thin-scroll-bar">
            <div class="form">
                <div class="form-group">
                    <label for="task_name">Task Name</label>
                    <input type="text" class="form-control" x-bind="handle_event_input" placeholder="Task Name" name="task_name" id="task_name" />
                    <small class="hint">Characters must be atleast 3 characters</small>
                </div>
                
                <div class="form-group all_day">
                    <div class="form-inline" date-rangepicker>
                        <div class="form-group">
                            <label for="estimation_from">Start:</label>
                            <div class="datetime_container">
                                <label for="estimation_from" class="date_wrapper">
                                    <span class="material-symbols-outlined">calendar_today</span>
                                    <input id="estimation_from" datepicker-buttons datepicker-autoselect-today x-bind="handle_event_input" autocomplete="off"
                                    datepicker-orientation="top right" placeholder="Jan 6, 2022" name="estimation_from" type="text" class="bg-transparent shadow-none ring-transparent focus:ring-transparent focus:border-transparent">
                                </label>
                            </div>
                            <small class="hint" data-show="true"></small>
                        </div>
                        <div class="form-group">
                            <label for="estimation_to">To:</label>
                            <div class="datetime_container">
                                <label for="estimation_to" class="date_wrapper">
                                    <span class="material-symbols-outlined">calendar_today</span>                                                      
                                    <input 
                                    datepicker-buttons datepicker-autoselect-today 
                                    x-bind="handle_event_input" autocomplete="off"
                                    id="estimation_to" 
                                    datepicker-orientation="top right" 
                                    placeholder="Jan 20, 2022" 
                                    name="estimation_to" type="text" 
                                    class="bg-transparent shadow-none ring-transparent focus:ring-transparent focus:border-transparent">
                                </label>
                            </div>
                            <small class="hint" data-show="true"></small>
                        </div>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label for="priority">Priority</label>
                    <select id="priority" class="form-control" name="priority">
                        <option value="">Select Priority</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="task_type">Task Type</label>
                    <select id="task_type" class="form-control" name="task_type">
                        <option value="">Select Task Type</option>
                        <option value="Bug">Bug</option>
                        <option value="Feature">Feature</option>
                        <option value="Improvement">Improvement</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea placeholder="Note" x-bind="handle_event_input" class="form-control scrolling-bar" 
                        id="description" name="description" row="30"></textarea>
                    <small class="hint" data-show="true">275 characters left</small>
                </div>
                <div class="form-group invite_user">
                <template x-if="!view_module_invites().length">
                    <p>0 Invites</p>
                </template>
                <template x-if="view_module_invites().length">
                    <ul class="invites_list x-thin-scroll">
                    <template x-for="(invite, index) in view_module_invites()" :key="index">
                        <li>
                        <div class="invite_details">
                            <img :src="invite.image" alt="invite">
                            <p class="invite_name" x-text="invite.name"></p>
                        </div>
                        <span class="material-icons-round">close</span>
                        </li>
                    </template>
                    </ul>
                </template>
                <button class="add_invite" x-on:click.prevent="following_popup=true">Invite <span class="material-icons-round">add</span></button>
                </div>
            </div>

        </section>
        </article>
        <footer>
        <button class="cancel" x-on:click.prevent="calendar_modal = ''">Cancel</button>
        <button class="add" type="submit" x-on:click.prevent="submit_event_form">Add</button>
        </footer>
    </form>
</dialog>
<dialog class="right_modal">
    <div class="task_details" aria-hidden="true">
        <header>
            <div class="back"><span class="material-symbols-outlined">chevron_left</span> Back</div>
        </header>
        <div class="details_content">
            <header><h1 id="d_task_name">KPI and Employee Statistics Page</h1></header>
            <form method="post" class="table_summary">
                <div class="tr">
                    <div class="th"><span class="material-symbols-outlined">adjust</span>Status</div>
                    <div class="td">
                        <span class="material-symbols-outlined progress">play_arrow</span>
                        <em id="d_task_status">On Progress</em>
                    </div>
                </div>
                <div class="tr">
                    <div class="th"><span class="material-symbols-outlined">event_note</span>Due Date</div>
                    <div class="td" id="d_task_date">
                        5 March 2024
                    </div>
                </div>
                <div class="tr">
                    <div class="th"><span class="material-symbols-outlined">groups</span>Assignee</div>
                    <div class="td">
                        <ol class="invites">
                            <li><img src="<?= base_url('images/logo.png') ?>" alt=""></li>
                            <li><span>TG</span></li>
                            <li><span>OP</span></li>
                            <li><img src="<?= base_url('images/logo1.png') ?>" alt=""></li>
                        </ol>
                    </div>
                </div>
                <div class="tr">
                    <div class="th"><span class="material-symbols-outlined">adjust</span>Status</div>
                    <div class="td">
                        <ul class="tag">
                            <li>
                                <div class="type" id="type_color">
                                    <span class="material-symbols-outlined">team_dashboard</span>
                                    <samp id="d_task_type">Dashboard</samp>
                                </div>
                            </li>
                            <li>
                                <div class="priority" id="prior_color"><span id="d_task_prior">Low</span></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tr col">
                    <div class="th"><span class="material-symbols-outlined">text_snippet</span>Description</div>
                    <div class="td">
                        <textarea name="description" id="d_task_desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus, optio! Maiores consequuntur voluptates quis aliquam qui explicabo, eaque voluptatibus hic quo itaque debitis dolorem deleniti neque velit a labore laudantium.</textarea>
                    </div>
                </div>
                <hr>
                <div class="tr">
                    <div class="th"><span class="material-symbols-outlined">stylus</span>Change Status</div>
                </div>
                <hr>
                <div class="tr">
                    <div class="th">Task On Progress</div>
                    <div class="td right">
                        <div class="all_day_switch">
                            <input type="radio" hidden name="all_day" value="In Progress" id="Progress">
                            <label for="Progress"></label>
                        </div>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">Task In Review</div>
                    <div class="td right">
                        <div class="all_day_switch">
                            <input type="radio" hidden value="On Pending" name="all_day" id="Review">
                            <label for="Review"></label>
                        </div>
                    </div>
                </div>
                <div class="tr">
                    <div class="th">Task Complete</div>
                    <div class="td right">
                        <div class="all_day_switch">
                            <input type="radio" hidden name="all_day" value="Completed" id="Complete">
                            <label for="Complete"></label>
                        </div>
                    </div>
                </div>
                <div class="tr">
                    <div class="th"></div>
                    <div class="td right">
                        <button type="submit">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</dialog>

