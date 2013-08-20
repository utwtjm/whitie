<? add_tinymce_js(); ?>
<form method="post" action="<?php echo web_url('/test_editor_service/result'); ?>">
    <?php echo $editor1; ?>
    <?php echo $editor2; ?>
    <input type="submit" value="送出">
</form>