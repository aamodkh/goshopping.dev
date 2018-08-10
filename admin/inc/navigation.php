<!-- Navigation -->
<?php 
    $current_page = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="dashboard">Goshopping Admin</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['email_address'];?><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="<?php echo ($current_page == 'dashboard') ? 'active' : '';?>">
                <a href="dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>

            <li class="<?php echo ($current_page == 'banner' || $current_page == 'banner-add' || $current_page == 'pages') ? 'active' : '';?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#home"><i class="fa fa-fw fa-users"></i> Home Management <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="home" class="collapse">
                    <li>
                        <a href="banner">Banners</a>
                    </li>
                    <li>
                        <a href="pages">Pages</a>
                    </li>
                </ul>
            </li>
            

            <li class="<?php echo ($current_page == 'user' || $current_page == 'user-add' || $current_page == 'user-list') ? 'active' : '';?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#user"><i class="fa fa-fw fa-users"></i> User Management <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="user" class="collapse">
                    <li>
                        <a href="user-add">User Add</a>
                    </li>
                    <li>
                        <a href="user-list">List Users</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($current_page == 'category' || $current_page == 'category-add' || $current_page == 'category-list') ? 'active' : '';?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#category"><i class="fa fa-fw fa-list"></i> Category Management <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="category" class="collapse">
                    <li>
                        <a href="category-add">Category Add</a>
                    </li>
                    <li>
                        <a href="category-list">List Category</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($current_page == 'product' || $current_page == 'product-add' || $current_page == 'product-list') ? 'active' : '';?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#product"><i class="fa fa-shopping-basket"></i> Product Management <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="product" class="collapse">
                    <li>
                        <a href="product-add">Product Add</a>
                    </li>
                    <li>
                        <a href="product-list">List Product</a>
                    </li>
                </ul>
            </li>

            <li class="<?php echo ($current_page == 'ads' || $current_page == 'ads-add' || $current_page == 'ads-list') ? 'active' : '';?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#ads"><i class="fa fa-fw fa-dollar"></i> Ads Management <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="ads" class="collapse">
                    <li>
                        <a href="ads-add">Product Add</a>
                    </li>
                    <li>
                        <a href="ads-list">List Product</a>
                    </li>
                </ul>
            </li>
			
			<li class="<?php echo ($current_page == 'order') ? 'active' : '';?>">
                <a href="order"><i class="fa fa-fw fa-shopping-cart"></i> Order List</a>
            </li>
			
			<li class="<?php echo ($current_page == 'request') ? 'active' : '';?>">
                <a href="request"><i class="fa fa-fw fa-heart"></i> Wish List</a>
            </li>
			<li class="<?php echo ($current_page == 'subscriber') ? 'active' : '';?>">
                <a href="subscriber"><i class="fa fa-fw fa-envelope"></i> Subscriber List</a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>