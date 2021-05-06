<ul>
	<li id="all" class="category"><a href="/shops/display/display_all" id="category_link" value='all'>Display All</a></li>
<?php
  foreach($data as $value)
  {  ?>
	<li id="<?=$value['category']?>"><a href="/shops/display/<?=$value['category']?>" id="category_link" value="<?=$value['category']?>"><?=$value['category']."(".$value['product_count'].")"?> </a></li>
<?php
  }  ?>

</ul>
