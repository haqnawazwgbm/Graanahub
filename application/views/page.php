<?php include_once('includes/header.php'); ?>
<section class="blog-main">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="heading-all">
					<h2><?= $page['title']; ?></h2>
				</div>
				<div class="blog-img">
					<!-- <div class="blog-img-main">
						<img src="assets/img/bg1.jpg" alt="">
					</div> -->
					<div class="blog-con-main">
						<label><?= ucfirst($page['heading']); ?></label>
						<!-- <p>
							Psted By <span class="fa fa-user"> 1</span>
							Thursday, August 3, 2017 <span class="fa fa-clock-o"></span>
							Comments <span class="fa fa-comment-o"> 1</span>
						</p> -->
						<p class="blog-cont">
							<?= $page['description']; ?>
						</p>
						<p class="blog-cont"></p>
					</div>
				</div>
	
			</div>
			<div class="col-lg-4 col-md-4 col-xs-12 col-sm-4">
				<div class="heading-all">
					<h2>User Request</h2>
				</div>
				<div class="main-news">	
				<?php foreach ($quotes as $quote): ?>					
					<div class="main-news-l">
						<div class="img-news">
						</div>
						<label for=""><?= ucfirst($quote['car_info']); ?></label>
						<p><?= date('l, F, Y', strtotime($quote['created'])); ?><span class="fa fa-comment-o"> 1</span></p>
						<span>
							<?= substr($quote['description'], 0, 50) . '...'; ?>
						</span>
					</div>
				<?php endforeach; ?>
					
				</div>
			</div>
		</div>
	</div>
</section>
<?php include_once('includes/footer/car_brand.php'); ?>
<?php include_once('includes/footer/user_quote.php'); ?>
<?php include_once('includes/footer/upcoming_cars.php'); ?>
<?php include_once('includes/footer.php'); ?>