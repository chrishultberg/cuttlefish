<?php

foreach ($this->models as $model):
	printf("<article>
		<h2><a href='%s'>%s</a></h2>
		%s
		</article>", $model->link, $model->title, $model->content);
endforeach;

echo "<p><a href='" . Url::index('/archive') . "'>&#171; Older articles</a></p>";
