<style>
  .ui-state-highlight { height: 3em; line-height: 1.2em; }
</style>

  <!-- container-fluid : s -->
  <div class="container-fluid " style="width:100%">
    <!-- Page Heading -->
    <div class="page-header">
      <h1>상품 카테고리관리</h1>
      <span style="font-size:14px; color:#333; float:right; padding-top:10px;">
      </span>
    </div>
    <form id="form_default" name="form_default" method="post">
      <!-- body : s -->
      <input type="hidden" name ="select_depth" id="select_depth" value="">
      <input type="hidden" name ="cate_type" id="cate_type" value="<?=$cate_type?>">
      <input type="hidden" name ="select_category_management_idx_1" id="select_category_management_idx_1">
      <input type="hidden" name ="select_category_management_idx_2" id="select_category_management_idx_2">
      <input type="hidden" name ="select_category_management_idx_3" id="select_category_management_idx_3">
      <input type="hidden" name ="select_category_management_idx_4" id="select_category_management_idx_4">

      <div class="bg_wh mt20">
        <div class="table-responsive">

          <div class="row category_col">
            <div class="col-md-3">
              <h4>카테고리 1차</h4>
              <ul class="category sortable" style="height:500px">
              <?php
                $i = 0;
                foreach($first_cate_list as $row){
                $img_path = ($row->img_path)? $row->img_path :"/images/btn_del.gif";
               ?>
                <li <?php if($i==0){ echo 'class="active"'; } ?>>
                  <img src='<?=$img_path?>' style='width:15px;' id='img_<?=$row->category_management_idx?>' onClick=img_change('<?=$row->category_management_idx?>')>
                  [<?=$row->category_management_idx?>]<input type="text" id="<?=$row->category_management_idx?>" value="<?=$row->category_name?>" readonly style="width:130px" >
                  <input type="hidden" name="first_cate_list_idx[]" value="<?=$row->category_management_idx?>">
                  <span class="category_btn">
                    <?php if($row->state == 1) {?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">활성화</a>
                    <?php } else { ?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">비활성화</a>
                    <?php } ?>

                    <a href="javascript:void(0)" class="btn-sm btn-default">수정</a>
                  </span>
                </li>
                <?php
                  $i++;
                }
              ?>
              </ul>

              <h4>카테고리 1차</h4>
              <input type="text" class="form-control add_item_val" style="width:230px" placeholder="카테고리 1차명">

               <a href="#" class="btn btn-info" onclick="category_management_reg_in(0)"> 추가</a>
            </div>
            <div class="col-md-3">
              <h4>카테고리 2차</h4>
              <ul class="category sortable" style="height:500px">
              <?php
                $i = 0;
                foreach($second_cate_list as $row){
                $img_path = ($row->img_path)? $row->img_path :"/images/btn_del.gif";
                ?>
                <li <?php if($i==0){ echo 'class="active"'; } ?>>

                  <img src='<?=$img_path?>' style='width:15px;' id='img_<?=$row->category_management_idx?>' onClick=img_change('<?=$row->category_management_idx?>')>
                  <input type="text" id="<?=$row->category_management_idx?>" value="<?=$row->category_name?>" readonly>
                  <input type="hidden" name="second_cate_list_idx[]" value="<?=$row->category_management_idx?>">
                  <input type="hidden" name="parent_category_management_idx" value="<?=$row->parent_category_management_idx?>">
                  <span class="category_btn">

                    <?php if($row->state == 1) {?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">활성화</a>
                    <?php } else { ?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">비활성화</a>
                    <?php } ?>

                    <a href="javascript:void(0)" class="btn-sm btn-default">수정</a>

                  </span>
                </li>
                <?php
                  $i++;
                }
              ?>
              </ul>
              <h4>카테고리 2차</h4>
              <input type="text" class="form-control add_item_val" placeholder="카테고리 2차명"> <a href="#" class="btn btn-info" onclick="category_management_reg_in(1)"> 추가</a>
            </div>
            <div class="col-md-3">
              <h4>카테고리 3차</h4>
              <ul class="category sortable" style="height:500px">
              <?php
                $i = 0;
                foreach($third_cate_list as $row){ ?>
                <li <?php if($i==0){ echo 'class="active"'; } ?>>
                  <input type="text" id="<?=$row->category_management_idx?>" value="<?=$row->category_name?>" readonly>
                  <input type="hidden" name="third_cate_list_idx[]" value="<?=$row->category_management_idx?>">
                  <input type="hidden" name="parent_category_management_idx" value="<?=$row->parent_category_management_idx?>">
                  <span class="category_btn">

                    <?php if($row->state == 1) {?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">활성화</a>
                    <?php } else { ?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">비활성화</a>
                    <?php } ?>

                    <a href="javascript:void(0)" class="btn-sm btn-default">수정</a>

                  </span>
                </li>
                <?php
                  $i++;
                }
              ?>
              </ul>
              <h4>카테고리 3차</h4>
              <input type="text" class="form-control add_item_val" placeholder="카테고리 3차명"> <a href="#" class="btn btn-info" onclick="category_management_reg_in(2)"> 추가</a>
            </div>
            <div class="col-md-3">
              <h4>카테고리 4차</h4>
              <ul class="category sortable" style="height:500px">
              <?php
                $i = 0;
                foreach($fourth_cate_list as $row){ ?>
                <li <?php if($i==0){ echo 'class="active"'; } ?>>
                  <input type="text" id="<?=$row->category_management_idx?>" value="<?=$row->category_name?>" readonly>
                  <input type="hidden" name="fourth_cate_list_idx[]" value="<?=$row->category_management_idx?>">
                  <input type="hidden" name="parent_category_management_idx" value="<?=$row->parent_category_management_idx?>">
                  <span class="category_btn">

                    <?php if($row->state == 1) {?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">활성화</a>
                    <?php } else { ?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">비활성화</a>
                    <?php } ?>

                    <a href="javascript:void(0)" class="btn-sm btn-default">수정</a>

                  </span>
                </li>
                <?php
                  $i++;
                }
              ?>
              </ul>
              <h4>카테고리 4차</h4>
              <input type="text" class="form-control add_item_val" placeholder="카테고리 4차명"> <a href="#" class="btn btn-info" onclick="category_management_reg_in(3)"> 추가</a>
            </div>
          </div>

        </div>
      </div>
    </form>
  </div>
  <!-- container-fluid : e -->
