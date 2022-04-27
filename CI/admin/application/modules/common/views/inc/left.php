<?php $arr_right = explode(',',$this->admin_right); ?>


<div id="wrapper">

  <!-- Navigation : s-->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/main"><?=SERVICE_NAME;?> 중앙관리시스템</a>
    </div>

    <ul class="nav navbar-right top-nav" style="margin-right:20px">
      <li class="dropdown"><a href="/admin_password/pw_mod"><i class="fa fa-cog"></i> 비밀번호변경</a></li>
      <li class="dropdown"><a href="javascript:void(0)" onclick="logout_action()"><i class="fa fa-power-off"></i> 로그아웃</a></li>
    </ul>

    <script type="text/javascript">
      function logout_action(){
        if (!confirm("로그아웃 하시겠습니까?")) {
          return;
        }
        location.href="/logout";

      }
    </script>

    <div class="collapse navbar-collapse navbar-ex1-collapse">

      <!-- side-nav : s -->
      <ul class="nav navbar-nav side-nav">

        <li class="side_nav_top">
          <p><strong><?=$this->admin_name?></strong> <span>님 환영합니다.</span></p>
          <p><span>ID : <?=$this->admin_id?></span></p>
        </li>

       <?php if(in_array('0', $arr_right)){?>
        <!-- section 1 : 회원관리 -->
        <li <?php if($this->uri->segment(1)==mapping('member')){ echo "class='active';";}?>>
          <a href="/<?=mapping('member')?>">
            <i class="fa fa-user"></i>
            <span>회원관리</span>
          </a>
        </li>
        <!-- section 1 : 회원관리 -->
        <?}?>

        <?php if(in_array('1', $arr_right)){?>
        <!-- section 2 : 포인트관리 -->
        <li <?php if($this->uri->segment(1)==mapping('member_point')){ echo "class='active';";}?>>
          <a href="/<?=mapping('member_point')?>">
            <i class="fa fa-bell"></i>
            <span>포인트 관리</span>
          </a>
        </li>
        <!-- section 2 : 포인트관리 -->
        <?}?>

        <?php if(in_array('2', $arr_right)){?>
        <!-- section 3 : 상품관리 -->
        <li <?php if($this->uri->segment(1)==mapping('product')){ echo "class='active';";}?>>
          <a href="/<?=mapping('product')?>">
            <i class="fa fa-bookmark"></i>
            <span>상품 관리</span>
          </a>
        </li>
        <!-- section 3 : 상품관리 -->
        <?}?>

        <?php if(in_array('3', $arr_right)){?>
        <!-- section 4 : 커뮤니티관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('board')) echo "active";?>">
          <a href="/<?=mapping('board')?>">
            <i class="fa fa-comments"></i>
            <span>커뮤니티 관리</span>
          </a>
        </li>
        <!-- section 4 : 커뮤니티관리 -->
        <?}?>

        <?php if(in_array('4', $arr_right)){?>
        <!-- section 5 : 신고 관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('product_report')|| $this->uri->segment(1)==mapping('board_reply_report')|| $this->uri->segment(1)==mapping('board_report')|| $this->uri->segment(1)==mapping('ticket_product')) echo "active";?>">
          <a href="#" data-toggle="collapse" data-target="#admin_report">
            <i class="fa fa-bell-slash"></i>
            <span>신고 관리</span> &nbsp;<i class="fa fa-caret-down"></i>
          </a>

          <ul id="admin_report" class="collapse <?php if($this->uri->segment(1)==mapping('product_report')|| $this->uri->segment(1)==mapping('board_reply_report')|| $this->uri->segment(1)==mapping('board_report')  ){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('product_report');?>">상품 신고 관리</a></li>
            <li><a href="/<?=mapping('board_report');?>">커뮤니티 신고 관리</a></li>
            <li><a href="/<?=mapping('board_reply_report');?>">커뮤니티 댓글 신고 관리</a></li>
          </ul>
        </li>
        <!-- section 5 : 신고 관리 -->
        <?}?>

        <?php if(in_array('5', $arr_right)){?>
        <!-- section 6 : 추천검색어관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('recommend')) echo "active";?>">
          <a href="/<?=mapping('recommend')?>">
            <i class="fa fa-check"></i>
            <span>추천 검색어 관리</span>
          </a>
        </li>
        <!-- section 6 : 추천검색어관리 -->
        <?}?>

        <?php if(in_array('6', $arr_right)){?>
        <!-- section 7 : 금지어 관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('forbidden_search')) echo "active";?>">
          <a href="/<?=mapping('forbidden_search')?>">
            <i class="fa fa-ban"></i>
            <span>금지어 관리</span>
          </a>
        </li>
        <!-- section 7 : 금지어 관리 -->
        <?}?>

        <?php if(in_array('7', $arr_right)){?>
        <!-- section 8 : 통계 -->
        <li class="<?php if($this->uri->segment(1)==mapping('statistic')) echo "active";?>">
          <a href="/<?=mapping('statistic')?>">
            <i class="fa fa-calculator"></i>
            <span>통계</span>
          </a>
        </li>
        <!-- section 8 : 통계 -->
        <?}?>

        <?php if(in_array('8', $arr_right)){?>
        <!-- section 9 : 배너관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('banner')) echo "active";?>">
          <a href="/<?=mapping('banner')?>">
            <i class="fa fa-align-justify"></i>
            <span>배너관리</span>
          </a>
        </li>
        <!-- section 9 : 배너관리 -->
        <?}?>

        <?php if(in_array('9', $arr_right)){?>
        <!-- section 10 : 카테고리 관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('category_management')) echo "active";?>">
          <a href="/<?=mapping('category_management')?>">
            <i class="fa fa-book"></i>
            <span>카테고리 관리</span>
          </a>
        </li>
        <!-- section 10 : 카테고리 관리  -->
        <?}?>

        <?php if(in_array('10', $arr_right)){?>
        <!-- section 11 : 고객센터 -->
        <li class="<?php if($this->uri->segment(1)==mapping('notice') || $this->uri->segment(1)==mapping('faq')|| $this->uri->segment(1)==mapping('qa')) echo "active";?>">
          <a href="#" data-toggle="collapse" data-target="#admin_notice">
            <i class="fa fa-comments"></i>
            <span>고객센터</span> &nbsp;<i class="fa fa-caret-down"></i>
          </a>

          <ul id="admin_notice" class="collapse <?php if($this->uri->segment(1)==mapping('notice') || $this->uri->segment(1)==mapping('faq')|| $this->uri->segment(1)==mapping('qa')){ echo "in";}?>" aria-expanded="true">
            <li><a href="/<?=mapping('notice');?>">공지사항 관리</a></li>
            <li><a href="/<?=mapping('faq');?>">FAQ 관리</a></li>
            <li><a href="/<?=mapping('qa');?>">1:1 문의 관리</a></li>
          </ul>
        </li>
        <!-- section 11 : 고객센터 -->
        <?}?>

        <?php if(in_array('11', $arr_right)){?>
        <!-- section 12 : 약관 관리-->
        <li class="<?php if($this->uri->segment(1)==mapping('terms')) echo "active";?>">
          <a href="#"  data-toggle="collapse" data-target="#admin_terms">
            <i class="fa fa-bookmark"></i>
            <span>약관 관리</span>
          </a>
          <ul id="admin_terms" class="collapse <?php if($this->uri->segment(1)==mapping('terms')) echo "in";?>" aria-expanded="true">
            <li><a href="/<?=mapping('terms');?>">약관 관리</a></li>
          </ul>
        </li>
        <!-- section 12 : 약관 관리-->
        <?}?>

        <?php if(in_array('12', $arr_right)){?>
        <!-- section 13 : 관리자 관리 -->
        <li class="<?php if($this->uri->segment(1)==mapping('suboperator')) echo "active";?>">
          <a href="#"  data-toggle="collapse" data-target="#admin_suboperator">
            <i class="fa fa-address-card"></i>
            <span>관리자 관리</span>
          </a>
          <ul id="admin_suboperator" class="collapse <?php if($this->uri->segment(1)==mapping('suboperator')) echo "in";?>" aria-expanded="true">
            <li><a href="/<?=mapping('suboperator');?>">관리자 관리</a></li>
          </ul>
        </li>
        <!-- section 13 : 관리자 관리 -->
        <?}?>

      </ul>
      <!-- side-nav : e -->

    </div>
  </nav>
  <!-- Navigation : e -->

  <div id="page-wrapper">
