<?php
$postId = get_the_ID();
if($postId != null){
    if(comments_open($postId)) {
?>
    <div id="pixie-comments">
        <div class="write-comment">
            <div class="content">
                <di class="form-comment">
                    <?php
                    $fields = [
                        'author' => '<div class="comment-form-author">' .
                                    '<label for="author">Pseudo : <span class="required">*</span></label> ' .
                                    '<input id="author" name="author" type="text" aria-required="true" />' .
                                    '</div>',
                        'email' =>  '<div class="comment-form-email">' .
                                    '<label for="email">Email : <span class="required">*</span></label> ' .
                                    '<input id="email" name="email" type="text" aria-required="true" />' .
                                    '</div>',
                    ];
                    $argsCommentForm = [
                        'title_reply' =>            "Laisser un commentaire",
                        'comment_notes_before' =>   "",
                        'fields' =>                 apply_filters('comment_form_default_fields', $fields),
                        'comment_field' =>          '<div class="comment-form-comment">' .
                                                    '<label for="comment">Commentaire : <span class="required">*</span></label>' .
                                                    '<textarea id="comment" name="comment" aria-required="true"></textarea>' .
                                                    '</div>',
                        'submit_field' =>           '<div class="form-submit">%1$s %2$s</div>',
                        'logged_in_as' =>           '<div class="logged-in-as"><label>Identifié comme : </label>' .
                                                    '<a class="link-identity" href="' . admin_url('profile.php') . '">' . $user_identity . '</a> ' .
                                                    '<a class="link-deconnexion" href="' . wp_logout_url(apply_filters('the_permalink', get_permalink())) . '" title="Se déconnecter de ce compte">Se déconnecter</a>' .
                                                    '</div>',
                        'title_reply_to' =>         'Répondre à : %s',
                        'cancel_reply_link' =>      'Annuler la réponse',
                    ];
                    comment_form($argsCommentForm, $postId);
                    ?>
                </di>
            </div>
        </div>
        <?php if(have_comments()){ ?>
        <div class="read-comments">
            <div class="content">
                <div class="texte-comments">Commentaires</div>
                <div class="list-comments">
                    <ul>
                        <?php
                        wp_list_comments([
                            'reverse_top_level' => true,
                            'reverse_children'  => true,
                            'per_page'          => 3,
                        ]);
                        ?>
                    </ul>
                </div>
                <div class="pagination-comments">
                    <?php paginate_comments_links([
                        'prev_text' => '<div class="pagination-prev"></div>',
                        'next_text' => '<div class="pagination-next"></div>',
                    ]); ?>
                </div>
            </div>
        </div>
            <?php } ?>
    </div>
<?php
    }
}
