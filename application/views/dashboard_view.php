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

		<!--Controls-->
		<section class="controls">
			<div class="download">
				<form method='post' action='dashboard/yandex_download'>
					<input type="text" name="dwnpath"  placeholder="Filename">
					<input type="submit" value="Download">
				</form>
			</div>

			<div class="createdir">
				<form method='post' action='dashboard/yandex_crdir'>
					<input name="path" type="text" placeholder="Folder name">
					<input type="submit" value="">
				</form>
			</div>

			<!--Upload-->
			<div class="uploadfile">
				<form method='post' action='dashboard/yandex_upload' enctype='multipart/form-data'>
					<input type="file" name="filename"  multiple>
					<input type='submit' value='Upload'>
				</form>
			</div>
		
			<form method='post'action='?'>
     			<div id="dropZone">
        			Drag your file here for uploading
      			</div>
    		</form> 

    		<!--End Upload-->
    	</section>
    	<!--End Controls>

		<!-- Table -->
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
		<?php endif; ?>		
		</div>
		</div>	
		<!--END Table-->
	</article>
	<!--End Main-->