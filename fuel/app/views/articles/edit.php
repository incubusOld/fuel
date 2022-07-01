<h2>Editing <span class='muted'>Article</span></h2>
<br>

<?php echo render('articles/_form'); ?>
<p>
	<?php echo Html::anchor('articles/view/'.$article->id, 'View'); ?> |
	<?php echo Html::anchor('articles', 'Back'); ?></p>
