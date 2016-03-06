<?include('inc/header.php');?>
<?session_start();?>
<?
if(!empty($_SESSION['login_user']))
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";

}else {?>
		<div id="page-start"></div>
			<!-- main-container start -->
			<!-- ================ -->
			<div class="main-container dark-translucent-bg" style="background-image:url('images/background-img-6.jpg');">
				<div class="container">
					<div class="row">
						<!-- main start -->
						<!-- ================ -->
						<div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
							<div class="form-block center-block p-30 light-gray-bg border-clear">
								<h2 class="title">忘记密码</h2><div class="form-group" id="error_signup"></div>	
								
								<!-- Comment Form -->
									<div id="password_msg"></div>
									<form class="reset_pass" name="reset_pass">
									  <div class="form-group">
										<label for="email" class="control-label">电子邮箱:</label>
										<input type="text" class="form-control" id="email" name="email">
										<p class="msg_pass">请输入您注册的电子邮箱地址</p>
									  </div>								  					  
									</form>
									
									<center><input id="passwordreset" type="button" class="btn btn-danger" value="发送"></center>
								<!-- /Contact Form -->
							
							</div>
						</div>
						<!-- main end -->
					</div>
				</div>
			</div>
			<!-- main-container end -->
<?}
?>
<script type="text/javascript" src="../js_custom/passwordreset.js"></script>
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>


