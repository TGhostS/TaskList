<div id="main">

		<?php foreach($content as $row) :?>
			<div style='margin:10px;border-bottom:2px solid #c2c2c2'>
						<p style='font-size:18px'><?php echo $row['title'];?></p>
						<p><?php echo $row['date'];?></p>
						<p><img style='margin-right:5px' width='150px' align='left' src='<?php echo $row['img_src'];?>'><?php echo $row['discription'];?></p>
						<p style='color:red'><a href='?option=view&id_text=<?php echo $row['id'];?>'>Читать далее...</a></p>
					
					</div>
					
		<?php endforeach;?>
		</div>
			</div>