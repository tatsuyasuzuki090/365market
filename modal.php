
<!-- Modal -->
    <!--お気に入りのFM削除-->
    <div id="fm_del_Modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p>お気に入りから削除しますか？</p>
          </div>
          <div class="modal-footer">
	          <form method="post">
	            <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
	            <button id="logoutBtn" type="submit" name='yes' value='yes' class="btn btn-primary">は　い</button>
	          </form>
          </div>
        </div>
      </div>
    </div>
    <!--会員登録必要モーダル-->
    <div id="regist_equir_Modal" class="modal fade">
      <div class="modal-dialog  modal-dialog-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p>会員登録が必要です。</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
            <button id="logoutBtn" type="button" class="btn btn-primary" onclick="location.href='login.php'">会員登録のページへ</button>
          </div>
        </div>
      </div>
    </div> 
    
    <!--お気に入りのFM削除-->
    <div id="fm_del_Modal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p>お気に入りから削除しますか？</p>
          </div>
          <div class="modal-footer">
	          <form method="post">
	            <button type="button" class="btn btn-default" data-dismiss="modal">いいえ</button>
	            <button id="logoutBtn" type="submit" name='yes' value='yes' class="btn btn-primary">は　い</button>
	          </form>
          </div>
        </div>
      </div>
    </div> 
    <!--画像トリミング（マイページプロフィールuser_config_prof.php）モーダル-->
    <div id="user_config_prof_Modal" class="modal fade">
      <div class="modal-dialog  modal-dialog-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
	          
			<form method="POST" enctype="multipart/form-data">
			    <input type="file" id="profile-image" />
			 
			    <img id="select-image" style="max-width:500px;">
			 
			　　　　<!-- 切り抜き範囲をhiddenで保持する -->
			    <input type="hidden" id="upload-image-x" name="profileImageX" value="0"/>
			    <input type="hidden" id="upload-image-y" name="profileImageY" value="0"/>
			    <input type="hidden" id="upload-image-w" name="profileImageW" value="0"/>
			    <input type="hidden" id="upload-image-h" name="profileImageH" value="0"/>
			    <input type="submit" value="アップロード">
			</form>

            <p><img src="upload/<?php if(isset($img_sub_prof_path)){ echo $img_sub_prof_path;} ?>" alt="" class="img-responsive"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
            <button id="logoutBtn" type="button" class="btn btn-primary" onclick="location.href='login.php'">会員登録のページへ</button>
          </div>
        </div>
      </div>
    </div> 
    

    <div id="event_detail_Modal" class="modal fade">
      <div class="modal-dialog  modal-dialog-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p><?php echo $event_title; ?>（<?php echo $event_category_name; ?>）</p>
				<table class="event_detail_Modal">
					<tr>
						<th>日時</th>
						<td><?php echo date_b($event_date); ?></td>
					</tr>
					<tr>
						<th>開催場所</th>
						<td><?php echo $event_address; ?></td>
					</tr>
					<tr>
						<th>連絡先</th>
						<td><?php echo $event_tel; ?></td>
					</tr>
					<tr>
						<th>URL</th>
						<td><?php echo $event_url; ?></td>
					</tr>
				</table>
				<h2 class="mb20">開催場所</h2>				    
				<div id="google_map" style="width:100%;height:400px"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
          </div>
        </div>
      </div>
    </div>
    <!--ログイン初期モーダル-->
    <div id="first_fm_Modal" class="modal fade">
      <div class="modal-dialog  modal-dialog-center">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <p>情報が不十分です。会員情報の入力を行ってください。</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
            <button id="logoutBtn" type="button" class="btn btn-primary" onclick="location.href='user_config_prof.php'">会員情報のページへ</button>
          </div>
        </div>
      </div>
    </div> 
    
<div class="remodal-bg"></div>
<div class="remodal" data-remodal-id="modal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <h1>Remodal</h1>
  <p>
    Responsive, lightweight, fast, synchronized with CSS animations, fully customizable modal window plugin with declarative configuration and hash tracking.
  </p>
  <br>
  <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
  <button data-remodal-action="confirm" class="remodal-confirm">OK</button>
</div>
<!-- Modal -->
