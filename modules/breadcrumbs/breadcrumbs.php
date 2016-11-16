<?php function telabotanica_module_breadcrumbs($data) {

  // Supporte les microdonnées Schema.org
  // cf. https://schema.org/BreadcrumbList

  // Génération des items selon le type de page courante

  // Article seul
  if ( is_single() ) :

    $category = get_the_category();
    $data->items = ['home'];

    if ( count($category) > 0 ) {
      $category = $category[0];

      // Catégorie parente
      if ( $category->parent ) {
        $category_parent = get_category( $category->parent );
        $data->items[] = [ 'href' => get_category_link( $category_parent ), 'text' => $category_parent->name ];
      }

      // Catégorie de l'article
      $data->items[] = [ 'href' => get_category_link( $category ), 'text' => $category->name ];
    }

    // Article courant
    $data->items[] = [ 'text' => get_the_title() ];

  // Page
  elseif ( is_page() ) :

    $data->items = ['home'];

    // Page parente
    if ( get_current_page_depth() > 0 ) {
      $page_parent = wp_get_post_parent_id( get_the_ID() );
      $page_parent = get_post( $page_parent );
      $data->items[] = [ 'href' => get_permalink( $page_parent ), 'text' => $page_parent->post_name ];
    }

    // Page courante
    $data->items[] = [ 'text' => get_the_title() ];


  // Archive
  elseif ( is_archive() ) :

    $category = get_category( get_query_var('cat') );
    $data->items = ['home'];

    // Catégorie parente
    if ( $category->parent ) {
      $category_parent = get_category( $category->parent );
      $data->items[] = [ 'href' => get_category_link( $category_parent ), 'text' => $category_parent->name ];
    }

    // Catégorie courante
    $data->items[] = [ 'text' => $category->name ];

  endif;

  if ( isset($data->items) ):

    echo '<ol class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';

    foreach ($data->items as $i => $item) :

      if ( $item === 'home' ) {
        $item = array(
          'href' => site_url(),
          'text' => __( 'Accueil', 'telabotanica' )
        );
      }

      $item = (object) $item;

      if (!isset($item->modifiers)) $item->modifiers = '';
      if (!isset($item->text)) $item->text = 'Page';

      echo '<li class="breadcrumbs-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';

      if ( isset($item->href) ) :

        $is_last = ( $i + 1 === count( $data->items ) );

        echo '<a href="' . $item->href . '" class="' . $item->modifiers . '"' . ( $is_last ? ' tabindex="-1"' : '' ) . ' itemprop="item">';
        echo '<span itemprop="name">' . $item->text . '</span>';
        echo '<meta itemprop="position" content="' . ($i + 1) . '" />';
        echo '</a>';

      else :

        echo $item->text;

      endif;

      echo '</li>';

    endforeach;

    echo '</ol>';

  endif;

}