<script>

  //리스트 클릭 활성화
  $(document).on("click",".category li",function(){
    // 선택된 카테고리 표시
    $(this).siblings("li").removeClass("active");
    $(this).addClass("active");

    // 클릭한 카테고리의 뎁스

    var category_depth = $(".category").index($(this).parent()) + 1;
    req_category_depth = category_depth +1;
    var category_management_idx = null;
    category_management_idx = $(this).find('input[type="text"]').attr('id');
    $("#select_category_management_idx_"+category_depth).val(category_management_idx);
    $("#select_depth").val(category_depth-1);

    if(category_depth > 0){

      if(category_depth == 1){
        $(".category").eq(1).html("");
        $(".category").eq(2).html("");
        $(".category").eq(3).html("");
      }else if(category_depth == 2){
        $(".category").eq(2).html("");
        $(".category").eq(3).html("");
      }else if(category_depth == 3){
        $(".category").eq(3).html("");
      }

      category_management_list(category_management_idx, category_depth,req_category_depth);
    }
  });

  //삭제, 수정 기능
  $(document).on("click",".category_btn a",function(){
    var $item = $(this).parents("li");
    var category_depth = $('.category').index($item.parent()) + 1;
    var category_management_idx = $item.find('input').attr('id');

		if($(this).hasClass("btn-danger")){ //삭제버튼
			var result = confirm("삭제하시겠습니까?");
			if(result){
				category_management_del(category_management_idx);
				if($item.hasClass('active')){
					if(category_depth == 1){
						$(".category").eq(1).html("");
						$(".category").eq(2).html("");
						$(".category").eq(3).html("");
					}else if(category_depth == 2){
						$(".category").eq(2).html("");
						$(".category").eq(3).html("");
          }else if(category_depth == 3){
						$(".category").eq(3).html("");
					}
				}
				$item.remove();
			}
    } else if($(this).hasClass("btn-info")){ // 비활성화
      var result = confirm("상태를 변경하시겠습니까?");
			if(result){
        var category_depth = $('.category').index($item.parent()) + 1;
        var state = "";
        var rt = "";

        if($(this).text()=='활성화'){
          state ='1';
          $(this).text("비활성화");
        }else{
          state ='0';
          $(this).text("활성화");
        }
        $.ajax({
          url: "/<?=mapping('category_management')?>/category_state_up",
          type: "POST",
          dataType: "json",
          async: false,
          data: {
            category_management_idx: category_management_idx,
            category_depth: category_depth,
            state: state,

          },
          success: function(result) {
            if(result.code == '1'){
              rt ="1";
            }else{
              alert(result.msg);
              rt ="0";
            }
          },
          error: function(request,status,error){
            alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
          }
        });

        if(rt =="0"){
          if($(this).text()=='활성화'){
            $(this).text("비활성화");
          }else{
            $(this).text("활성화");
          }
        }


			}
    } else {
      if($(this).hasClass("btn-confirm")){ //수정 후 확인버튼
				var result = confirm("수정된 내용을 저장 하시겠습니까?");
				if(result){
					$item.find("input").attr("readonly",true)
					$(this).text("수정").removeClass("btn-confirm");
					var category_management_idx = $item.find("input").attr('id');
					var category_name = $item.find("input").val();

					category_management_mod_up(category_management_idx, category_name);
				}
      } else { //수정 버튼
        $item.find("input").attr("readonly",false).focus();
        $(this).text("확인").addClass("btn-confirm");
      }
    }
  });

