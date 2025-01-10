
<div class="sidebar_wrapper">
    <header>
        <div class="sidebar_collapse">
            <span class="material-symbols-rounded">keyboard_double_arrow_left</span>
        </div>
        <div class="auth_details">
            <img src="<?= base_url('images/logo.png') ?>" alt="image_profile" class="auth_pic">
            <div class="profile_name_email">
                <h4 class="name"><?=$user->username?></h4>
                <span class="pro_email"><?=$user->email?></span>
            </div>
        </div>
    </header>
    <div class="sidebar_list">
        <ul>
            <li>
                <a href="#">
                    <span class="material-symbols-rounded">dashboard</span>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="material-symbols-rounded">task</span>
                    My Tasks
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="material-symbols-rounded">notifications</span>
                    Notifications
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="material-symbols-rounded">settings</span>
                    Settings
                </a>
            </li>
        </ul>
    </div>
</div>