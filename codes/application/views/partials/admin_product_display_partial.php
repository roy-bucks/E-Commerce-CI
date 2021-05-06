<table>
		<tr>
			<th>Picture</th>
			<th>ID</th>
			<th>Name</th>
			<th>Inventory Count</th>
			<th>Quntity Sold</th>
			<th>action</th>
		</tr>
<?php
  foreach($data as $value)
  {  ?>
		<tr>
			<td><img class="product-image" src="<?=$value['image1']?>"></td>
			<td><?=$value['id']?></td>
			<td><?=$value['name']?></td>
			<td><?=$value['quantity']?></td>
			<td>0</td>
			<td><a href="/shops/edit/<?=$value['id']?>"><img class="edit-icon" src="/assets/img/edit.png"></a>  <a href="/shops/delete_product/<?=$value['id']?>" id="delete_product"><img class="delete-icon" src="/assets/img/delete.ico" ></a></td>
		</tr>
<?php
  }  ?>

</table>
<?php  if(isset($count)){ ?>
<div class="page-section">
<?php 
		if(intval($count) > 5){
			$number_of_page = ceil($count/5);
			for ($i=0; $i<$number_of_page ; $i++) {  ?>
				<div class="pagination">
					<a class="pages" href="/shops/display_admin_product_data/<?=$i*5?>"><?=$i+1?></a>
				</div>

<?php		}
		}
?>
</div>
<?php }?>