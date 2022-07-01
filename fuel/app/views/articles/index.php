<h2>Наши <span class='muted'>новости</span></h2>
<br>
<?php if ($articles): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Body</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($articles as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->body; ?></td>
			<td>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
<table>
    <tr>
        <?php
        $i=0;
        while ($i < $pages_num) {
            ++$i;
            echo '<td><a href="/public/news/'.$i.'"> '.$i.'</a></td>';
        }
        ?>
    </tr>
</table>

<?php else: ?>
<p>No Articles.</p>

<?php endif; ?>
