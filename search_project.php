<?php
include_once './dbconnect.php';
	if(isset($_POST['checks'])){
	    //postデータを受け取る
	    $search_project = $_POST['checks'];
	    //受け取ったデータが空でなければ
	    if (!empty($search_project)) {
		    //$cnt = count($search_project);
		    //echo($cnt);
		    //print_r($search_project);
		    $keywordCondition = [];
		    
			foreach($search_project as $check) {
		        //echo htmlspecialchars($check) ;
		        //print_r($check) ;
		        $keywordCondition[] = 'project_address LIKE "%' . $check . '%"';
		        //print_r($keywordCondition);
	        } ?>
	        
			<section id ="project_list_new" class="bglocor_w">
				<div class="container">
			        <?php
				    $keywordCondition = implode(' OR ', $keywordCondition);
				    //echo $keywordCondition; ?>

				    <h2><i class="fa fa-search" aria-hidden="true"></i> 検索結果「<?php foreach($search_project as $check) { echo $check.' '; } ?>」</h2>

				    <?php
			        $query_search_project = 'SELECT * FROM project WHERE ' . $keywordCondition . ' AND status = 0  ';
			        //$query_search_project = 'SELECT * FROM project WHERE project_address LIKE "%青森県%" ';
			        $result_search_project = $mysqli->query($query_search_project);
			        while( $row_search_project = $result_search_project->fetch_assoc()) {
			        	$search_project_id = $row_search_project['id'];
			        	$search_project_address = $row_search_project['project_address'];
			        	$search_project_title = $row_search_project['title'];
			        	$search_project_description = $row_search_project['description'];
			        	$search_project_main_img_path = $row_search_project['main_img_path'];
			        	$search_project_category = $row_search_project['category'];
			        	$search_project_status = $row_search_project['status'];
			        	$search_project_datetime = $row_search_project['datetime'];
			        	$search_project_datetime = date("Y年m月d日",strtotime($search_project_datetime));
			        	$project_datetime2 = $row_search_project['datetime'];
			        	$search_project_no = $row_search_project['project_no'];
			        	
			        	$search_project_title = mb_substr($search_project_title, 0, 26, 'utf-8'); //全角文字で先頭から50文字取得
			  		      if(mb_strlen($search_project_title, 'utf-8') > '25') { //18文字より多い場合は「...」を追加
			  		      $search_project_title .= '…';
			  		      }
			  		      
			  		  	$search_project_description = mb_substr($search_project_description, 0, 55, 'utf-8'); //全角文字で先頭から50文字取得
			  		      if(mb_strlen($search_project_description, 'utf-8') > '49') { //18文字より多い場合は「...」を追加
			  		      $search_project_description .= '…';
			  		      }
			        ?>
				    <div class="col-xs-12 col-sm-4 col-md-3 mb30 alpha">
					  <a href="<?php echo $url; ?>/project_detail.php?project_no=<?php echo $search_project_no; ?>" target="blank">
				  	  <div class="mall-05">
				  	     <p class="mb10"><img src="<?php echo $url; ?>/upload/re_<?php echo $search_project_main_img_path; ?>" class="img-responsive"></p>
				  	     <h3 class="title"><?php echo $search_project_title; ?></h3>
				  	     <p class="title"><?php echo $search_project_description; ?></p>
				  	     <p class="fcolorgray day"><?php echo $search_project_datetime ?></p>
				  	  </div>
				  	  </a>
				  	  <?php
		  			  if($project_datetime2 >= date('Y-m-d H:i:s', strtotime('-7 day', time()))){ ?>
		  			  <span class="new" data-reactid="">NEW</span>
		  			  <?php
		  			  } ?>
				  	  <span class="category-label_project"><a class="project_item cate" href="/category/item" data-id="home" data-label="ITEM"><?php echo categry_project($search_project_category); ?></a></span>
					</div>
				  	<?php	  
			        } ?>
			        
				</div>
			</section>
	        <?php
	    	
	    } 
    } else {
	     echo '';
    }
?>