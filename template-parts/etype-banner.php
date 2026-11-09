<?php

$title = $args['title'] ?? 'Welcome';
$desc  = $args['desc'] ?? '';
$image = $args['image'] ?? 'assets/images/background-banner.jpg';

?>

<section class="mainbanner" style="background-image: url('<?php echo esc_url($image); ?>')">
    <div class="container">
        <h1><?php echo esc_html($title); ?></h1>
        <div class="mainbanner__desc">
            <?php echo wp_kses_post($desc); ?>
        </div>
    </div>
</section>