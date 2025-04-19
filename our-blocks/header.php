<header class="site-header">
  <div class="container">
    <h1 class="school-logo-text float-left"><a href="<?php echo site_url() ?>"><strong>Fictional</strong> University</a>
    </h1>
    <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
    <div class="site-header__menu group">
      <nav class="main-navigation">
        <ul>
          <li class="page-item"><a href="<?php echo esc_url(site_url('/')); ?>">Home</a></li>
          <li class="page-item"><a href="<?php echo esc_url(site_url('/sample-page')); ?>">About</a></li>
          <li class="page-item"><a href="<?php echo esc_url(site_url('/events')); ?>">Events</a></li>
          <li class="page-item"><a href="https://signup.westsoundbrewers.com/">Join WSB Club</a></li>
          <?php if (is_user_logged_in()) { ?>
            <li class="page-item"><a href="<?php echo wp_logout_url(); ?>"
                class="btn btn--small  btn--dark-orange float-left btn--with-photo">
                <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span>
                <span class="btn__text">Log Out</span>
              </a></li>
          <?php } else { ?>
            <li class="page-item"><a href="<?php echo wp_login_url(); ?>"
                class="btn btn--small btn--orange float-left push-right">Login</a>
            </li>
            <li class="page-item"><a href="<?php echo wp_registration_url(); ?>"
                class="btn btn--small  btn--dark-orange float-left">Register</a></li>
          <?php } ?>

        </ul>
      </nav>
    </div>
  </div>
</header>