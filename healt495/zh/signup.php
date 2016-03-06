<?include('inc/header.php');?>
<?session_start();?>
<?
if(!empty($_SESSION['login_user']))
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";

}else {

$countries_sql = mysqli_query($db,"SELECT * FROM countries");
$countries_row = mysqli_num_rows($countries_sql);


?>
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
								<h2 class="title">注册</h2><div class="form-group" id="error_signup"></div>	
								
								<!-- signup Form -->
									<div id="errmsg"></div>
									<form class="contact" name="contact">
									 

									  <div class="row">
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="fname" class="control-label">名字:</label>
										<input type="text" class="form-control" id="fname" name="fname" required>
									  </div>	
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="lname" class="control-label">姓:</label>
										<input type="text" class="form-control" id="lname" name="lname">
									  </div>										  
									  </div>
									  <div class="row" style="padding:5px;">
									  <div class="form-group" >
										<label for="email" class="control-label" id="javaemail">电子邮箱:</label>
										<input type="text" class="form-control" id="email" name="email">
									  </div>
									  </div>
									  <div class="row">
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="pwd1" class="control-label">密码:</label>
										<input type="password" class="form-control" id="pwd1" name="pwd1">
									  </div>	
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="pwd2" class="control-label">重新输入密码:</label>
										<input type="password" class="form-control" id="pwd2" name="pwd2">
									  </div>										  
									  </div>	
									  <div class="row" style="padding:5px;">									  
									  <div class="form-group javaremove">
										<label for="address" class="control-label">地址:</label>
										<input type="text" class="form-control" id="address" name="address">
									  </div>	
									  </div>								  
									  <div class="row">
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="postal" class="control-label">邮政编码:</label>
										<input type="text" class="form-control" id="postal" name="postal">
									  </div>	
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="city" class="control-label">城市:</label>
										<input type="text" class="form-control" id="city" name="city">
									  </div>										  
									  </div>
									  <div class="row">
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
									  
										<label for="country" class="control-label">国家:</label>
										<select class="form-control" id="country" name="country">
										<?
											while ($countries = mysqli_fetch_assoc($countries_sql)) {
												$country_code = $countries['country_code'];
												$country_name = $countries['cninfo']; ?>
												<option value="<?echo $country_name?>"><?echo $country_name?></option>
										<?	}
										?>
										</select>
										
									  </div>	
									  <div class="form-group col-lg-6 javaremove" style="padding:5px;">
										<label for="province" class="control-label">州/省:</label>
										<input type="text" class="form-control" id="province" name="province">
									  </div>										  
									  </div>
										<div class="checkbox javaremove">
										  <label><input type="checkbox" id="terms" value="" required>我同意你们的<a href="#" data-toggle="modal" data-target="#terms_services">条款和服务</a> </label>
										</div>									  
									</form>
									
									<center><input id="signup" type="button" class="btn btn-danger" value="注册"></center>
								<!-- /signup Form -->
							</div>
						</div>
						<!-- main end -->
					</div>
				</div>
			</div>
			<!-- main-container end -->
			
					<div class="modal fade modal_login_style" id="terms_services" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-content modal-dialog modal-lg">
						  <div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关</span></button>
							  <h4 class="modal-title" id="modalla"><?echo $product_detail_name?> 条款和服务</h4>
						  </div>
						  
						  <div class="modal-body">
								
								<iframe src="inc/terms.php" width="100%" height="600px"></iframe>


						  </div>
						  
					  </div>
					</div>			
<?}
?>
<?include("inc/footer.php");?>
<?include("inc/scripts.php");?>
