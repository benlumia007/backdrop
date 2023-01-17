<?php
/**
 * Comments
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-theme
 */

/**
 * Define namespace
 */
namespace Backdrop\Theme\Comments;

class Component {
	public static function display_comments_list( $comment, $args, $depth ) { ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children' ] ) ? '' : 'parent' ); ?>>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<header class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( $args[ 'avatar_size' ] != 0 ) : ?>
						<?php echo get_avatar( $comment, $args[ 'avatar_size' ] ); ?>
						<cite class="fn"><?php echo get_comment_author_link(); ?></cite>
						<div class="comment-metadata">
							<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
								<?php
								/* translators: 1: date, 2: time */
								printf( __('%1$s at %2$s'),
									get_comment_date(),
									get_comment_time()
								);
								?>
							</a>
							<span class="reply">
                                    <?php
									comment_reply_link( array_merge( $args, [
										'add_below' => 'div-comment',
										'depth'     => $depth,
										'max_depth' => $args['max_depth']
									] ) );
									?>
                                </span>
							<?php
							if ( $comment->comment_approved == '0' ) { ?>
								<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php
							} ?>
						</div>
					<?php endif ?>
				</div>
			</header>
			<div class="comment-content">
				<?php comment_text(); ?>
			</div>
		</div>
	<?php }
}
