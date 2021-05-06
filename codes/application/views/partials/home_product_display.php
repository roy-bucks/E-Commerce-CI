<div class="all-products-show">
	<?php
	  foreach($data as $value)
	  {  ?>
	<div class="product-show">
		<a href="display_product/<?=$value['id']?>">
			<img src="<?=$value['image1']?>"><br>
			<label class="name"><?=$value['name']?></label><br>
			<label class="price"><?="$".$value['price']?></label>
		</a>
	</div>	
	<?php
	  }  ?>
 </div>

<?php  if(isset($count)){ ?>
<div class="page-section">
<?php 
		if(intval($count) > 12){
			$number_of_page = ceil($count/12);
			for ($i=0; $i<$number_of_page ; $i++) {  ?>
				<div class="pagination">
					<a class="pages" href="<?=$i*12?>"><?=$i+1?></a>
				</div>

<?php		}
		}
?>
</div>
<?php }?>