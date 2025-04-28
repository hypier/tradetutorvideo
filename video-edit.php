<?php include_once('includes/header.php'); ?>
<script src="assets/plugins/ckeditor/ckeditor.js"></script>

<?php 

	if(isset($_GET['id'])) {
		$ID = clean($_GET['id']);
 		$sql_videos = "SELECT * FROM tbl_gallery WHERE id ='$ID'";
		$result = $connect->query($sql_videos);
        $row = $result->fetch_assoc();
 	}

	if(isset($_POST['submit'])) {
		$video_id = 'cda11up';
		if($_POST['upload_type'] == 'Upload') {

			if ($_FILES['video_thumbnail']['name'] != '') {
				unlink('upload/'.$_POST['old_image']);
				$video_thumbnail = time().'_'.$_FILES['video_thumbnail']['name'];
				$video_thumbnail_tmp = $_FILES['video_thumbnail']['tmp_name'];
   				$file_path = 'upload/'.$video_thumbnail;
				copy($video_thumbnail_tmp, $file_path);
			} else {
				$video_thumbnail = clean($_POST['old_image']);
			}

			if ($_FILES['video']['name'] != '') {

				unlink('upload/video'.$_POST['old_video']);
				$video = time().'_'.$_FILES['video']['name'];
				$video_tmp = $_FILES['video']['tmp_name'];
				$video_path = 'upload/video/'.$video;
				copy($video_tmp, $video_path);

				$bytes = $_FILES['video']['size'];

				if ($bytes >= 1073741824) {
					$bytes = number_format($bytes / 1073741824, 2) . ' GB';
				} else if ($bytes >= 1048576) {
					$bytes = number_format($bytes / 1048576, 2) . ' MB';
				} else if ($bytes >= 1024) {
					$bytes = number_format($bytes / 1024, 2) . ' KB';
				} else if ($bytes > 1) {
					$bytes = $bytes . ' bytes';
				} else if ($bytes == 1) {
					$bytes = $bytes . ' byte';
				} else {
					$bytes = '0 bytes';
				}

			} else {
			 	$bytes = clean($_POST['old_size']);
			 	$video = clean($_POST['old_video']);
			}

		} else if ($_POST['upload_type']=='Url') {

			if($_FILES['image']['name'] != '') {
				unlink('upload/'.$_POST['old_image']);
				$video_thumbnail = time().'_'.$_FILES['image']['name'];
				$video_thumbnail_tmp = $_FILES['image']['tmp_name'];
   				$file_path = 'upload/'.$video_thumbnail;
				copy($video_thumbnail_tmp, $file_path);
			} else {
				$video_thumbnail = clean($_POST['old_image']);
			}

			$video = clean($_POST['url_source']);

		} else {
			$bytes = '';
			$video = clean($_POST['youtube']);

			if ($_FILES['youtube_thumbnail']['name'] != '') {
				unlink('upload/'.$_POST['old_image']);
				$video_thumbnail = time().'_'.$_FILES['youtube_thumbnail']['name'];
				$image = $_FILES['youtube_thumbnail']['tmp_name'];
				$path = 'upload/'.$video_thumbnail;
				copy($image, $path);
			} else {
				if ($row['video_thumbnail'] != '') {
					$video_thumbnail = clean($_POST['old_image']);
				} else {
					$video_thumbnail = '';
				}
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

				'cat_id'  			=> clean($_POST['cat_id']),			
				'video_title'  		=> clean($_POST['video_title']),
				'video_url'  		=> $video,									
				'video_id' 			=> $video_id,
				'video_thumbnail' 	=> $video_thumbnail,
				'video_duration' 	=> clean($_POST['video_duration']),
                'video_description' => $_POST['video_description'],
				'video_type' 		=> clean($_POST['upload_type']),
				'size' 				=> $bytes,
				'total_views'		=> clean($_POST['total_views']),

			);	

			$update = update('tbl_gallery', $data, "WHERE id = '".$_POST['id']."'");

			if ($update > 0) {
			$_SESSION['msg'] = '更改已保存...';
			header( "Location:video-edit.php?id=$ID");
			exit;
	}


	}

 	$sql_categories = "SELECT * FROM tbl_category";
	$category_results = mysqli_query($connect, $sql_categories);

?>

<script type="text/javascript">

$(document).ready(function(e) {
    $("#upload_type").change(function() {
	var type=$("#upload_type").val();

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

		if (type == "youtube")	{
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
            <li><a href="dashboard.php">控制面板</a></li>
            <li><a href="video.php">视频管理</a></li>
            <li class="active">编辑视频</a></li>
        </ol>

       <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                	<form id="form_validation" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="header">
                            <h2>编辑视频</h2>
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
                                        <div class="font-12">视频标题</div>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="video_title" id="video_title" placeholder="视频标题" value="<?php echo $row['video_title'];?>" required>
                                        </div>
                                    </div>
                                  	
                                    <div class="form-group">
                                        <div class="font-12">视频时长</div>
                                        <div class="form-line">
                                            <input type="text" name="video_duration" id="video_duration" class="form-control" placeholder="03:59" value="<?php echo $row['video_duration'];?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="font-12">观看次数</div>
                                        <div class="form-line">
                                            <input type="number" name="total_views" id="total_views" class="form-control" placeholder="0" value="<?php echo $row['total_views'];?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="font-12">分类</div>
                                        <select class="form-control show-tick" name="cat_id" id="cat_id">
                                           <?php 	
												while($category_row = mysqli_fetch_array($category_results)) {
													$sel = '';
													if ($category_row['cid'] == $row['cat_id']) {
													$sel = "selected";	
												}	
											?>
										    <option value="<?php echo $category_row['cid'];?>" <?php echo $sel; ?>><?php echo $category_row['category_name'];?></option>
										                <?php }?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <div class="font-12">视频类型</div>
                                        <select class="form-control show-tick" name="upload_type" id="upload_type">
										    <option <?php if($row['video_type'] == 'youtube'){echo 'selected';} ?> value="youtube">Youtube</option>
										    <option <?php if($row['video_type'] == 'Url'){ echo 'selected';} ?> value="Url">网址链接</option>
										    <option <?php if($row['video_type'] == 'Upload'){ echo 'selected';} ?> value="Upload">上传视频</option>
                                        </select>
                                    </div>
                                    
                                    <div id="youtube">
                                    	<div class="form-group">
                                    		<?php if ($row['video_thumbnail'] != '') { ?>
                                    		<input type="file" name="youtube_thumbnail" id="youtube_thumbnail" class="dropify-image" data-max-file-size="3M" data-allowed-file-extensions="jpg jpeg png gif" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="upload/<?php echo $row['video_thumbnail'];?>" data-show-remove="false"/>
                                    		<?php } else { ?>
                                    		<input type="file" name="youtube_thumbnail" id="youtube_thumbnail" class="dropify-image" data-max-file-size="3M" data-allowed-file-extensions="jpg jpeg png gif" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="https://img.youtube.com/vi/<?php echo $row['video_id'];?>/mqdefault.jpg" data-show-remove="false"/>
                                    		<?php } ?>

                                    		<div class="help-info pull-left">如果缩略图为空，将使用YouTube上的默认缩略图</div><br>
                                    	</div>

                                        <div class="form-group">
                                            <div class="font-12">Youtube链接</div>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="https://www.youtube.com/watch?v=33F5DJw3aiU" value="<?php echo $row['video_url'];?>" required>
                                            </div>
                                            <div class="font-12">缩略图将从YouTube默认图像中获取。</div>
                                        </div>
                                    </div>

                                    <div id="video_upload">
                                        <div class="form-group">
                                            <input type="file" id="video_thumbnail" name="video_thumbnail" class="dropify-image" data-max-file-size="3M" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="upload/<?php echo $row['video_thumbnail'];?>" data-show-remove="false" />
                                        </div>

                                        <div class="form-group">
                                            <input type="file" id="video" name="video" id="video" class="dropify-video" data-allowed-file-extensions="3gp mp4 mpg wmv mkv m4v mov flv" data-default-file="upload/<?php echo $row['video_url'];?>" data-show-remove="false" />
                                        </div>
                                    </div>

                                    <div id="direct_url">
                                        <div class="form-group">
                                            <input type="file" name="image" id="image" class="dropify-image" data-max-file-size="3M" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="upload/<?php echo $row['video_thumbnail'];?>" data-show-remove="false"/>
                                        </div>
                                        <div class="form-group">
                                            <div class="font-12">视频链接</div>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="url_source" id="url_source" placeholder="http://www.xyz.com/news_title.mp4" value="<?php echo $row['video_url'];?>" required/>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-7">
                                    <div class="font-12">描述</div>
                                    <div class="form-group" style="margin-top: 6px;">
                                        <textarea class="form-control" name="video_description" id="video_description" class="form-control" cols="60" rows="10" required><?php echo $row['video_description'];?></textarea>
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

								    <input type="hidden" name="old_image" value="<?php echo $row['video_thumbnail'];?>">
									<input type="hidden" name="old_video" value="<?php echo $row['video_url'];?>">
									<input type="hidden" name="old_size" value="<?php echo $row['size'];?>">
									<input type="hidden" name="id" value="<?php echo $row['id'];?>">

                                    <button type="submit" name="submit" class="button button-rounded waves-effect waves-float pull-right">更新</button>
                                    
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