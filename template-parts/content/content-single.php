<?php
/**
 * post.php
 * The single post content template file.
 */
?>
<div class="container-fluid text-center">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>
					<?php the_title(); ?>
                </h1>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end jumbotron -->

    <div class="post-thumbnail">
        <div class="row">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'full', [ 'class' => 'img-responsive center-block' ] ); ?>
			<?php endif; ?>
        </div> <!-- end row -->

        <!-- Tags if exists -->
        <div class="tag">
	        <?php
	        the_tags( '<span><i class="fa fa-tag"></i> ', ' . ', '</span>' );
	        ?>
        </div> <!-- End Tag(s) if exist -->

    </div> <!-- end post-thumbnail -->
</div> <!-- end container-fluid -->

<div class="single-post container-fluid">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <article class="post-excerpt">
                <header>
					<?php
					// Get the post meta
					benawp_post_meta();
					?>
                </header>
				<?php the_content(); ?>

                <!-- Output the comments templata -->
                <?php comments_template(); ?>

            </article>
        </div> <!-- end col-sm-8 -->
    </div> <!-- end row -->
</div> <!-- end container-fluid -->
