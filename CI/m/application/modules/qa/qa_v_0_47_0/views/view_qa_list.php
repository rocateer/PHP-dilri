<!-- header : s -->
<header>
  <a class="btn_back" href="/<?=mapping('setting')?>"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
    1:1 문의
  </h1>
  <p class="qa_title"><a href="/<?=mapping('qa')?>/qa_reg">등록</a></p>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body">
  <div class="no_data">
    <p>궁금하신 내용이<br>자주묻는질문(FAQ)으로는<br>해결이 어려우신가요?<br><br>문의 글을 작성하시면<br>확인 후에 답변을 드립니다.</p>
  </div>
	<ul class="qa_ul">
		<li>
      <a href="/<?=mapping('qa')?>/qa_detail" class="block">
  			<p class="title"><span>[기타 문의]</span> 3.1.2 버전 업데이트 안내</p>
        <button class="deactive">미답변</button>
  			<span>2020.01.02</span>
      </a>
		</li>
		<li>
      <a href="/<?=mapping('qa')?>/qa_detail" class="block">
  			<p class="title"><span>[기타 문의]</span> 3.1.2 버전 업데이트 안내</p>
        <button class="active">답변완료</button>
  			<span>2020.01.02</span>
      </a>
		</li>
	</ul>
</div>
<!-- body : e -->
