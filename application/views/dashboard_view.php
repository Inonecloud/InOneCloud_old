<?php if(Session::get('loggedIn') == true):?>	
<?php $username = Session::get('username');?>
<?php $yatocken = Session::get('yatoken');?>
<?php $dirContent = Session::get('dirContent');?>
<?php $diskSpace = Session::get('diskSpace');?>
<?php endif; ?>		

<article id="main" class="container">
		<header class="aboutcloud">
			<h2>Welcome <?php echo ucfirst($username); ?> </h2>
			<hr>
		<?php if($yatocken == null): ?>
			<p>Here you can connect to Yandex Disk, Google Drive</p>
			<a href="dashboard/yandex_connect">Connect to Yandex Disk</a>	
		<?php else: ?>
			<?=$yatocken?>
		<?php endif; ?>			
		</header>

		<?php if($yatocken != null): ?>

		<h3>Yandex Disk</h3>
		

		
		<p>All Space: <?=round(($diskSpace['availableBytes'] + $diskSpace['usedBytes']) / 1024 / 1024 / 1024, 2)?> Gbytes</p>
		<p>Free Space: <?=round(($diskSpace['availableBytes'])/ 1024 / 1024 / 1024, 2)?> Gbytes</p>

		<form method='post' action='dashboard/yandex_download'>
			<input type="text" name="dwnpath"  placeholder="File name">
			<input type="submit" value="Download">
		</form>

		<form method='post' action='dashboard/yandex_crdir'>
			<input name="path" type="text" placeholder="Directory name">
			<input type="submit" value="Create Directory">
		</form>


		<!--Upload-->
		<form method='post' action='dashboard/yandex_upload' enctype='multipart/form-data'>
			<input type="file" name="filename"  multiple>
			<input type='submit' value='Upload'>
		</form>
		
		<form method='post'action='?'>
     		<div id="dropZone">
        		Drag your file here for uploading
      		</div>
    	</form>  
    	<!--End Upload-->

		<!-- Table -->
		<section class="box">
			<div class="table-wrapper">
				<table>
					<thead>
						<tr>
							<th></th>
							<th>Name</th>
							<th>Description</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($dirContent as $dirItem) 
		    				if ($dirItem['resourceType'] === 'dir') 
		       					 echo '<tr>
		       							<td><input type="checkbox"></td>
		       							<td>'. $dirItem['displayName'] .'</td>
		       							<td>Directory </td>
		       							<td>'. date('d-m-Y H:i:s', strtotime($dirItem['creationDate'])) . '</td>
		       							</tr>';
		     				else 
		       					 echo '<tr>
		       							<td><input type="checkbox"></td>
		       							<td>' . $dirItem['displayName'] . '</td>
		       							<td> Size ' . intval($dirItem['contentLength']/1024) . ' KBytes</td>
		       							<td> '.$dirItem['public_url'] . date('d-m-Y H:i:s', strtotime($dirItem['creationDate'])) .'</td>
		       							</tr>';    
		       			?>
					</tbody>
				</table>
			</div>						
		</section>
		<?php endif; ?>		
		</div>
		</div>
				
		<!--END Table-->
	</article>
	<!--End Main-->