// 카테고리 리스트 가져오기
  function category_management_list(parent_category_management_idx, category_depth,req_category_depth){
    var cate_type = 	$("#cate_type").val();

    $.ajax({
  		url: "/<?=mapping('category_management')?>/category_management_list",
  		type: "post",
  		data : {parent_category_management_idx: parent_category_management_idx,category_depth: req_category_depth,cate_type: cate_type},
  		dataType: 'json',
  		async: true,
  		success: function(result){
        if(result.category_management_list){
          for(var i=0; i<result.category_management_list.length; i++){
            var category_management_idx = result.category_management_list[i].category_management_idx;
            var category_name = result.category_management_list[i].category_name;
            var parent_category_management_idx = result.category_management_list[i].parent_category_management_idx;
            var state = result.category_management_list[i].state;
            var img_path = result.category_management_list[i].img_path;
            add_item(category_management_idx, category_name, category_depth + 1, parent_category_management_idx,state,img_path);
          }
        }
  		}
  	});
  }

  // 분류 추가 기능
  function category_management_reg_in(order){
    var target_list = $(".category").eq(order);
    var category_name = $(".add_item_val").eq(order).val();
    var category_depth = order + 1;
    var parent_category_management_idx = $("#select_category_management_idx_"+order).val();
    var select_depth = $("#select_depth").val();
    var cate_type = 	$("#cate_type").val();

    if(category_name == ""){
      alert("분류명을 입력해주세요.");
      return;
    }

    if(category_depth != 1 && !parent_category_management_idx){
      alert("상위 카테고리를 선택한 후 등록해주세요.");
      return;
    }

    $.ajax({
      url: "/<?=mapping('category_management')?>/category_management_reg_in",
      type: "POST",
      dataType: "json",
      async: true,
      data: {
        "category_depth": category_depth,
        "parent_category_management_idx": parent_category_management_idx,
        "cate_type": cate_type,
        "category_name": category_name
      },
      success: function(result) {
        if(result.code == 1){
          var category_management_idx = result.category_management_idx;
          add_item(category_management_idx, category_name, category_depth,'','1','');
          $(".add_item_val").eq(order).val("");
					alert("카테고리가 추가되었습니다.");
        }else{
          alert(result.msg);
        }
      },
      error: function(request,status,error){
        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
      }
    });
  }

// 상품 카테고리 삭제
  function category_management_del(category_management_idx){
    $.ajax({
      url: "/<?=mapping('category_management')?>/category_management_del",
      type: "POST",
      dataType: "json",
      async: true,
      data: {
        "category_management_idx": category_management_idx
      },
      success: function(result) {
        console.log(result);
      },
      error: function(request,status,error){
        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
      }
    });
  }

