<?php function telabotanica_module_header($data) { ?>
<header class="header" role="banner">
  <div class="header-fixe">
    <?php if ( is_front_page() && is_home() ) : ?>
      <h1 class="header-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Tela Botanica</a></h1>
    <?php else : ?>
      <div class="header-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Tela Botanica</a></div>
    <?php endif; ?>
    <?php if ( has_nav_menu('secondaire') ) : ?>
      <nav class="header-nav" role="navigation"  aria-label="<?php esc_attr_e( 'Menu secondaire', 'telabotanica' ); ?>">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'secondaire',
            'menu_class'     => 'header-nav-items',
            'depth'          => 1,
           ) );
        ?>
      </nav>
    <?php endif; ?>
    <ul class="header-liens">
      <?php if ( is_user_logged_in() ) :
        $current_user = wp_get_current_user();
        $avatar_url = get_avatar_url($current_user->ID, array('size' => 22)); ?>
        <li class="header-liens-item header-liens-item-utilisateur">
          <a href="<?php echo admin_url(); ?>">
            <span class="header-liens-item-texte">
              <?php echo $current_user->display_name; ?>
              <span class="header-liens-item-utilisateur-avatar" style="background-image: url(<?php echo $avatar_url ?>);"></span>
            </span>
          </a>
        </li>
      <?php else : ?>
        <li class="header-liens-item header-liens-item-login"><a href="<?php echo wp_login_url( get_permalink() ); ?>"><span class="header-liens-item-texte">Connexion</span></a></li>
      <?php endif; ?>
      <li class="header-liens-item"><a href="#"><span class="header-liens-item-texte">EN</span></a></li>
      <li class="header-liens-item header-liens-item-don"><a href="#">Faites un don !</a></li>
      <li class="header-liens-item header-liens-item-recherche"><a href="<?php echo get_search_link(); ?>"><span class="header-liens-item-texte">🔎</span></a></li>
    </ul>
  </div>
  <?php if ( has_nav_menu('principal') ) : ?>
    <nav class="header-nav-usages" role="navigation" aria-label="<?php esc_attr_e( 'Menu principal', 'telabotanica' ); ?>">
      <?php
        wp_nav_menu( array(
          'theme_location' => 'principal',
          'menu_class'     => 'header-nav-usages-items',
          'depth'          => 1,
         ) );
      ?>
    </nav>
  <?php endif; ?>
</header>
<?php }
