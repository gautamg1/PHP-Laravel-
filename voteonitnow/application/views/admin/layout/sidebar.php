<div class="sidebar-menu toggle-others fixed">
    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <div class="logo">
                <a href="" class="logo-expanded">
                    <img src="<?php echo BASE_URL; ?>/assets/images/logo@2x.png" width="80" alt="" />
                </a>

                <a href="dashboard-1.html" class="logo-collapsed">
                    <img src="<?php echo BASE_URL; ?>/assets/images/logo-collapsed@2x.png" width="40" alt="" />
                </a>
            </div>

            <div class="mobile-menu-toggle visible-xs">
                <a href="#" data-toggle="mobile-menu">
                    <i class="fa-bars"></i>
                </a>
            </div>
        </header>

        <ul id="main-menu" class="main-menu">
            <li>
                <a href="<?php echo BASE_URL; ?>/categories">
                    <i class="linecons-star"></i>
                    <span class="title">Categories</span>
                </a>
            </li>
            <li>
                <a href="<?php echo BASE_URL.'/admin/polls/showpolls'?>">
                    <i class="linecons-star"></i>
                    <span class="title">Polls</span>
                </a>
            </li>
            <li>
                <a href="<?php echo BASE_URL."/admin/users/getallusers"?>">
                    <i class="linecons-star"></i>
                    <span class="title">Users</span>
                </a>
            </li>
            <li class="has-sub">
                        <a href="#">
                            <i class="linecons-cloud"></i>
                            <span class="title">Questions</span>
                        </a>
                        <ul style="display: none;">
                            <li class="">
                                <a href="#">
                                    <i class="entypo-flow-line"></i>
                                    <span class="title">Questions List With Titles</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="entypo-flow-line"></i>
                                    <span class="title">Questions Details/Statistics</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="entypo-flow-line"></i>
                                    <span class="title">Abusive Questions</span>
                                </a>
                            </li>
                        </ul>
                    </li>
            <li>
                <a href="<?php echo BASE_URL."/admin/users/getallusers"?>">
                    <i class="linecons-star"></i>
                    <span class="title">Configurations</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="linecons-star"></i>
                    <span class="title">Admins</span>
                </a>
            </li>
        </ul>
    </div>
</div>