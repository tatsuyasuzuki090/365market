	  <?php
	  if( !isset($_SESSION['user']) ) {?>
	  <div id="add_member" class="">
		  <div class="container">
			  <div class="col-xs-12 col-sm-8 sp-none">
				  <div class="pall-10">
					  <h2>すぐに簡単登録できます</h2>
					  <p>会員登録は無料です会員登録は無料です会員登録は無料です会員登録は無料です会員登録は無料です会員登録は無料です会員登録は無料です会員登録は無料です会員登録は無料です</p>
				  </div>
			  </div>
			  <div class="col-xs-12 col-sm-4">
				  <div class="pall-10">
					  <h2>会員登録は無料です</h2>
					  <p class="fm-prof_text"><button type="button" class="btn btn-warning btn-block" onclick="location.href='login.php'">会員登録はこちら</button></p>
					  <p class="fm-prof_text"><a href="login.php" title="イベントをさがす">すでに会員の方はこちらからログイン</a></p>
				  </div>
				  <!-- 開閉用ボタン -->
				  <div class="add_member-btn" id="add_member-btn">
					  <i class="fa fa-times fa-3x fcolorwhite" aria-hidden="true"></i>
				  </div>
			  </div>
		  </div>
	  </div>
	  <?php
	  } ?>