

    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/dropdown.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/remodal.min.js"></script>
    <script src="js/jquery.bottom-1.0.js"></script>
    <script src="js/button.js"></script>
    


	<script>
	$(function(){
		$('.accordion h2').click(function(){
			$(this).next('div').stop().slideToggle(200);
		});
	});
	</script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/1.0.0/cropper.min.js"></script>
	<script type="text/javascript">
	// init
	// class='cropper-example-1のimgタグに適用'
	var $image = $('.cropper-example-1 > img'),replaced;
	
	//crop options
	// id='imgに適用'
	$('#img').cropper({
	  aspectRatio: 4 / 4 // ここでアスペクト比の調整 ワイド画面にしたい場合は 16 / 9
	
	  });
	</script>
	
    <!-- 郵便番号 -->
    <script src="js/ajaxzip3.js"></script>
    <!--フッター最下部配置-->
    <script type="text/javascript" src="js/footerFixed.js"></script>
    <!--ヘッダースクロール固定-->
    <script>
	    $(window).on('scroll', function() {
		    $('#header').toggleClass('fixed', $(this).scrollTop() > 0);
		});
	</script>


	<!-- プログレスバー -->
	<script>
	$(document).ready(function(){
	    var loadStatus = 0, //ローディング進捗
	        img_num = $('img').length; //読み込む画像の数
	
	    $('img').each(function() { //画像が読み込まれたら、、
	        var src = $(this).attr('src');
	        $('<img>').attr('src', src).load(function() {
	            loadStatus++; //画像が読み込まれたら、loading状況を更新
	        });
	    });
	
	    var timer = setInterval(function() { //ローディング状況をプログレスバーに反映
	
	        $('.progressbar').css({
	            'width': (loadStatus / img_num) * 100 + '%' //読み込まれた画像の数 / 読み込む画像の数 * %  これをプログレスバーのwidthに設定 
	        });
	        if((loadStatus / img_num) * 100 == 100){ //ローディング完了後にプログレスバーを非表示
	            clearInterval(timer);
	            $('.progressbar').delay(200).animate({
	                'opacity': 0
	            }, 200);
	
	            $('#wrappAll').delay(500).queue(function() { //ローディングバーを隠すと同時にメインコンテンツを表示
	                $(this).addClass('load');
	            });
	        }
	    }, 5);
	});
	</script>
	
		
	<!-- project_detail.php　googleマップ干渉 -->
	<!-- ページ読み込みふんわり -->
<!--
	<script>	
	$('head').append(
	'<style type="text/css">body {display:none;}'
	);
	$(window).load(function() {
		$('body').delay(100).fadeIn("slow");
	});
	</script>
-->
	
	<!--横スライドマイメニュー-->
	<script>
	$(function () {
	  var $body = $('body');
	  $('#js__sideMenuBtn').on('click', function () {
	    $body.toggleClass('side-open');
	    $('#js__overlay').on('click', function () {
	      $body.removeClass('side-open');
	    });
	  });
	});
	</script>
	
	<!-- 最下部-会員登録を閉じる -->
	<script>
	$(function () {
	  var $add_member = $('#add_member');
	  $('#add_member-btn').on('click', function () {
		  $add_member.toggleClass('add_member_close');
		  });
	});
	</script>
	
    <!--上部へ戻るボタン-->
	<script type="text/javascript">    
    $(function() {
	    var topBtn = $('#page-top');    
	    topBtn.hide();
	    //スクロールが100に達したらボタン表示
	    $(window).scroll(function () {
	        if ($(this).scrollTop() > 100) {
	            topBtn.fadeIn();
	        } else {
	            topBtn.fadeOut();
	        }
	    });
	    //スクロールしてトップ
	    topBtn.click(function () {
	        $('body,html').animate({
	            scrollTop: 0
	        }, 500);
	        return false;
	    });
	});
	</script>

	<!-- アップロードの自動増加 user_identity.php-->
	<script>
	$("document").ready(function(){
	    $(".fileinput").change(fileInputChange);
	});
	 
	function fileInputChange(){
	    if($(".fileinput").last().val() != ""){
	        $("#filelist").append('<li class="form-group identity"><input type="file" name="uploadfile[]" class="fileinput" /></li>')
	        .bind('change', fileInputChange);
	    }
	}
	</script>
	
	<!-- アラートのフェードアウト -->
	<script>
	$(document).ready(function() {
		$('.alertfadeOut').fadeOut(2600);
	});
	</script>
	
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
	
	<!--オートコンプリート-->
	<script>
	$(function() {
	    $("#user_auto").autocomplete({
	        source: "./autocomplete.php"
	    });
	});
	</script>
	
    <script src="<?php echo $url; ?>/js/tinymce/tinymce.min.js"></script>
	<script>
    tinymce.init({
        selector: ".mytextarea", // id="foo"の場所にTinyMCEを適用
        language : "ja",
        body_id: 'mce-blog',
		height: 500,      // 高さ = 300px
        plugins: "table link hr code image media textcolor", // [追加] 1. 画像挿入ボタンを有効にする
		toolbar: "code | undo redo | bold italic underline | alignleft aligncenter alignright | formatselect fontselect fontsizeselect | hr | link unlink | table | image | media | forecolor backcolor",
    });
    </script>
	
	