// 상품 카테고리 수정
  function category_management_mod_up(category_management_idx, category_name){
    $.ajax({
      url: "/<?=mapping('category_management')?>/category_management_mod_up",
      type: "POST",
      dataType: "json",
      async: true,
      data: {
        category_management_idx: category_management_idx,
        category_name: category_name,
      },
      success: function(result) {
        console.log(result);
      },
      error: function(request,status,error){
        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
      }
    });
  }



// 카티고리 화면에서 추가
  function add_item(category_management_idx, category_name, category_depth,parent_category_management_idx,state,img_path){

    var cate_list_idx="";
    var cate_img_path="";
    if(category_depth==1){
      if(img_path !=""){
        cate_img_path = "<img src='"+img_path+"' style='width:15px;' id='img_"+category_management_idx+"'  onClick=img_change('"+category_management_idx+"')>";
      }else{
        cate_img_path = "<img src='/images/btn_del.gif' style='width:15px;' id='img_"+category_management_idx+"'  onClick=img_change('"+category_management_idx+"')>";
      }
      cate_list_idx = "<input type='hidden' name='first_cate_list_idx[]' value='" + category_management_idx + "'>";
    }else  if(category_depth == 2){
      if(img_path !=""){
        cate_img_path = "<img src='"+img_path+"' style='width:15px;' id='img_"+category_management_idx+"'  onClick=img_change('"+category_management_idx+"')>";
      }else{
        cate_img_path = "<img src='/images/btn_del.gif' style='width:15px;' id='img_"+category_management_idx+"'  onClick=img_change('"+category_management_idx+"')>";
      }
      cate_list_idx = " <input type='hidden' name='second_cate_list_idx[]' value='" + category_management_idx + "'>";
    }else if(category_depth ==3){
      cate_list_idx = " <input type='hidden' name='third_cate_list_idx[]' value='" + category_management_idx + "'>";
    }else if(category_depth ==4){
      cate_list_idx = " <input type='hidden' name='fourth_cate_list_idx[]' value='" + category_management_idx + "'>";
    }

    var category_state ="";

		if( state == 0){
			category_state = "<a href='javascript:void(0)' class='btn-sm btn-info'>비활성화</a> ";
		} else {
			category_state = "<a href='javascript:void(0)' class='btn-sm btn-info'>활성화</a> ";
		}

		var $item = $("<li>" +
									 cate_img_path +
									" ["+category_management_idx+"]<input type='text' name='name' id='" + category_management_idx + "'value='" + category_name + "' readonly style='width:130px'>" +
									cate_list_idx +
									" <input type='hidden' name='parent_category_management_idx' value='" + parent_category_management_idx + "'>" +
									" <span class='category_btn'>" +
									category_state +
									"   <a href='#' class='btn-sm btn-default'>수정</a>" +
									" </span>" +
									"</li>");




    $('.category').eq(category_depth - 1).append($item);
  }

  var category_order_set = function (){

    $.ajax({
      url: "/<?=mapping('category_management')?>/category_order_set",
      type: "POST",
      dataType: "json",
      async: true,
      data: $("#form_default").serialize(),
      success: function(result) {
        if(result.code == 0){
          alert(result.msg);
        }
      }

    });
  }

  //이미지 팝업
  function img_change(category_management_idx){
    openWin = window.open("/<?=mapping('category_management')?>/img_change?category_management_idx="+category_management_idx,"CLIENT_WINDOW", "width=500, height=350, resizable = no, scrollbars = no");
    openWin.focus();
  }

  //이미지 세팅
  function img_set(category_management_idx,img_path){
    $("#img_"+category_management_idx).attr("src", img_path);
  }

  $( function() {
    $( ".sortable" ).sortable({
      placeholder: "ui-state-highlight",
      axis: "y",
      update: function() {
          $("#select_depth").val($(this).index('.sortable'));
          category_order_set();

      }

    });
    $( ".sortable" ).disableSelection();
  } );
</script>
