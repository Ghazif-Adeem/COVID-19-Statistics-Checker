<?php

# Author: Ghazif Adeem 
# Github: https://github.com/Ghazif-Adeem

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://covid19.mathdro.id/api/countries');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


$result = curl_exec($ch);

$Countries = json_decode($result, true);

if(isset($_GET['country']) && !empty($_GET['country'])) {

	curl_setopt($ch, CURLOPT_URL, 'https://covid19.mathdro.id/api/countries/' . urlencode($_GET['country']));
	$result = curl_exec($ch);
	$data = json_decode($result, true);

	curl_setopt($ch, CURLOPT_URL, 'https://covid19.mathdro.id/api');
	$MainApi = curl_exec($ch);
	$totalStatistics = json_decode($MainApi, true);

}

?>


<body>
	<form>
		<select name="country">
			<?php foreach($Countries['countries'] as $key => $value): ?>
				<option value="<?php echo $value; ?>">
					<?php echo $key ?>		
				</option>
			<?php endforeach; ?>
		</select>
		<button type="submit">Get Stats</button>
	</form>

	<?php if(!empty($data)): ?>
			<h4>Statistics of Country - Code: <?php echo $_GET['country']; ?></h4>
			<ul>
				<li>Infected - <?php echo number_format($data['confirmed']['value']) ?></li>
				<li>Recovered - <?php echo number_format($data['recovered']['value']) ?></li>
				<li>Death(s) - <?php echo number_format($data['deaths']['value']) ?></li>
				<li>Last Updated @ <?php echo $data['lastUpdate'] ?></li>
			</ul>
			<!-- <hr>
			<h4>Worldwide</h4> -->
			<!-- <ul>
				<li>Total Confirmed - <?php echo $totalStatistics['confirmed']['value'] ?></li>
				<li>Total Recovered - <?php echo $totalStatistics['recovered']['value'] ?></li>
				<li>Total Deaths - <?php echo $totalStatistics['deaths']['value'] ?></li>
				<li>Last Updated @ <?php echo $totalStatistics['lastUpdate'] ?></li>
			</ul> -->
		<?php endif; ?>
		<hr>
		<h4>Worldwide</h4>
		<img class='text-center' src='https://covid19.mathdro.id/api/og' height="400px" width="1050px" />
		<div id="googleMap" style="width:100%;height:400px;"></div>

<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4qRhndTcLePR-xEKKFyKa3126kajCs7g&callback=myMap"></script>
</body>