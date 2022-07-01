<table>
        <?php
        foreach ($pages as $a)
        {
            echo '<tr><td><a href="/public/'.$a->link.'">'.$a->title.'</a></td></tr>';
        }
        ?>
</table>