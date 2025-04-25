<?php include_once('includes/header.php'); ?>
<script src="assets/plugins/ckeditor/ckeditor.js"></script>

<?php 

    if(isset($_POST['submit'])) {

        $video_id = clean('cda11up');

        if($_POST['upload_type'] == 'Upload') {

            $video_thumbnail = time().'_'.$_FILES['video_thumbnail']['name'];
            $pic2            = $_FILES['video_thumbnail']['tmp_name'];
            $tpath2          = 'upload/'.$video_thumbnail;
            copy($pic2, $tpath2);

            $video  = time().'_'.$_FILES['video']['name'];
            $pic1   = $_FILES['video']['tmp_name'];
            $tpath1 ='upload/video/'.$video;
            copy($pic1, $tpath1);

            $bytes = $_FILES['video']['size'];

            if ($bytes >= 1073741824) {
                $bytes = number_format($bytes / 1073741824, 2) . ' GB';
            }

            else if ($bytes >= 1048576) {
                $bytes = number_format($bytes / 1048576, 2) . ' MB';
            }

            else if ($bytes >= 1024) {
                $bytes = number_format($bytes / 1024, 2) . ' KB';
            }

            else if ($bytes > 1) {
                $bytes = $bytes . ' bytes';
            }

            else if ($bytes == 1) {
                $bytes = $bytes . ' byte';
            } else {
                $bytes = '0 bytes';
            }
            

        } else if ($_POST['upload_type'] == 'Url') {

            $video = clean($_POST['url_source']);

            $video_thumbnail = time().'_'.$_FILES['image']['name'];
            $pic2            = $_FILES['image']['tmp_name'];
            $tpath2          = 'upload/'.$video_thumbnail;
            copy($pic2, $tpath2);

        } else {
            $video = clean($_POST['youtube']);

            if ($_FILES['youtube_thumbnail']['name'] != '') {
                $video_thumbnail = time().'_'.$_FILES['youtube_thumbnail']['name'];
                $image = $_FILES['youtube_thumbnail']['tmp_name'];
                $path = 'upload/'.$video_thumbnail;
                copy($image, $path);
            } else {
                $video_thumbnail = '';
            }  

            function youtube_id_from_url($url) {

                $pattern = 
                '%^# Match any youtube URL
                (?:https?://)?  # Optional scheme. Either http or https
                (?:www\.)?      # Optional www subdomain
                (?:             # Group host alternatives
                  youtu\.be/    # Either youtu.be,
                | youtube\.com  # or youtube.com
                  (?:           # Group path alternatives
                    /embed/     # Either /embed/
                  | /v/         # or /v/
                  | /watch\?v=  # or /watch\?v=
                  )             # End path alternatives.
                )               # End host alternatives.
                ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
                $%x'
                ;

                $result = preg_match($pattern, $url, $matches);

                if (false !== $result) {
                    return $matches[1];
                }
                return false;

            }

            $video_id = youtube_id_from_url($_POST['youtube']);

        }

                $data = array(

                    'cat_id'            => clean($_POST['cat_id']),            
                    'video_title'       => clean($_POST['video_title']),
                    'video_url'         => $video,                                  
                    'video_id'          => $video_id,
                    'video_thumbnail'   => $video_thumbnail,                                    
                    'video_duration'    => clean($_POST['video_duration']),
                    'video_description' => $_POST['video_description'],
                    'video_type'        => clean($_POST['upload_type']),
                    'size'              => $bytes
                    );      

                      $qry = insert('tbl_gallery', $data);                                  
                      
                      $_SESSION['msg'] = 'Video added successfully...';
                      header( "Location:video-add.php");
                      exit;

    }

    $wall_qry = "SELECT * FROM tbl_category";
    $wall_result = mysqli_query($connect, $wall_qry);

?>

<script type="text/javascript">

    $(document).ready(function(e) {

        $("#upload_type").change(function() {
            var type = $("#upload_type").val();

                if (type == "youtube") {
                    $("#video_upload").hide();
                    $("#direct_url").hide();
                    $("#youtube").show();
                }

                if (type == "Url") {
                    $("#youtube").hide();
                    $("#video_upload").hide();
                    $("#direct_url").show();
                }

                if (type == "Upload") {
                    $("#youtube").hide();
                    $("#direct_url").hide();
                    $("#video_upload").show();
                }                       
        });

        $( window ).load(function() {
        var type=$("#upload_type").val();

            if (type == "youtube")  {
                $("#video_upload").hide();
                $("#direct_url").hide();
                $("#youtube").show();
            }

            if (type == "Url") {
                $("#youtube").hide();
                $("#video_upload").hide();
                $("#direct_url").show();
            }

            if (type == "Upload") {
                $("#youtube").hide();
                $("#direct_url").hide();
                $("#video_upload").show();
            }

        });

    });

</script>

<section class="content">

	<ol class="breadcrumb">
		<li><a href="dashboard.php">Dashboard</a></li>
		<li><a href="video.php">Manage Video</a></li>
		<li class="active">Add Video</a></li>
	</ol>

	<div class="container-fluid">

		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<form id="form_validation" method="post" enctype="multipart/form-data">
					<div class="card corner-radius">
						<div class="header">
							<h2>ADD VIDEO</h2>
						</div>
						<div class="body">

							<?php if(isset($_SESSION['msg'])) { ?>
							<div class='alert alert-info alert-dismissible corner-radius' role='alert'>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>&nbsp;&nbsp;</button>
								<?php echo $_SESSION['msg']; ?>
							</div>
							<?php unset($_SESSION['msg']); } ?>                            

							<div class="row clearfix">

                                <div class="col-sm-5">

                                    <div class="form-group">
                                        <div class="font-12">Video Title</div>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="video_title" id="video_title" placeholder="Video Title" required>
                                        </div>
                                    </div>
                                  	
                                    <div class="form-group">
                                        <div class="font-12">Video Duration</div>
                                        <div class="form-line">
                                            <input type="text" name="video_duration" id="video_duration" class="form-control" placeholder="03:59" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="font-12">Category</div>
                                        <select class="form-control show-tick" name="cat_id" id="cat_id">
                                            <?php while ($data = mysqli_fetch_array ($wall_result)) { ?>
                                            <option value="<?php echo $data['cid'];?>"><?php echo $data['category_name'];?></option>
                                                <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="font-12">Video Type</div>
                                        <select class="form-control show-tick" name="upload_type" id="upload_type">
                                                <option value="youtube">Youtube</option>
                                                <option value="Url">Url</option>
                                                <option value="Upload">Upload</option>
                                        </select>
                                    </div>

                                    <div id="youtube">
                                        <div class="font-12 ex1">Optional YouTube Thumbnail ( jpg / png )</div>
                                        <div class="form-group">
                                            <input type="file" name="youtube_thumbnail" id="youtube_thumbnail" class="dropify-image" data-max-file-size="3M" data-allowed-file-extensions="jpg jpeg png gif"/>
                                            <div class="help-info pull-left">If the thumbnail image is empty, it will take from the default thumbnail on YouTube</div><br>
                                        </div>

                                        <div class="form-group">
                                            <div class="font-12">Youtube URL</div>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="https://www.youtube.com/watch?v=33F5DJw3aiU" required>
                                            </div>
                                            <div class="font-12">thumbnail image will be taken from the default image on youtube.</div>
                                        </div>
                                    </div>
                                    
                                    <div id="video_upload">
                                        <div class="form-group">
                                            <input type="file" id="video_thumbnail" name="video_thumbnail" id="video_thumbnail" class="dropify-image" data-max-file-size="3M" data-allowed-file-extensions="jpg jpeg png gif" required />
                                        </div>

                                        <div class="form-group">
                                            <input type="file" id="video" name="video" class="dropify-video" data-allowed-file-extensions="3gp mp4 mpg wmv mkv m4v mov flv" required/>
                                        </div>
                                    </div>

                                    <div id="direct_url">
                                        <div class="form-group">
                                            <input type="file" name="image" id="image" class="dropify-image" data-max-file-size="3M" data-allowed-file-extensions="jpg jpeg png gif" />
                                        </div>
                                        <div class="form-group">
                                            <div class="font-12">Video URL</div>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="url_source" id="url_source" placeholder="http://www.xyz.com/news_title.mp4" required/>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-7">
                                    <div class="font-12">Description</div>
                                    <div class="form-group" style="margin-top: 6px;">
                                        <textarea class="form-control" name="video_description" id="video_description" class="form-control" cols="60" rows="10" required></textarea>

                                        <?php if ($ENABLE_RTL_MODE == 'true') { ?>
                                        <script>                             
                                            CKEDITOR.replace( 'video_description' );
                                            CKEDITOR.config.contentsLangDirection = 'rtl';
                                        </script>
                                        <?php } else { ?>
                                        <script>                             
                                            CKEDITOR.replace( 'video_description' );
                                        </script>
                                        <?php } ?>
                                    </div>

                                    <button type="submit" name="submit" class="button button-rounded waves-effect waves-float pull-right">PUBLISH</button>
                                    
                                </div>								

							</div>
						</div>
					</div>
				</form>

			</div>
		</div>

	</div>

</section>

<?php include_once('includes/footer.php'); ?>