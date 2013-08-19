<!-- Place this in the body of the page content -->
<form method="post" action="<?php echo web_url('/test_editor_service/result'); ?>">
    <?php echo $editor; ?>
    <input type="submit" value="送出">
</form>