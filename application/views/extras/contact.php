<style type="text/css">

	.inner-header {
		background-image: url('/assets/styles/images/resource/mslider3.jpg');
		background-repeat: no-repeat;
		background-size: cover;
		padding-top: 108px;

	}
	.tag_name {
		color: #ddd !important;
	}
	.tag-other {
		color: #ddd !important;
	}


</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />


<section>
    <div class="inner-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner2">
                        <div class="inner-title2">
                            <h3 class="tag_name">Contact</h3>
                            <span class="tag-other">Keep up to date with the latest news</span>
                        </div>
                        <div class="page-breacrumbs">
                            <ul class="breadcrumbs">
                                <li><a class="tag-other" href="#" title="">Home</a></li>
                                <li><a class="tag-other" href="#" title="">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 column">
                    <div class="contact-form">
                        <h3>Keep In Touch</h3>


						<form id="contact_details_form">

							  <div class="row">
								  <div class="col-lg-12 credentials-label sign-up-success mb-2" id="reset_success_message">
									  <i class="fas fa-check-circle d-no"></i>
									  <div class=""><p></p></div>
								  </div>
								  <div class="col-lg-12 credentials-label mb-2" id="reset_error_message">
									  <i class="fas fa-times-circle d-no"></i>
									  <div class=""><p></p></div>
								  </div>



                                <div class="col-lg-12">
                                    <span class="pf-title">Full Name</span>
                                    <div class="pf-field">
                                        <input type="text" placeholder="" id="full_name" name="full_name"  data-bv-field="full_name"/>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <span class="pf-title">Email</span>
                                    <div class="pf-field">
										<input type="text" placeholder="" id="email" name="email"  data-bv-field="email"/>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <span class="pf-title">Subject</span>
                                    <div class="pf-field">
                                      <input type="text" placeholder="" id="subject" name="subject"  data-bv-field="subject"/>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <span class="pf-title">Message</span>
                                    <div class="pf-field">
                                        <textarea  name="message" id="message"  data-bv-field="message"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 row " style="margin: 12px">
									<div class="g-recaptcha"  data-sitekey="6LerJLEZAAAAANSWuQCrAp1-GLyZPcYZt1HtCHmy"></div>

									  <button type="submit" id="btnSubmit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 column">
                    <div class="contact-textinfo">
                        <h3>RbJobs Office</h3>
                        <ul>
                            <li><i class="la la-map-marker"></i><span>Level 06, East Tower, World Trade Center,Sri Lanka</span></li>
                            <li><i class="la la-phone"></i><span><a href="tel:+94 112333654">Call Us : +94 112333654 </a></span></li>
                            <!--                            <li><i class="la la-fax"></i><span>Fax : +94 112333654</span></li>-->
                            <li><i class="la la-envelope-o"></i><span><a href="mailto:info@redberylit.com">Email : info@redberylit.com</a></span></li>
                        </ul>
                        <a class="fill" href="#" title="" data-backdrop="static" data-toggle="modal" data-target="#myModal"> See on Map</a>
<!--						<a class="btn btn-info btn-lg" data-backdrop="static" data-toggle="modal" data-target="#myModal">Enlarge map </a>-->

<!--						<a href="#" title="">Directions</a>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-------------------------------------------------MAP Google Model------------------------------------------------------------------>

<!--<div class="containter">-->
<!--	<div class="row">-->
<!--		<div class="col-md-12">-->
<!--			<div id="map"></div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!---->
<!--- modal  -->
<!--<div id="map"  ></div>-->
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				RbJobs Location
			</div>
			<div id="map" style="height: 400px;  outline: none; text-align: center; position: relative;"  class="modal-body">
<!--				<div id="map" style="width: 450px; height: 400px;  outline: none; text-align: center;" ></div>-->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>

<?php $this->load->view('general/login_popup')?>

<!--Sign up pop up-->
<?php $this->load->view('general/signup_popup')?>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>

<script type="text/javascript">

	var map = L.map('map').setView([6.9327, 79.8438], 15);

	L.marker([6.9327, 79.8438]).addTo(map);

	L.tileLayer('https://api.maptiler.com/maps/streets/{z}/{x}/{y}.png?key=rhA62JdO2ZzepnX5gTTw', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
		maxZoom: 18,
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1,
		accessToken: 'your.mapbox.access.token'

	}).addTo(map)

	var circle = L.circle([6.9327, 79.8438], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 150
	}).addTo(map);
	var marker = L.marker([6.9327, 79.8438], {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5,
		radius: 150
	}).addTo(map);
	// marker.bindPopup("<b>RbJobs Location</b>").openPopup();
	// Comment out the below code to see the difference.
	$('#myModal').on('shown.bs.modal', function() {
		map.invalidateSize();
	});




</script>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>
