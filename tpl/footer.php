<div id='bottom'>
		<div class="toplinks" style="padding-left:127px;">
					<a href="?option=main">Главная</a></div>
				<div class="sap2">::</div>
		<?php $i = 1;?>
		<?php foreach($menu_top as $item) :?>
			<div class='toplinks'><a href='?option=menu&id_menu=<?php echo $item['id_menu']?>'><?php echo $item['name_menu']?></a></div>
				
				<?php if($i != count($menu_top)) :?>
					<div class='sap2'>::</div>
				<?php endif;?>
				<?php $i++;?>
		<?php endforeach; ?>
		</div>
		            <div class="copy"><span class="style1"> Copyright 2010 Название сайта </span>

		</div>
	</div>
</center></body></html>