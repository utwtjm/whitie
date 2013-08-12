<div class="navbar navbar-fixed-top" style="top:39px;">

<div class="divider-horizontal"></div>

<ul class="breadcrumb">
<?php if(count($breadcrumbs) >= 0): ?>
	<li>
		<a href="<?php echo web_url() ?>">首頁</a>
		<?php if(count($breadcrumbs) >= 1): ?>
			<span class="divider">/</span>
		<?php endif; ?>
	</li>
<?php endif; ?>


<?php foreach($breadcrumbs as $breadcrumb_index => $breadcrumb): ?>

		<?php if($breadcrumb_index == count($breadcrumbs) - 1): ?>
			<li class="active"><?php echo $breadcrumb['title']; ?></li>
		<?php else: ?>
			<li><a href="<?php $breadcrumb['url']?>"><?php echo $breadcrumb['title']?></a> <span class="divider">/</span></li>
		<?php endif; ?>

<?php endforeach; ?>
</ul>

</div>

