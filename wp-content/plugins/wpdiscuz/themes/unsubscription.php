<?php
if (!defined("ABSPATH")) {
    exit();
}

get_header();
?>
<div style="margin: 0 auto; padding: 50px 0" class="wpdc-unsubscription-main">
    <h2 class="wpdc-unsubscription-message">
        <?php
        global $wpDiscuzSubscriptionMessage;
        $wpdiscuz = wpDiscuz();
        esc_html_e($wpDiscuzSubscriptionMessage);
        ?>
    </h2><br>
    <?php
    $currentUser = WpdiscuzHelper::getCurrentUser();
    $userEmail = isset($_COOKIE["comment_author_email_" . COOKIEHASH]) ? $_COOKIE["comment_author_email_" . COOKIEHASH] : "";
    if ($currentUser->exists()) {
        $userEmail = $currentUser->user_email;
    }

    if ($userEmail) {
        ?>
        <div class="wpdc-unsubscription-bulk">
            <a href="<?php echo site_url("/wpdiscuzsubscription/bulkmanagement/"); ?>" class="wpdc-unsubscription-manage-link">
                <?php esc_html_e($wpdiscuz->options->getPhrase("wc_user_settings_email_me_delete_links")) ?>
            </a>( <?php esc_html_e($userEmail);?> )
            <div class="wpdc-unsubscription-manage-link-desc">
                <?php esc_html_e($wpdiscuz->options->getPhrase("wc_user_settings_email_me_delete_links_desc")) ?>
            </div>
        </div>
    </div>
    <?php
}
get_footer();
