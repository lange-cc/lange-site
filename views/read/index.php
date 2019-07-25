	<?php
$val = $this->blog;
if (!empty($val)) {
    $data = json_decode($val);
    foreach ($data as $key => $value) {
        ?>

	<div class="row">
	    <div class="col-lg-12">

	        <section class="site-section-for-title">
	            <h3 class="text-white gotham-bold"><?php echo $data[$key]->title; ?></h3>
	            <label class="text-white gotham-light">BY <?php echo $data[$key]->author_name; ?></label>
	            <p class="text-white gotham-light">On <?php echo date('M j Y', strtotime($data[$key]->added_date)); ?></p>
	        </section>
	        <img src="<?php echo IMG_URL . $data[$key]->logo; ?>" class="fill-width">


	    </div>

	</div>



	<section class="site-section">
	    <div class="row">
	        <div class="col-lg-9">
	            <div class="text-white gotham-light text-justfy scrollbar" style="font-size: 16px;">
	                <?php echo $data[$key]->content; ?>
	            </div>
	            <br><br>

	            <div class="row">
	                <div class="col-lg-1">
	                    <img src="<?php echo IMG_URL . $data[$key]->author; ?>" class="autho-logo">
	                </div>
	                <div class="col-lg-9 author-content">
	                    <label class="text-white gotham-medium">BY <?php echo $data[$key]->author_name; ?></label>
	                    <p class="text-white gotham-light">
	                        <?php echo $data[$key]->author_content; ?>
	                    </p>
	                    <p class="text-white gotham-bold">
	                        <?php echo date('M j Y g:i A', strtotime($data[$key]->added_date)); ?></p>
	                </div>
	            </div>

	            <br>
	            <div class="anu" data-ayoshare="<?php echo LINK; ?>read/story/<?php echo $data[$key]->id; ?>/"></div>
	            <br>


	        </div>

	        <div class="col-lg-3">
	            <div class="demoDiv twitter-widget">
	                <a class="twitter-timeline" data-theme="dark" data-tweet-limit="4" data-link-color="#9266CC"
	                    href="https://twitter.com/lange_tech"></a>
	                <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
	            </div>
	        </div>

	    </div>

	    <?php
}
}
?>

	    <section class="">

	        <div class="row">

	            <?php
$info = $this->relatedblog;
if (!empty($info)) {
    $data = json_decode($info);
    foreach ($data as $key => $value) {
        ?>

	            <div class="col-lg-4 story-widget">
	                <div class="story-window" style="min-height: 540px;">
	                    <div class="row">
	                        <div class="col-lg-12" style="background: transparent url('<?php echo IMG_URL . $data[$key]->logo; ?>');
               background-repeat: no-repeat;
               background-position: center center;
               background-origin: content-box;
               min-height: 230px;
               background-size: cover;">
	                        </div>
	                        <div class="col-lg-12 story-content">
	                            <h3 class="gotham-bold">
	                                <?php echo $data[$key]->title; ?></h3>
	                            <p class="gotham-light">
	                                <?php echo $this->CutText(150, $data[$key]->content); ?>
	                            </p>

	                            <div class="row">

	                                <div class="col-lg-3">
	                                    <img src="<?php echo IMG_URL . $data[$key]->author_img; ?>" class="autho-logo">
	                                </div>
	                                <div class="col-lg-9">
	                                    <label class="gotham-medium"><?php echo $data[$key]->author_name; ?></label>
	                                    <p class="gotham-light">
	                                        <?php echo date('M j Y g:i A', strtotime($data[$key]->added_date)); ?></p>
	                                </div>
	                            </div>

	                        </div>

	                    </div>
	                    <a class="story-btn" href="<?php echo LINK; ?>read/story/<?php echo $data[$key]->id; ?>/">READ FULL
	                        STORY</a>
	                </div>
	            </div>

	            <?php

    }}
?>


	        </div>
	    </section>


	    <div class="row">
	        <div class="col-lg-6 comment-form">
	            <h3 class="text-white gotham-bold">LEAVE YOUR COMMENT HERE</h3>

	            <form id="comment-form" action="<?php echo LINK; ?>read/addcomment" method="post">
	                <div class="input-widget">
	                    <input class="site-input" type="text" name="names" placeholder="Names" required>
	                    <input type="hidden" name="post-id" value="<?php echo $this->id; ?>">
	                </div>
	                <div class="input-widget">
	                    <textarea class="site-textarea" name="content" placeholder="Your comment" required></textarea>
	                </div>
	                <button type="submit" class="sendemail-btn">Comment</button>
	                <br>
	                <p class="notification text-white">

	                </p>
	            </form>

	        </div>
	        <div class="col-lg-6">
	            <h3 class="text-white gotham-bold">COMMENTS</h3>

	            <div class="demoDiv firstDiv">
	                <div class="comment-hidden"></div>
	                <?php
$val = $this->blog;
if (!empty($val)) {
    $data = json_decode($val);
    foreach ($data as $key => $value) {
        ?>
	                <?php
$data = $data[$key]->comment;
        foreach ($data as $key => $value) {
            ?>
	                <div class="row comment-item">
	                    <div class="col-lg-2">
	                        <div class="autho-logo"><span class="fa fa-user"></span></div>
	                    </div>
	                    <div class="col-lg-10">
	                        <label class="text-white gotham-medium"><?php echo $data[$key]->name; ?></label>
	                        <p class="text-white gotham-thin">
	                            <?php echo date('M j Y g:i A', strtotime($data[$key]->added_date)); ?></p>
	                        <p class="text-white gotham-light">
	                            <?php echo $data[$key]->content; ?>
	                        </p>

	                    </div>
	                </div>
	                <?php }?>
	                <?php
}
}
?>

	            </div>


	        </div>
	    </div>
	    <p>
	        <hr class="project-line" />
	    </p>
	</section>