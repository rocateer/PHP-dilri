<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>회원탈퇴</h1>
</header>
<!-- header : e -->
<div class="body">
  <div class="inner_wrap row">
  	<div class="member_out_page">
      <h4 class="mt30">회원탈퇴 전에 아래 내용을 확인 해 주세요.</h4>
  		<ul class="member_out_ul mt20 mb30">
        <li>
          고객님의 계정에 저장된 정보가 삭제될 예정입니다. 삭제된 정보는 추후에 복원할 수 없습니다.
        </li>
        <li>
          같은 아이디로 재가입이 불가합니다.
        </li>
  		</ul>
      <div class="label">서비스 이용 중 어떤 부분이 불편하셨나요? <span class="essential">*</span></div>
  		<textarea style="height:280px;" placeholder="탈퇴 사유를 입력해 주세요. 소중한 의견을 반영하여 더 좋은 서비스로 찾아뵙겠습니다."></textarea>
  		<input type="checkbox" name="chk_1" id="chk_1_1">
      <label class="mt30" for="chk_1_1">
        <span></span>
        안내사항을 모두 확인하였으며, 이에 동의합니다.
      </label>
      <div class="btn_half_wrap mb30 mt30">
        <span class="btn_full_weight btn_gray_line3">
          <a href="">취소</a>
        </span>
    	  <span class="btn_full_weight btn_sub_point" id="btn_chk">
    	    <a href="/<?=mapping('mypage')?>">탈퇴하기</a>
    	  </span>
      </div>
  	</div>
  </div>
</div>
