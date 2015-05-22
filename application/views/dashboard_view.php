<?php if(Session::get('loggedIn') == true):?>	
<?php $username = Session::get('username');?>
<?php $yatocken = Session::get('yatoken');?>
<?php endif; ?>		
<article id="main" class="container">
		<header class="aboutcloud">
			<h2>Welcome <?php echo ucfirst($username); ?> </h2>
			<hr>
		<?php if($yatocken == null): ?>
			<p>Here you can connect to Yandex Disk, Google Drive</p>
			<a href="dashboard/yandex_connect">Connect to Yandex Disk</a>	
		<?php else: ?>
			<?php echo $yatocken; ?>
		<?php endif; ?>			
		</header>

		<!--Upload-->
		<input type="file" multiple>

		<form action="?">
     		<div id="dropZone">
        		Drag your file here for uploading
      		</div>
    	</form>  
    	<!--End Upload-->

		<!-- Table -->
		<section class="box">
			<h3>Yandex Disk</h3>
			<div class="table-wrapper">
				<table>
					<thead>
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Something.jpg</td>
							<td>Ante turpis integer aliquet porttitor.</td>
							<td>29.04.2015</td>
						</tr>
						<tr>
							<td>Nothing.docx</td>
							<td>Vis ac commodo adipiscing arcu aliquet.</td>
							<td>19.05.2015</td>
						</tr>
						<tr>
							<td>Something</td>
							<td> Morbi faucibus arcu accumsan lorem.</td>
							<td>29.09.2024</td>
						</tr>
						<tr>
							<td>Nothing</td>
							<td>Vitae integer tempus condimentum.</td>
							<td>19.02.2015</td>
						</tr>
						<tr>
							<td>Something</td>
							<td>Ante turpis integer aliquet porttitor.</td>
							<td>01.01.2015</td>
						</tr>
					</tbody>
				</table>
			</div>

						
		</section>
		</div>
		</div>
				
		<!--END Table-->
	</article>
	<!--End Main-->